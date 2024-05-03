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
        <div class="login">
            <form action="validate.php" method="POST">
                <label for="email">E-Mail</label>
                <input type="email" name="email" id="email">
                <br><label for="password">Mot de passe</label>
                <input type="password" name="password" id="password">
            </form>
        </div>
    </div>
</body>
</html>