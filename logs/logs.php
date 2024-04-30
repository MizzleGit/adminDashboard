<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../nav.css">
    <link rel="stylesheet" href="logs.css">
    <title>Logs</title>
</head>

<body>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="navbar-item"><img src="../cri.png" alt="Logo of CRI"></li>
            <li class="navbar-item"><a href="../dashboard/dashboard.php" class="nav-link">Dashboard</a></li>
            <li class="navbar-item"><a href="../search/search.html" class="nav-link">Advanced Search</a></li>
            <li class="navbar-item"><a href="../current/current.php" class="nav-link">Current interns</a></li>
            <li class="navbar-item active"><a href="../logs/logs.php" class="nav-link">Read Logs</a></li>
            <li class="navbar-item"><a href="#" class="nav-link">Disconnect</a></li>
        </ul>
    </nav>
    <main>
        <h1>Historique</h1>
        <div class="logs-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Informations personnelles</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="Refusé">Refusé</td>
                        <td>Ahmed Abdelaziz | DS177410 |<br>ahmedabdelaziz@gmail.com | 06 12 51 12 36</td>
                        <td>2024-03-15 | 14:33:22</td>
                    </tr>
                    <?php
                    $conn = mysqli_connect("localhost", "id22102457_root", "Nazih-abdelhak-2024", "id22102457_interndb");
                    $sql = "SELECT * FROM logs";

                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='" . $row["action"] . "'>" . $row["action"] . "</td>";
                        echo "<td>" . $row["info"] . "</td>";
                        echo "<td>" . date("Y-m-d H:i:s", strtotime($row["time"])) . "</td>";
                        echo "</tr>";
                    }
                    $conn->close();

                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>