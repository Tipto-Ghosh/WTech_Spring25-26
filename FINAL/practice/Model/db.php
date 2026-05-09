<?php

class db{
    
    function db_connection() {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "practice";

        $connection = new mysqli($db_host , $db_user , $db_password , $db_name);
        if($connection->connect_error) {
            die("please connect the database: ".$connection->connect_error);
        }
        
        return $connection;
    }

    function registration(string $name, string $password, string $email, string $tableName) {
        $sql_query = "INSERT INTO ".$tableName." (name, password, email) VALUES ('".$name."', '".$password."', '".$email."')";

        $connection = $this->db_connection();
        $result = $connection->query($sql_query);
        $connection->close();
        return $result;
    }

    function login(string $name, string $password, string $tableName) {
        $sql_query = "SELECT * FROM ".$tableName." WHERE name = '".$name."' AND password = '".$password."'";
        $connection = $this->db_connection();
        $result = $connection->query($sql_query);
        $connection->close();

        if($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }
}

?>