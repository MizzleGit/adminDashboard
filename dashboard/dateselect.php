<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dateselect.css">
    <title>Debut / Fin</title>
</head>

<body>
    <div class="wrapper">
        <form action="accept.php" method="get">
            <div class="cin-div">
                <input type="text" readonly name="id" value="<?php echo $_GET['id']; ?>">
            </div>
            <div class="debut-div">
                <label for="debut">Date debut: </label>
                <input type="date" name="debut" value=<?php echo date("Y-m-d"); ?>>
            </div>
            <div class="fin-div">
                <label for="fin">Date fin: </label>
                <input type="date" name="fin" value=<?php echo date("Y-m-d", strtotime("+2 month")); ?>>
            </div>
            <div class="submit-div">
                <input type="submit" value="Ajouter dates">
            </div>
        </form>
    </div>
</body>

</html>