<?php
require 'config.php';

function connect(){
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($mysqli->connect_errno != 0) {
        $error = $mysqli->connect_error;
        $error_date = date("F j, Y, g:i a");
        $message = "{$error} | {$error_date} \r\n";
        file_put_contents("db-log.txt", $message, FILE_APPEND);
        return false;
    } else {
        $mysqli->set_charset("utf8mb4");
        return $mysqli;
    }
}

function loginAdmin($email, $pass){
    $conn = connect();
    $email = trim($email);
    $pass = trim($pass);

    if ($email == "" || $pass == ""){
        return "Tous les inputs doit etre remplis";
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $sql = "SELECT email, password FROM admins WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data == NULL){
        return "Email n'est pas valide!";
    }

    if ($data["password"] != $pass){
        return "Mot de passe n'est pas valide!";
    }
    else{
        $_SESSION["email"] = $email;
        header("location: ../dashboard/dashboard.php");
    }
}