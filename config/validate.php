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

function loginUser($email, $pass){
    $conn = connect();
    $email = trim($email);
    $pass = trim($pass);

    if ($email == "" || $pass == "") {
        return "Tous les inputs doit etre remplis";
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $sql = "SELECT email, password FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data == NULL) {
        return "Email n'est pas valide!";
    }

    if ($data["password"] != $pass) {
        return "Mot de passe n'est pas valide!";
    } else {
        $_SESSION["email"] = $email;
        header("location: ../intern/info.php");
    }    
}

function signupUser($nom, $prenom, $cin, $email, $numero, $etablissement, $theme, $password){
    $conn = connect();
    $nom = trim($nom);
    $prenom = trim($prenom);
    $cin = trim($cin);
    $email = trim($email);
    $numero = trim($numero);
    $etablissement = trim($etablissement);
    $theme = trim($theme);


    $inscrisql = "SELECT 1 FROM inscri WHERE CIN = ?";

    $stmt = $conn->prepare($inscrisql);
    $stmt->bind_param("s", $cin);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data == NULL){
        return "Deja inscri";
    }



    $actuelssql = "SELECT 1 FROM actuels WHERE CIN = ?";

    $stmt = $conn->prepare($actuelssql);
    $stmt->bind_param("s", $cin);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data == NULL) {
        echo "<script>alert('Vous etes un stagiaire actuel')</script>";
        return "Vous etes un stagiaire actuel";
    }



    $insertsql = "INSERT INTO inscri (nom, prenom, cin, email, numero, etudiant, etablissement, theme) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($insertsql);
    $stmt->bind_param("ssssssss", $nom, $prenom, $cin, $email, $numero, $etablissement, $theme);
    $stmt->execute();

    $insertsql = "INSERT INTO info (nom, prenom, cin, numero, email) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($insertsql);
    $stmt->bind_param("sssss", $nom, $prenom, $cin, $numero, $email);
    $stmt->execute();

    $info = $nom . $prenom . $cin;
    $currentTime = date("Y-m-d H-i-s");
    $action = "Inscri";
    $logsql = "INSERT INTO logs (action, info, time) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($logsql);
    $stmt->bind_param("sss", $action, $info, $currentTime);
    $stmt->execute();

    $insertsql = "INSERT INTO users (email, password) VALUES (?, ?)";

    $stmt = $conn->prepare($inscrisql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();


}