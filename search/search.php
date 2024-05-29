<?php
require '../config/validate.php';

if (!isset($_SESSION["email"])) {
    header("location: ../login/login.php");
}

if (isset($_GET["cin"])) {
    $cin = $_GET["cin"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../nav.css">
    <link rel="stylesheet" href="search.css">
    <title>Search</title>
</head>

<body>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="navbar-item"><img src="../cri.png" alt="Logo of CRI"></li>
            <li class="navbar-item "><a href="../dashboard/dashboard.php" class="nav-link"><svg class="mobile-icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg><span>Nouveaux stagiaires</span></a></li>
            <li class="navbar-item active"><a href="../search/search.php" class="nav-link"><svg class="mobile-icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg><span>Recherche</span></a></li>
            <li class="navbar-item"><a href="../current/current.php" class="nav-link"><svg class="mobile-icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg><span>Stagiaires actuels</span></a></li>
            <li class="navbar-item"><a href="../logs/logs.php" class="nav-link"><svg class="mobile-icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/></svg><span>Historique</span></a></li>
            <li class="navbar-item"><a href="../config/logout.php" class="nav-link"><svg class="mobile-icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg><span>Déconnecter</span></a></li>
        </ul>
    </nav>
    <main>
        <section class="search">
            <form action="" method="GET">
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                    </svg>
                </div>
                <input type="search" name="cin" id="cin" placeholder="Entrez un CIN">
                <input type="submit" name="submit" id="submit" value="Rechercher">
            </form>
        </section>
        <section class="tables">
            <?php
            if (!isset($cin)) {
                return;
            } else {
                echo '<div class="info">';
                echo '<table><thead><tr><th>Nom</th><th>Prenom</th><th>CIN</th><th>Numero</th><th>Email</th></tr></thead>';
                echo '<tbody>';
                $conn = connect();

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
                $email = $data["email"];
                echo '<tr>';
                echo '<td>' . $nom . '</td>';
                echo '<td>' . $prenom . '</td>';
                echo '<td>' . $cin . '</td>';
                echo '<td>' . $numero . '</td>';
                echo '<td>' . $email . '</td>';
                echo '</tr>';
                echo '</tbody></table></div>';
            }
            ?>
            </div>
            <?php
            if (!isset($cin)) {
                return;
            } else {
                echo '<div class="inscri">';
                echo '<table><thead><tr><th></th><th>E-Mail</th><th>Etablissement</th><th>Theme</th><th>Horodatage</th></tr></thead>';
                echo '<tbody>';

                $inscrisql = "SELECT * FROM loginscri WHERE cin = ? ORDER BY id DESC";

                $stmt = $conn->prepare($inscrisql);
                $stmt->bind_param("s", $cin);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                if ($data == null) {
                    echo "<tr>";
                    echo "<td colspan='5'>Pas d'inscriptions!</td>";
                    echo "</tr>";
                } else {
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>Inscription</td>";
                        echo '<td>' . $row["email"] . '</td>';
                        echo '<td>' . $row["etablissement"] . '</td>';
                        echo '<td>' . $row["theme"] . '</td>';
                        echo '<td>' . $row["time"] . '</td>';
                        echo "</tr>";
                    }
                }
                echo '</tbody></table></div>';
            }
            ?>
                <?php
                if (!isset($cin)) {
                    return;
                } else {
                    echo '<div class="logs">';
                    echo '<table><thead><tr><th>Action</th><th>Horodatage</th></tr></thead><tbody>';

                    $logsql = "SELECT * FROM logs WHERE cin = ? ORDER BY id DESC";
                    $stmt = $conn->prepare($logsql);
                    $stmt->bind_param("s", $cin);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    if ($data == null) {
                        echo "<tr>";
                        echo "<td colspan='2'>Pas d'historique!</td>";
                        echo "</tr>";
                    } else {
                        foreach ($data as $row) {
                            echo "<tr>";
                            echo '<td>' . $row["action"] . '</td>';
                            echo '<td>' . $row["time"] . '</td>';
                            echo "</tr>";
                        }
                    }
                    echo '</tbody></table></div>';
                }
                ?>
            </div>

        </section>
    </main>
</body>

</html>