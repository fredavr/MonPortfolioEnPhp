<?php
require_once 'utils/session.php';
require_once "db/functions.php";

// Si le formulaire a été posté
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // simuler une connexion sans passer par la base de données
    if ($username == 'Fredo' and $password == 'Fred') {
        $_SESSION['idUser'] = $username;
        header('location: index.php');
    } else {
        echo "Mot de passe incorrect";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portfolio</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php require_once "includes/header.php"; ?>
    <main>
        <div class="form-container">
            <h1>Se connecter</h1>
            <form method="post" action="">
                <div class="form-zone">
                    <label for="username">Nom d'utilisateur</label>
                    <input id="username" type="text" name="username" required>
                </div>
                <div class="form-zone">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="text" name="password" required>
                </div>
                <button type="submit" class="submit-btn">Me connecter</button>
            </form>

    </main>
    <?php include_once "includes/footer.php"; ?>
</body>

</html>