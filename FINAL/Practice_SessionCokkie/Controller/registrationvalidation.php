<?php
/**
 * registrationvalidation.php
 * ─────────────────────────────────────────────────────────────
 * Handles POST submissions from registration.php.
 * Validates each step, stores data in $_SESSION['form_data'],
 * advances / retreats the step counter, and on final submission
 * saves a cookie confirming registration.
 * ─────────────────────────────────────────────────────────────
 */

session_start();

// Guard: reject direct browser access (no POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registration.php');
    exit;
}

// ── Read inputs ────────────────────────────────────────────────
$step   = (int) ($_POST['step']   ?? 1);
$action = trim($_POST['action']   ?? 'next');

// Initialise session buckets if needed
if (!isset($_SESSION['form_data'])) $_SESSION['form_data'] = [];
if (!isset($_SESSION['step']))      $_SESSION['step']      = 1;

// ── Going BACK: just retreat one step, no validation needed ───
if ($action === 'prev') {
    $_SESSION['step'] = max(1, $step - 1);
    header('Location: registration.php');
    exit;
}

// ── Helper: sanitise a plain string ───────────────────────────
function clean(string $val): string {
    return htmlspecialchars(strip_tags(trim($val)));
}

// ── Validate by step ──────────────────────────────────────────
$errors = [];

// ════════════════════════════════
//  STEP 1 – Personal info
// ════════════════════════════════
if ($step === 1) {

    $first_name = clean($_POST['first_name'] ?? '');
    $last_name  = clean($_POST['last_name']  ?? '');
    $about      = clean($_POST['about']      ?? '');

    if (strlen($first_name) < 2) {
        $errors['first_name'] = 'First name must be at least 2 characters.';
    } elseif (!preg_match('/^[A-Za-z\s\'\-]+$/', $first_name)) {
        $errors['first_name'] = 'First name may only contain letters, spaces, hyphens or apostrophes.';
    }

    if (strlen($last_name) < 2) {
        $errors['last_name'] = 'Last name must be at least 2 characters.';
    } elseif (!preg_match('/^[A-Za-z\s\'\-]+$/', $last_name)) {
        $errors['last_name'] = 'Last name may only contain letters, spaces, hyphens or apostrophes.';
    }

    if (strlen($about) > 500) {
        $errors['about'] = 'Bio must be 500 characters or fewer.';
    }

    if (empty($errors)) {
        $_SESSION['form_data']['first_name'] = $first_name;
        $_SESSION['form_data']['last_name']  = $last_name;
        $_SESSION['form_data']['about']      = $about;
        $_SESSION['step'] = 2;
    } else {
        // Preserve typed values so inputs repopulate
        $_SESSION['form_data']['first_name'] = $first_name;
        $_SESSION['form_data']['last_name']  = $last_name;
        $_SESSION['form_data']['about']      = $about;
    }
}

// ════════════════════════════════
//  STEP 2 – Account credentials
// ════════════════════════════════
elseif ($step === 2) {

    $email           = trim($_POST['email']           ?? '');
    $password        = $_POST['password']             ?? '';
    $password_repeat = $_POST['password_repeat']      ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // Password rules: min 8 chars, at least one letter & one digit
    if (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters.';
    } elseif (!preg_match('/[A-Za-z]/', $password)) {
        $errors['password'] = 'Password must contain at least one letter.';
    } elseif (!preg_match('/[0-9]/', $password)) {
        $errors['password'] = 'Password must contain at least one number.';
    }

    if (empty($errors['password']) && $password !== $password_repeat) {
        $errors['password_repeat'] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $_SESSION['form_data']['email']    = clean($email);
        // Store only a bcrypt hash – never the raw password
        $_SESSION['form_data']['pw_hash']  = password_hash($password, PASSWORD_BCRYPT);
        $_SESSION['step'] = 3;
    } else {
        $_SESSION['form_data']['email'] = clean($email);
    }
}

// ════════════════════════════════
//  STEP 3 – Social profiles + submit
// ════════════════════════════════
elseif ($step === 3 && $action === 'submit') {

    $facebook   = trim($_POST['facebook']   ?? '');
    $twitter    = trim($_POST['twitter']    ?? '');
    $googleplus = trim($_POST['googleplus'] ?? '');

    // Social fields are optional, but if filled must be valid URLs
    foreach (['facebook' => $facebook, 'twitter' => $twitter, 'googleplus' => $googleplus] as $field => $val) {
        if ($val !== '' && !filter_var($val, FILTER_VALIDATE_URL)) {
            $errors[$field] = 'Please enter a valid URL (e.g. https://facebook.com/you).';
        }
    }

    if (empty($errors)) {
        // Persist social data
        $_SESSION['form_data']['facebook']   = clean($facebook);
        $_SESSION['form_data']['twitter']    = clean($twitter);
        $_SESSION['form_data']['googleplus'] = clean($googleplus);

        // ── FINALISE REGISTRATION ──────────────────────────────
        //
        // In a real app you would INSERT into your database here.
        // For this demo we log the collected data to a PHP error
        // log and set a secure cookie to confirm registration.
        //
        $snapshot = $_SESSION['form_data'];
        unset($snapshot['pw_hash']); // don't log the hash
        error_log('[Registration] New user: ' . json_encode($snapshot));

        // Confirmation cookie: 30-day expiry, HttpOnly, SameSite=Lax
        $cookie_value = base64_encode(json_encode([
            'name'       => $snapshot['first_name'] . ' ' . $snapshot['last_name'],
            'email'      => $snapshot['email'],
            'registered' => date('c'),
        ]));

        setcookie(
            'registered_user',
            $cookie_value,
            [
                'expires'  => time() + (30 * 24 * 60 * 60),
                'path'     => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]
        );

        // Mark session as complete (display success screen)
        $_SESSION['step'] = 'done';
    } else {
        // Keep typed social URLs so inputs repopulate
        $_SESSION['form_data']['facebook']   = clean($facebook);
        $_SESSION['form_data']['twitter']    = clean($twitter);
        $_SESSION['form_data']['googleplus'] = clean($googleplus);
        $_SESSION['step'] = 3;
    }
}

// ── Propagate errors back to the view ─────────────────────────
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
}

// ── Always redirect back to the form (PRG pattern) ────────────
header('Location: registration.php');
exit;