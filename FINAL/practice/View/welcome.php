<?php
session_start();

if(isset($_SESSION["success"])) {
    echo "<br><br>";

    echo "Welcome, " . $_SESSION["user"]["name"];

    unset($_SESSION["success"]);
}
?>