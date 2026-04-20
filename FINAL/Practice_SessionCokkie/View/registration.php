<?php
session_start();

// Initialize step if not set
if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
}

// Load saved form data from session
$form_data = $_SESSION['form_data'] ?? [];
$errors     = $_SESSION['errors']    ?? [];

// Clear errors after reading
unset($_SESSION['errors']);

$step = $_SESSION['step'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Nunito', sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #5a6cbf;
    position: relative;
    overflow: hidden;
  }

  /* City background with purple overlay */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background:
      linear-gradient(135deg, rgba(72, 88, 180, 0.82) 0%, rgba(90, 110, 195, 0.78) 100%);
    z-index: 0;
  }

  /* Decorative city silhouette */
  body::after {
    content: '';
    position: fixed;
    bottom: 0; left: 0; right: 0;
    height: 55%;
    background:
      linear-gradient(180deg, transparent 0%, rgba(40,55,130,0.55) 100%);
    z-index: 0;
    /* Building outlines via box-shadows trick */
    background-image: repeating-linear-gradient(
      90deg,
      rgba(255,255,255,0.03) 0px, rgba(255,255,255,0.03) 40px,
      transparent 40px, transparent 80px
    );
  }

  /* ─── Card ─── */
  .card {
    position: relative;
    z-index: 10;
    background: #fff;
    border-radius: 14px;
    width: 520px;
    max-width: 94vw;
    box-shadow: 0 24px 64px rgba(30,40,120,0.28);
    overflow: hidden;
    animation: slideUp 0.45s cubic-bezier(.22,.68,0,1.2) both;
  }

  @keyframes slideUp {
    from { opacity: 0; transform: translateY(30px) scale(0.97); }
    to   { opacity: 1; transform: translateY(0)   scale(1);    }
  }

  /* Header section */
  .card-header {
    background: #fff;
    padding: 28px 32px 20px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }

  .step-title {
    font-size: 1.55rem;
    font-weight: 700;
    color: #555;
    letter-spacing: -0.3px;
  }

  .step-sub {
    font-size: 0.88rem;
    color: #aaa;
    margin-top: 5px;
    font-weight: 400;
  }

  .step-icon {
    font-size: 3rem;
    color: #ccc;
    line-height: 1;
    margin-top: -4px;
  }

  /* Body section */
  .card-body {
    background: #f0f0f0;
    padding: 22px 32px 28px;
  }

  /* Progress bar */
  .progress-bar {
    display: flex;
    gap: 6px;
    margin-bottom: 20px;
  }

  .progress-bar span {
    flex: 1;
    height: 4px;
    border-radius: 99px;
    background: #ddd;
    transition: background 0.3s;
  }

  .progress-bar span.active  { background: #29b6e6; }
  .progress-bar span.done    { background: #29b6e6; }

  /* Inputs */
  .form-group {
    margin-bottom: 12px;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"],
  input[type="url"],
  textarea {
    width: 100%;
    padding: 14px 16px;
    border: none;
    border-radius: 8px;
    background: #fff;
    font-family: 'Nunito', sans-serif;
    font-size: 0.92rem;
    color: #555;
    outline: none;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06) inset;
    transition: box-shadow 0.2s;
  }

  input::placeholder, textarea::placeholder { color: #bbb; }

  input:focus, textarea:focus {
    box-shadow: 0 0 0 2px #29b6e6 inset;
  }

  textarea {
    resize: vertical;
    min-height: 100px;
  }

  .error-msg {
    color: #e05252;
    font-size: 0.78rem;
    margin-top: 4px;
    padding-left: 4px;
  }

  /* Buttons */
  .btn-row {
    margin-top: 20px;
    display: flex;
    gap: 10px;
  }

  .btn {
    padding: 12px 30px;
    border: none;
    border-radius: 7px;
    font-family: 'Nunito', sans-serif;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: filter 0.18s, transform 0.12s;
    background: #29b6e6;
    color: #fff;
    letter-spacing: 0.2px;
  }

  .btn:hover  { filter: brightness(1.1); transform: translateY(-1px); }
  .btn:active { transform: translateY(0); filter: brightness(0.95); }

  /* Success screen */
  .success-wrap {
    text-align: center;
    padding: 48px 32px;
  }

  .success-icon {
    font-size: 4rem;
    color: #29b6e6;
    margin-bottom: 16px;
  }

  .success-wrap h2 {
    font-size: 1.6rem;
    color: #444;
    margin-bottom: 8px;
  }

  .success-wrap p {
    color: #999;
    font-size: 0.92rem;
    line-height: 1.6;
  }

  .success-wrap a {
    display: inline-block;
    margin-top: 24px;
    padding: 11px 28px;
    background: #29b6e6;
    color: #fff;
    border-radius: 7px;
    text-decoration: none;
    font-weight: 600;
    transition: filter 0.2s;
  }

  .success-wrap a:hover { filter: brightness(1.1); }
</style>
</head>
<body>

<?php if ($step === 'done'): ?>

  <div class="card">
    <div class="success-wrap">
      <div class="success-icon">✔</div>
      <h2>You're all set, <?= htmlspecialchars($form_data['first_name'] ?? 'there') ?>!</h2>
      <p>
        Your account has been created successfully.<br>
        A confirmation cookie has been saved to your browser.
      </p>
      <a href="registration.php?reset=1">Start over</a>
    </div>
  </div>

<?php else: ?>

  <div class="card">

    <!-- ── Header ── -->
    <div class="card-header">
      <div>
        <div class="step-title">Step <?= $step ?> / 3</div>
        <div class="step-sub">
          <?php
            $subtitles = [
              1 => 'Tell us who you are:',
              2 => 'Set up your account:',
              3 => 'Social media profiles:',
            ];
            echo $subtitles[$step];
          ?>
        </div>
      </div>
      <div class="step-icon">
        <?php
          $icons = [
            1 => '👤',
            2 => '🔑',
            3 => '🐦',
          ];
          echo $icons[$step];
        ?>
      </div>
    </div>

    <!-- ── Body ── -->
    <div class="card-body">

      <!-- Progress bar -->
      <div class="progress-bar">
        <?php for ($i = 1; $i <= 3; $i++): ?>
          <span class="<?= $i < $step ? 'done' : ($i === $step ? 'active' : '') ?>"></span>
        <?php endfor; ?>
      </div>

      <form method="POST" action="registrationvalidation.php">
        <input type="hidden" name="step" value="<?= $step ?>">

        <?php if ($step === 1): ?>
          <div class="form-group">
            <input type="text" name="first_name" placeholder="First name..."
                   value="<?= htmlspecialchars($form_data['first_name'] ?? '') ?>">
            <?php if (!empty($errors['first_name'])): ?>
              <div class="error-msg"><?= $errors['first_name'] ?></div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <input type="text" name="last_name" placeholder="Last name..."
                   value="<?= htmlspecialchars($form_data['last_name'] ?? '') ?>">
            <?php if (!empty($errors['last_name'])): ?>
              <div class="error-msg"><?= $errors['last_name'] ?></div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <textarea name="about" placeholder="About yourself..."><?= htmlspecialchars($form_data['about'] ?? '') ?></textarea>
            <?php if (!empty($errors['about'])): ?>
              <div class="error-msg"><?= $errors['about'] ?></div>
            <?php endif; ?>
          </div>
          <div class="btn-row">
            <button type="submit" class="btn" name="action" value="next">Next</button>
          </div>

        <?php elseif ($step === 2): ?>
          <div class="form-group">
            <input type="email" name="email" placeholder="Email..."
                   value="<?= htmlspecialchars($form_data['email'] ?? '') ?>">
            <?php if (!empty($errors['email'])): ?>
              <div class="error-msg"><?= $errors['email'] ?></div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <input type="password" name="password" placeholder="Password...">
            <?php if (!empty($errors['password'])): ?>
              <div class="error-msg"><?= $errors['password'] ?></div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <input type="password" name="password_repeat" placeholder="Repeat password...">
            <?php if (!empty($errors['password_repeat'])): ?>
              <div class="error-msg"><?= $errors['password_repeat'] ?></div>
            <?php endif; ?>
          </div>
          <div class="btn-row">
            <button type="submit" class="btn" name="action" value="prev">Previous</button>
            <button type="submit" class="btn" name="action" value="next">Next</button>
          </div>

        <?php elseif ($step === 3): ?>
          <div class="form-group">
            <input type="url" name="facebook" placeholder="Facebook..."
                   value="<?= htmlspecialchars($form_data['facebook'] ?? '') ?>">
            <?php if (!empty($errors['facebook'])): ?>
              <div class="error-msg"><?= $errors['facebook'] ?></div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <input type="url" name="twitter" placeholder="Twitter..."
                   value="<?= htmlspecialchars($form_data['twitter'] ?? '') ?>">
            <?php if (!empty($errors['twitter'])): ?>
              <div class="error-msg"><?= $errors['twitter'] ?></div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <input type="url" name="googleplus" placeholder="Google plus..."
                   value="<?= htmlspecialchars($form_data['googleplus'] ?? '') ?>">
            <?php if (!empty($errors['googleplus'])): ?>
              <div class="error-msg"><?= $errors['googleplus'] ?></div>
            <?php endif; ?>
          </div>
          <div class="btn-row">
            <button type="submit" class="btn" name="action" value="prev">Previous</button>
            <button type="submit" class="btn" name="action" value="submit">Sign me up!</button>
          </div>
        <?php endif; ?>

      </form>
    </div><!-- /card-body -->
  </div><!-- /card -->

<?php endif; ?>

<?php
// Reset flow
if (isset($_GET['reset'])) {
    session_destroy();
    setcookie('registered_user', '', time() - 3600, '/');
    header('Location: registration.php');
    exit;
}
?>
</body>
</html>