<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../nav.css">
    <link rel="stylesheet" href="dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="navbar-item"><img src="../cri.png" alt="Logo of CRI"></li>
            <li class="navbar-item active"><a href="../dashboard/dashboard.php" class="nav-link">Dashboard</a></li>
            <li class="navbar-item"><a href="../search/search.html" class="nav-link">Advanced Search</a></li>
            <li class="navbar-item"><a href="../current/current.php" class="nav-link">Current interns</a></li>
            <li class="navbar-item"><a href="../logs/logs.html" class="nav-link">Read Logs</a></li>
            <li class="navbar-item"><a href="#" class="nav-link">Disconnect</a></li>
        </ul>
    </nav>
    <main>
        <h1>Liste des stagiaires inscrits</h1>
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
                            Accepter
                        </th>
                        <th>
                            Refuser
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Abdelhak</td>
                        <td>Abdelaziz</td>
                        <td>SH182976</td>
                        <td>emailemail@gmail.com</td>
                        <td>+212672729112</td>
                        <td>Oui</td>
                        <td><a class="link-accepted" href=""><img class="icons" src="accepted.svg" alt="accepted"></a></td>
                        <td><a class="link-rejected" href=""><img class="icons" src="rejected.svg" alt="rejected"></a></td>
                    </tr>
                    <?php

                    $conn = mysqli_connect("localhost", "id22102457_root", "Nazih-abdelhak-2024", "id22102457_interndb");
                    $sql = "SELECT * FROM inscri";

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
                            echo "<td>" . '<a class="link-accepted" href="./accept.php?id=' . $row["cin"] . '"><img class="icons" src="accepted.svg" alt="accepted"></a>' . "</td>";
                            echo "<td>" . '<a class="link-rejected" href="./reject.php?id=' . $row["cin"] . '"><img class="icons" src="rejected.svg" alt="rejected"></a>' . "</td>";
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