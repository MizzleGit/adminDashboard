<?php
require '../config/config.php';
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
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <div class="login-div">
            <form action="" method="POST">
                <div class="email-div">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" id="email" value=<?php echo @$_POST["email"]; ?>>
                </div>
                <div class="pass-div">
                    <br><label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" value=<?php echo @$_POST["password"]; ?>>
                </div>
                <div class="submit-div">
                    <input id="submit" name="submit" type="submit" value="Connexion">
                </div>
            </form>
            <div class="error-div">
                <?php echo @$response; ?>
            </div>
        </div>
    </div>
</body>

</html>