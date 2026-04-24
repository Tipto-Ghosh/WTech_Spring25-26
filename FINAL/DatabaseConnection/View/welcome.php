<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php"); 
    exit();
}

$user = $_SESSION['user'];
?>
<h1>Welcome, <?php echo htmlspecialchars($user['name']); ?></h1>
<p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
