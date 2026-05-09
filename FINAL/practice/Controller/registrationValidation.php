<?php
include "../Model/db.php";
session_start();

$nameError = "";
$emailError = "";
$passwordError = "";

$name = "";
$email = "";
$password = "";
$is_valid = true;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"]  ?? "";
    $password = $_POST["password"] ?? "";

    if(empty($name) || strlen($name) < 5) {
        $nameError = "Enter a valid name";
        $is_valid = false;
    }
    if(empty($password) || strlen($password) > 4) {
        $passwordError = "Password must not empty and not more than 4 char.";
        $is_valid = false;
    }
    if(empty($email) || !preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/" , $email)) {
        $emailError =  "Enter a valid email";
        $is_valid = false;
    }

    if($is_valid) {
        setcookie("name" , $name , time() + 3600 , "/");
        $formdata = array("name" => $name , "password"  => $password , "email" => $email);
        $file_path = "../data.json";
        if(file_exists($file_path)) {
            $existing =  file_get_contents($file_path);
            $existing_data = json_decode($existing , true);
            
            if(!is_array($existing_data)) {
                $existing_data = [];
            }
        }else {
            $existing_data = [];
        }

        $existing_data[] = $formdata;
        $json_data = json_encode($existing_data , JSON_PRETTY_PRINT);
        file_put_contents($file_path , $json_data);

        $database = new db();
        $result = $database->registration($name , $password , $email , "users");
        
        if($result) {
            $_SESSION["registration_success"] = "Registration done. Please login";
            header("Location: ../View/login.php");
        }
    }
}
?>