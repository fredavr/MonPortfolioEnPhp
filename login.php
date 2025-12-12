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

require_once "includes/header.php"; ?>
<main>
    <div class="form-container">
        <div class="form-card">
            <h1>Se connecter</h1>
            <form method="post" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="form-password">
                        <input id="password" type="password" name="password" required>
                        <div class="password-icon">
                            <i class="fa-regular fa-eye-slash"></i>
                            <i class="fa-regular fa-eye"></i>
                        </div>
                    </div>

                </div>
                <button type="submit" class="submit-btn">Me connecter</button>
            </form>
        </div>
    </div>
</main>
<?php include_once "includes/footer.php"; ?>
<script src="script.js"></script>