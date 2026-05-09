<?php
include "../Model/db.php";
session_start();

$name = "";
$password = "";

$nameError = "";
$passwordError = "";
$is_valid = true;
$loginError = "";
$successMessage = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? "";
    $password = $_POST["password"] ?? "";

    if(empty($name) || strlen($name) < 5) {
        $nameError = "Enter a valid name";
        $is_valid = false;
    }
    if(empty($password) || strlen($password) > 4) {
        $passwordError = "Password must not empty and not more than 4 char.";
        $is_valid = false;
    }

    if($is_valid) {
        $database = new db();
        $user = $database->login($name , $password , "users"); 

        if($user) {
            $_SESSION["user"] = $user;
            $_SESSION["success"] = "Login Successful!";
            header("Location: ../View/welcome.php");
            exit();
        } else {
            $loginError = "Invalid username or password.";
            header("Location: ../View/login.php");
            exit();
        }
    }
}
?>