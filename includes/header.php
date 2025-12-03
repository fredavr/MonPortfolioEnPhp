<header class="site-header">
    <div class="logo">
        <img src="../img/logo/birlicolocoe.svg" alt="Logo de BirlicoLocoe">
        <a href="#MyProjects">BirlicoLocoe</a>
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="/index.php">Accueil</a></li>
            <li><a href="/index.php#MyProjects">Mes projets</a></li>
            <li><a href="/index.php#skills">Mes compétences</a></li>
            <?php if (isLoggedIn()): ?>
                <li><a href="/createproject.php">Créer un projet</a></li>
            <?php endif ?>

        </ul>
    </nav>
    <div class="cta">
        <?php if (isLoggedIn()): ?>
            <a href="/logout.php" class="btn-primary">Se déconnecter</a>
        <?php else: ?>
            <a href="/login.php" class="btn-primary">Se connecter</a>
        <?php endif ?>
    </div>
</header>