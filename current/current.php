<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">    
    <link rel="stylesheet" href="current-table.css">
    <link rel="stylesheet" href="../nav.css">
    <title>Current</title>
</head>
<body>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="navbar-item"><img src="../cri.png" alt="Logo of CRI"></li>
            <li class="navbar-item"><a href="../index.php" class="nav-link">Dashboard</a></li>
            <li class="navbar-item"><a href="../search/search.html" class="nav-link">Advanced Search</a></li>
            <li class="navbar-item active"><a href="../current/current.html" class="nav-link">Current interns</a></li>
            <li class="navbar-item"><a href="../logs/logs.html" class="nav-link">Read Logs</a></li>
            <li class="navbar-item"><a href="#" class="nav-link">Disconnect</a></li>
        </ul>
    </nav>
    <main>
        <h1>Liste des stagiaires actuels</h1>
        <div class="div-table">
            <table class="table">
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
                            Email
                        </th>
                        <th>
                            Numero
                        </th>
                        <th>
                            Etudiant
                        </th>
                        <th>
                            Debut
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Abdelhak</td>
                        <td>Abdelaziz</td>
                        <td>SH182976</td>
                        <td>baityounes@gmail.com</td>
                        <td>+212672729112</td>
                        <td>Oui</td>
                        <td>2024-6-1</td>
                    </tr>
                    <?php
                    $conn = mysqli_connect("localhost", "id22102457_root", "Nazih-abdelhak-2024", "id22102457_interndb");
                    $sql = "SELECT * FROM actuels";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>" . $row["nom"] . "</td>";
                            echo "<td>" . $row["prenom"] . "</td>";
                            echo "<td>" . $row["cin"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["numero"] . "</td>";
                            echo "<td>" . $row["etudiant"] . "</td>";
                            echo "<td>" . $row["date"]->format("Y-m-d H:i:s") . "</td>";
                            echo "</tr>";
                        }
                    }
                    else{
                        // echo "ERROR";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>