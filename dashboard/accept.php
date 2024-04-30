<?php
// Initialize id (CIN)
error_reporting(E_ALL);
ini_set('display_errors', 1);
$id = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /dashboard/dashboard.php");
        exit; 
    }


    // Initializing
    $id = $_GET["id"];
    $conn = mysqli_connect("localhost", "id22102457_root", "Nazih-abdelhak-2024", "id22102457_interndb");


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
        $currentDate = date("Y-m-d");


        // INSERTION SAFE
        $insertsql = "INSERT INTO actuels (nom, prenom, cin, email, numero, etudiant, debut) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertsql);
        $stmt->bind_param("sssssss", $nom, $prenom, $cin, $email, $numero, $etudiant, $currentDate);
        $stmt->execute();

        $inserted = $stmt->get_result();

        // Deletion SAFE
        $deletesql = "DELETE FROM inscri WHERE cin = ?";

        $stmt = $conn->prepare($deletesql);
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $deleted = $stmt->get_result();

        // Finalization
        sleep(1);
        header("location: /dashboard/dashboard.php");
    }
    catch(Exception $ex){
        echo $ex;
        exit();
    }



}
