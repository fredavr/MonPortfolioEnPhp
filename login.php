<?php
require_once 'utils/session.php';
require_once "db/functions.php";

// Si le formulaire a été posté
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Récupérer l'utilisateur avec l'email et vérifier le mot de passe
    $user = getUserByEmail($email);

    if ($user and $password == password_verify($password, $user['password'])) {
        $_SESSION['idUser'] = $user['idusers'];
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
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required>
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