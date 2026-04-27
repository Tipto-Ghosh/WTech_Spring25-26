<?php
include "../Model/db.php";

session_start();
$name = "";
$password = "";
$error_message = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? "";
    $password = $_POST["password"] ?? "";

    if(!empty($name) && strlen($name) >= 5 && strlen($password) >= 4) {
        setcookie("UserName",$name,time()+3600, "/");
        // search in database 
        $database = new db();
        $user_data = $database->login_for_user($name , $password);

        if(!empty($user_data)) {
            setcookie("Name", $name, time() + 3600, "/");
            $_SESSION['user'] = $user_data; 
            header("Location: ../View/welcome.php");
            exit();
        }
        else{
            $error_message = "Wrong username or password.";
        }
    }
    else {
        $error_message = "Username must be at least 5 characters and password at least 4 characters.";
    }

    // if error
    if(!empty($error_message)) {
        header("Location: ../View/login.php?error=" . urlencode($error_message));
        exit();
    }
}

?>