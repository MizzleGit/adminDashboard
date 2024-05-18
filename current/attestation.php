<?php

require '../config/validate.php';

if (!isset($_GET["id"]) || empty($_GET["id"])){
    header("location: /current/current.php");
    exit();
}

$cin = $_GET["id"];
$conn = connect();
$conn->query("START TRANSACTION");
try {
    $selectsql = "SELECT nom, prenom FROM actuels WHERE cin = ?";
    
    $stmt = $conn->prepare($selectsql);
    $stmt->bind_param("s", $cin);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $nom = $data["nom"] . " " . $data["prenom"];

    $logsql = "INSERT INTO logs (action, nom, cin, time) VALUES (?, ?, ?, ?)";
    $currentTime = date("Y-m-d H-i-s");
    $finishedStr = "Completé";
    
    $stmt = $conn->prepare($logsql);
    $stmt->bind_param("ssss", $finishedStr, $nom, $cin, $currentTime);
    $stmt->execute();

    $removesql = "DELETE FROM actuels WHERE cin = ?";

    $stmt = $conn->prepare($removesql);
    $stmt->bind_param("s", $cin);
    $stmt->execute();

    $conn->query("COMMIT");
    header("location: /current/current.php");
    $conn->close();
    exit();

} catch (Exception $ex) {
    $conn->query("ROLLBACK");
    header("location: /current/current.php");
    exit();
}