<?php
require "../config/validate.php";

if (isset($_POST["login"])) {
    $loginResponse = loginUser($_POST["loginemail"], $_POST["loginpassword"]);
    echo "<script>alert('$loginResponse');</script>";
}

if (isset($_POST["signup"])) {
    $signupResponse = signupUser($_POST["nom"], $_POST["prenom"], $_POST["cin"], $_POST["email"], $_POST["numero"], $_POST["etablissement"], $_POST["theme"], $_POST["password"]);
    echo "<script>alert('$signupResponse');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="internSelection.css">
    <script src="internSelection.js"></script>
    <title>Stage</title>
</head>

<body>
    <div class="login-left">
        <div id="signup-selected-left-div" onclick="switchBack()">

        </div>
        <button id="login-selected" onclick="loginSelected()" class="custom-button">Suivi votre demande</button>
        <div id="login-back">
            <button class="back-button" onclick="switchBack()">&#8249</button>
        </div>
        <div id="login-form">
            <form action="" method="POST">
                <h1>Connexion</h1>
                <div class="login-form-email login-form-input">
                    <input name="loginemail" type="text" placeholder="E-Mail" required>
                </div>
                <div class="login-form-pass login-form-input">
                    <input name="loginpassword" type="password" placeholder="Mot de passe" required>
                </div>
                <div class="login-form-submit">
                    <input name="login" type="submit" value="Se connecter">
                </div>
            </form>
        </div>
    </div>
    <div class="signup-right">
        <div id="login-selected-right-div" onclick="switchBack()">

        </div>
        <button id="signup-selected" onclick="signupSelected()" class="custom-button">S'inscrire pour un stage</button>
        <div id="signup-back">
            <button class="back-button" onclick="switchBack()">&#8249</button>
        </div>
        <div id="signup-form">
            <form action="" method="POST">
                <h1>S'inscrire</h1>
                <div class="signup-form-input signup-form-name">
                    <input class="signup-visible-inputs" type="text" name="nom" id="nom" placeholder="Nom" required>
                </div>

                <div class="signup-form-input signup-form-firstname">
                    <input class="signup-visible-inputs" type="text" name="prenom" id="prenom" placeholder="Prenom" required>
                </div>

                <div class="signup-form-input signup-form-cin">
                    <input class="signup-visible-inputs" type="text" name="cin" id="cin" placeholder="CIN" required>
                </div>

                <div class="signup-form-input signup-form-email">
                    <input class="signup-visible-inputs" type="email" name="email" id="email" placeholder="E-Mail" required>
                </div>

                <div class="signup-form-input signup-form-numero">
                    <input class="signup-visible-inputs" type="text" name="numero" id="numero" placeholder="Numero" required>
                </div>

                <div class="signup-form-input signup-form-etablissement">
                    <input class="signup-visible-inputs" type="text" name="etablissement" id="etablissement" placeholder="Établissement" required>
                </div>

                <div class="signup-form-input signup-form-password">
                    <input class="signup-visible-inputs" type="password" name="password" id="password" placeholder="Mot de passe" required>
                </div>

                <div class="signup-form-input">
                    <select name="theme" id="theme" required>
                        <option value="" disabled selected>Choisir Theme</option>
                        <option value="Développement d'applications mobiles">Développement d'applications mobiles</option>
                        <option value="Analyse de données et visualisation">Analyse de données et visualisation</option>
                        <option value="Développement de site Web">Développement de site Web</option>
                        <option value="Étude de marché et marketing digital">Étude de marché et marketing digital</option>
                    </select>
                </div>

                <div class="signup-submit">
                    <input name="signup" value="S'inscrire" class="signup-submit-button" type="submit">
                </div>
            </form>
        </div>
    </div>
</body>

</html>