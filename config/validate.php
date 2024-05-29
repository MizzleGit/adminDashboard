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
    // $pass = filter_var($pass, FILTER_SANITIZE_STRING);

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
    $email = strtolower($email);
    $pass = trim($pass);

    if ($email == "" || $pass == "") {
        return "Tous les inputs doit etre remplis";
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // $pass = filter_var($pass, FILTER_SANITIZE_STRING);

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
    $conn->query("START TRANSACTION");
    try {
        $nom = trim($nom);
        $prenom = trim($prenom);
        $cin = trim($cin);
        $email = trim($email);
        $numero = trim($numero);
        $etudiant = "Oui";

        $nom = strtoupper($nom);
        $prenom = ucfirst($prenom);
        $email = strtolower($email);
        $cin = strtoupper($cin);

        if (!isset($etablissement) || empty($etablissement)) {
            $etudiant = "Non";
        }
        $etablissement = trim($etablissement);

        $inscrisql = "SELECT 1 FROM inscri WHERE CIN = ?";

        $stmt = $conn->prepare($inscrisql);
        $stmt->bind_param("s", $cin);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if ($data != NULL) {
            // echo "<script>alert('Vous etes deja inscri!')</script>";
            return "Deja inscri";
        }



        $actuelssql = "SELECT 1 FROM actuels WHERE CIN = ?";

        $stmt = $conn->prepare($actuelssql);
        $stmt->bind_param("s", $cin);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if ($data != NULL) {
            // echo "<script>alert('Vous etes un stagiaire actuel!')</script>";
            return "Vous etes un stagiaire actuel";
        }

        $signedupsql = "SELECT email, password FROM users WHERE email = ?";

        $stmt = $conn->prepare($signedupsql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if ($data != NULL) {
            if ($data["password"] != $password) {
                return "Le mot de passe n'est pas correcte! Entrez votre ancien mot de passe!";
            }
        }

        $insertsql = "INSERT INTO inscri (nom, prenom, cin, email, numero, etudiant, etablissement, theme) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertsql);
        $stmt->bind_param("ssssssss", $nom, $prenom, $cin, $email, $numero, $etudiant, $etablissement, $theme);
        $stmt->execute();

        $insertsql = "INSERT INTO info (nom, prenom, cin, numero, email) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertsql);
        $stmt->bind_param("sssss", $nom, $prenom, $cin, $numero, $email);
        $stmt->execute();

        $fullname = $nom . " " . $prenom;
        $currentTime = date("Y-m-d H-i-s");
        $action = "Inscrit";
        $logsql = "INSERT INTO logs (action, nom, cin, time) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($logsql);
        $stmt->bind_param("ssss", $action, $fullname, $cin, $currentTime);
        $stmt->execute();

        $loginsertsql = "INSERT INTO loginscri (nom, prenom, cin, email, numero, etudiant, etablissement, theme, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($loginsertsql);
        $stmt->bind_param("sssssssss", $nom, $prenom, $cin, $email, $numero, $etudiant, $etablissement, $theme, $currentTime);
        $stmt->execute();

        $insertsql = "INSERT INTO users (email, password) VALUES (?, ?)";

        $stmt = $conn->prepare($insertsql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();

        $conn->query("COMMIT");
        // echo "<script>alert('Inscription complet!')</script>";
        return "Inscription complet!";
    } catch (Exception $ex) {
        $conn->query("ROLLBACK");
        header("location: /intern/main.php");
    }
    
}