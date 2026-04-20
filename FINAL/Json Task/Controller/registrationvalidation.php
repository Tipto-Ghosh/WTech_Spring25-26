<?php

session_start();


$name = "";
$email = "";
$website = "";
$comment = "";
$gender = "";

$data_file = "../data.json";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"] ?? "";
    $email= $_POST["email"] ?? "";
    $website = $_POST["website"] ?? "";
    $comment = $_POST["comment"] ?? "";
    $gender= $_POST["gender"] ?? "";

    $isValid = true;

    if (empty($name) || strlen($name) < 5) {
        $isValid = false;
        $name = "Not a valid name";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = "Invalid email format";
        $isValid = false;
    }



    if (empty($website)) {
        $website = "empty website given";
        $isValid = false;
    } else {
        if (!preg_match("/^(https?:\/\/)?(www\.)?[a-zA-Z0-9][a-zA-Z0-9-]*\.[a-zA-Z]{2,}([\/?#][a-zA-Z0-9-._~:\/?#\[\]@!$&'()*+,;=]*)?$/", $website)) {
            $websiteErr = "Invalid website";
            $isValid = false;
        }
    }
    if (empty($comment)) {
        $comment = "";
        $isValid = false;
    }

    if (empty($gender)) {
        $gender = "Gender is required";
        $isValid = false;
    }


    if ($isValid) {
        setcookie("name", $name, time() + (86400 * 30), "/");
        $formdata = array(
            "Name" => $name,
            "Email" => $email,
            "Website" => $website,
            "Comment" => $comment,
            "Gender" => $gender
        );

        
        if (file_exists($data_file)) {
            $existing_data = file_get_contents($data_file);
            $tempdata = json_decode($existing_data, true);
        } else {
            $tempdata = array();
        }

        if (!is_array($tempdata)) {
            $tempdata = array();
        }
        $tempdata[] = $formdata;
        $jsondata = json_encode($tempdata, JSON_PRETTY_PRINT);

        if (file_put_contents($data_file, $jsondata) !== false) {
            $_SESSION['user_data'] = $formdata;
            // welcome page 
            header("Location: ../View/welcome.php");
            exit();
        } else {
            echo "Error saving data.";
        }
    }
}

?>