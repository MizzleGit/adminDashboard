<?php
require "../config/validate.php";
if (!isset($_SESSION["email"])) {
    header("location /intern/main.php");
    exit();
}
$email = $_SESSION["email"];
$conn = connect();
$getcin = "SELECT cin FROM info WHERE email = ? ";

$stmt = $conn->prepare($getcin);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$result = $result->fetch_assoc();
$cin = $result["cin"];



// INFO
$infosql = "SELECT * FROM info WHERE cin = ?";
$stmt = $conn->prepare($infosql);
$stmt->bind_param("s", $cin);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$nom = $data["nom"];
$prenom = $data["prenom"];
$numero = $data["numero"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="info.css">
    <title><?php echo @$nom . " " . @$prenom; ?></title>
</head>

<body>
    <header>
        <h1>Bienvenue <?php echo "$nom $prenom"; ?></h1>
    </header>
    <main>
        <div class="div-info">
            <table>
                <thead>
                    <tr>
                        <th>
                            Nom
                        </th>
                        <th>
                            Prenom
                        </th>
                        <th>
                            CIN
                        </th>
                        <th>
                            Numero
                        </th>
                        <th>
                            Email
                        </th>
                    </tr>
                </thead>
                <!-- Remove after design -->
                <tbody>
                    <tr>
                        <td><?php echo "$nom"; ?></td>
                        <td><?php echo "$prenom"; ?></td>
                        <td><?php echo "$cin"; ?></td>
                        <td><?php echo "$numero"; ?></td>
                        <td><?php echo "$email"; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>



        <div class="div-inscri">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>E-Mail</th>
                        <th>Etablissement</th>
                        <th>Theme</th>
                        <th>Horodatage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $inscrisql = "SELECT * FROM loginscri WHERE cin = ? ORDER BY id DESC";

                    $stmt = $conn->prepare($inscrisql);
                    $stmt->bind_param("s", $cin);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    if ($data == null){
                        echo "<tr>";
                        echo "<td colspan='5'>Pas d'inscriptions!</td>";
                        echo "</tr>";
                    }
                    else{
                        foreach ($data as $row){
                            echo "<tr>";
                            echo "<td>Inscription</td>";
                            echo '<td>' . $row["email"] . '</td>';
                            echo '<td>' . $row["etablissement"] . '</td>';
                            echo '<td>' . $row["theme"] . '</td>';
                            echo '<td>' . $row["time"]. '</td>';
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>



        <div class="div-logs">
            <table>
                <thead>
                    <tr>
                        <th>
                            Action
                        </th>
                        <th>
                            Horodatage
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $logsql = "SELECT * FROM logs WHERE cin = ? ORDER BY id DESC";
                    $stmt = $conn->prepare($logsql);
                    $stmt->bind_param("s", $cin);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    if ($data == null){
                        echo "<tr>";
                        echo "<td colspan='2'>Pas d'historique!</td>";
                        echo "</tr>";
                    }
                    else{
                        foreach ($data as $row){
                            echo "<tr>";
                            echo '<td>' . $row["action"] . '</td>';
                            echo '<td>' . $row["time"] . '</td>';
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>