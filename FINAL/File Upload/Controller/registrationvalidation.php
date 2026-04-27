<?php
include "../Model/db.php";
session_start();

$name = "";
$password = "";
$filepath = "";
$email = "";
$website = "";
$comment = "";
$gender = "";


$data_file = "../data.json";


if($_SERVER["REQUEST_METHOD"]=="POST") {
    // inputs from form
    $name = $_POST["name"] ?? "";
    $password = $_POST["password"] ?? "";
    $file = $_FILES["file"] ?? "";
    $email = $_POST["email"] ?? "";
    $website = $_POST["website"] ?? "";
    $comment = $_POST["comment"] ?? "";
    $gender = $_POST["gender"] ?? "";
    
    $is_all_valid = true;


    // name validation
    if(empty($name) || strlen($name) < 5) {
        $name = "Name can't be empty and must need to be at least 5 letters";
        $is_all_valid = false;
    }
    

    // pass validation
    if(empty($password) || strlen($password) > 4) {
        $password = "Password can't be empty and can't have more than 4 chars.";
        $is_all_valid = false;
    }

    // take the file
    if($file) {
      $targetDirectory = "../File/";
      $filepath = $targetDirectory.basename($file["name"]);
      $fileStatus = move_uploaded_file($file["tmp_name"] , $filepath); 
    }
    else{
      $filepath = "";
    }
    
    // email validation
    if(empty($email) || !preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $is_all_valid = false;
        $email = "Enter a valid email address";
    }
    
    // website
    $url_check = "/^(https?:\/\/)?(www\.)?[a-zA-Z0-9][a-zA-Z0-9-]*\.[a-zA-Z]{2,}([\/?#][a-zA-Z0-9-._~:\/?#\[\]@!$&'()*+,;=]*)?$/";
    if(empty($website) || !preg_match($url_check , $website)) {
        $is_all_valid = false;
        $website = "provide a valid website.";
    }
    
    if(empty($gender)) {
        $is_all_valid = false;
        $gender = "select a gender.";
    }


    if($is_all_valid) {
        // set cookie
        setcookie("name" , $name , time() + (86400 * 30) , "/");

        // format data
        $formdata = array("Name" => $name,"Password" => $password,"Website" => $website,"Comment" => $comment,"Gender" => $gender);
        
        // load json data
        if(file_exists($data_file)) {
            $existing = file_get_contents($data_file);
            $existing_data = json_decode($existing , true);

            if(!is_array($existing_data)) {
               $existing_data = array();    
            }
        }
        else {
            $existing_data = array();
        }
        
        // add current data with existing data
        $existing_data[] = $formdata;
        $json_data = json_encode($existing_data , JSON_PRETTY_PRINT);
        file_put_contents($data_file , $json_data);


        // database entry
        $database = new db();
        $result = $database->add_new_user($name,$password,$filepath,$email,$website,$comment,$gender);
        
        if($result) {
           $_SESSION["registration_success"] = "Registration done. Please login";
           header("Location: ../View/login.php");
           exit;
        }else {
            echo "registration failed: ".$result;
        }
        
    }
    
    if(isset($_SESSION["success"])) {
        echo "<p style='color:green;'>{$_SESSION['success']}</p>";
        unset($_SESSION['success']);
    }
}

?>