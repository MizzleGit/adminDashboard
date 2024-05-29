<?php
require '../config/validate.php';
$conn = connect();

if (isset($_POST["submit"])) {
    $response = loginAdmin($_POST["email"], $_POST["password"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <title>Admin</title>
</head>

<body>
    <form action="" method="POST">
        <div class="h1-div">
            <h1>Admin</h1>
        </div>
        <div class="email-div">
            <input type="email" name="email" id="email" placeholder="E-Mail" value=<?php echo @$_POST["email"]; ?>>
        </div>
        <div class="password-div">
            <input type="password" name="password" id="password" placeholder="Mot de passe" value=<?php echo @$_POST["password"]; ?>>
        </div>
        <div class="submit-div">
            <input name="submit" type="submit" value="Connexion">
        </div>
        <div class="error-div">
            <?php
            if (!empty($response)) {
                echo "❌" . @$response;
            }
            ?>
        </div>
    </form>
</body>

</html>