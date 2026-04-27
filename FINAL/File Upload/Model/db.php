<?php
class db{
    function db_connection() {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "registrationdatabase";

        $connection = new mysqli($db_host , $db_user , $db_password , $db_name);
        if($connection->connect_error) {
            die("Please connect the database: ".$connection->connect_error);
        }
        return $connection;
    }

    function add_new_user(string $name,string $password,string $filepath,string $email,string $website, string $comment,string $gender) {
       $connection = $this->db_connection();
       $tablename = "users";

       $sql_query = "INSERT INTO ".$tablename." (name,password,filepath,email,website,comment,gender) VALUES ('".$name."','".$password."','".$filepath."','".$email."','".$website."','".$comment."','".$gender."')";
       $result = $connection->query($sql_query);
       $connection->close();

       return $result;
    }
    
    function login_for_user(string $name , string $password) {
        $connection = $this->db_connection();
        $tablename = "users";

        $sql_query = "SELECT * FROM ".$tablename." WHERE name = '".$name."' AND password = '".$password."'";
        $result = $connection->query($sql_query);

        $user_data = [];
        if($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
        }
        $connection->close();
        return $user_data;
    }

}
?>