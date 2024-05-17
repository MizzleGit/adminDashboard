<?php
require '../config/config.php';
require '../config/validate.php';
$conn = connect();

// Initialize id (CIN)
error_reporting(E_ALL);
ini_set('display_errors', 1);
$id = "";
$debut = "";
$fin = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /dashboard/dashboard.php");
        exit; 
    }


    // Initializing
    $id = $_GET["id"];
    $debut = $_GET["debut"];
    $fin = $_GET["fin"];
    $conn->query("START TRANSACTION");


    try{

        // Selection SAFE 
        $selectsql = "SELECT * FROM inscri WHERE cin = ?";

        $stmt = $conn->prepare($selectsql);
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $selected = $stmt->get_result();


        $row = $selected->fetch_assoc();

        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $cin = $row['cin'];
        $email = $row['email'];
        $numero = $row['numero'];
        $etudiant = $row['etudiant'];


        // INSERTION SAFE
        $insertsql = "INSERT INTO actuels (nom, prenom, cin, email, numero, etudiant, debut, fin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertsql);
        $stmt->bind_param("ssssssss", $nom, $prenom, $cin, $email, $numero, $etudiant, $debut, $fin);
        $stmt->execute();

        $inserted = $stmt->get_result();

        // LOGGIN SAFE
        $accepedstr = "Accepté";
        $currentTime = date("Y-m-d H-i-s");
        $fullname = $nom . " " . $prenom;

        $logsql = "INSERT INTO logs (action, nom, cin, time) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($logsql);
        $stmt->bind_param("ssss", $accepedstr, $fullname, $cin, $currentTime);
        $stmt->execute();
        $logged = $stmt->get_result();


        // Deletion SAFE
        $deletesql = "DELETE FROM inscri WHERE cin = ?";

        $stmt = $conn->prepare($deletesql);
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $deleted = $stmt->get_result();


        // Finalization
        $conn->query("COMMIT");
        header("location: /dashboard/dashboard.php");
        $conn->close();
    }
    catch(Exception $ex){
        $conn->query("ROLLBACK");
        echo $ex;
        $conn->close();
        exit();
    }



}
