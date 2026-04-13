<?php
    
    $collectName = "";
    $collectPassword = "";
    $collectWebsite = "";
    $collectComment = "";
    $collectGender = "";

    $name = "";
    $password = "";
    $website = "";
    $comment = "";
    $gender = "";
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $collectName = $_POST["name"];
       
        $collectPassword = $_POST["pass"];
        $collectWebsite = $_POST["website"];
        $collectComment = $_POST["comment"];

        if(!empty($collectName) && strlen($collectName) >= 5){
            $name = "validated: ".$collectName;
        }
        else{
            $name = "UserName must be greater than or equal to 5 characters";
        }

        if(!empty($collectPassword) && strlen($collectPassword) > 4){
            $password = "password accecpted";
        }
        else{
            $password = "password must be greater than 4";
        }
        
        if(!empty($collectWebsite)) {
            $isValidWebsize = preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $collectWebsite);
            if($isValidWebsize){
              $website = "website is valid";    
            }else{
              $website = "website is not valid";  
            }
            
        }
        else{
            $website = "website can't be empty";
        }

        if(!empty($collectComment)) {
            $comment = $collectComment;
        }
        
        if(!isset($_POST["gender"])) {
            $collectGender = $_POST["gender"];
            $gender = "selected gender: ".$collectGender;
        }else{
            $gender = "select a gender";
        }
        
    } 
?>