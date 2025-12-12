<?php
require_once 'utils/session.php';
require_once "db/functions.php";
if (isLoggedIn()) {
    // Si le formulaire a été posté
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // récupérer les données du formulaire
        $idProjectToDelete = $_POST['idProjectToDelete'];
        $success = deleteProject($idProjectToDelete);
    }
};

require_once "includes/header.php";
?>
<main>
    <section id="Hero" class="hero-section">
        <div class="hero-content">
            <h1>Développer l'avenir sans effacer la nature</h1>
            <h2>Frédérique Avrillon</h2>
            <p>Je peux vous aider à concrétiser vos idées, vos envies, vos besoins ...</p>
            <p>en respectant au mieux la planète et tous ses habitants ...</p>
            <p>Il est grandement temps !</p>
        </div>
        <img src="./img/logo/birlicolocoe.svg" alt="photo de profil Fred">
    </section>
    <section id="MyProjects" class="projects">
        <?php if (isset($success)):
            if ($success): ?>
                <div class="alert success">Le projet a bien été supprimé</div>
            <?php else: ?>
                <div class="alert error">Une erreur a été rencontrée lors de la suppression du projet !</div>

        <?php endif;
        endif; ?>
        <h2>Mes projets</h2>
        <div class="list-projects">
            <?php
            $projects = getAllProjects();
            foreach ($projects as $row) : ?>
                <article class="project">
                    <!--Bouton delete si on est connecté -->
                    <?php if (isLoggedIn()): ?>
                        <form action="" method="post">
                            <input type="hidden" name="idProjectToDelete" value="<?php echoValue($row, 'idprojects'); ?>">
                            <input class="delete-btn" type="submit" value="Delete">
                        </form>
                    <?php endif ?>

                    <!--Titre -->
                    <h3>
                        <?php echoValue($row, 'title'); ?>
                    </h3>
                    <!--Description -->
                    <p class="description">
                        <?php echoValue($row, 'description'); ?>
                    </p>
                    <div class="project-skills">
                        <?php foreach ($row['skills'] as $skill): ?>
                            <div><?php echo $skill ?></div>
                        <?php endforeach; ?>

                    </div>
                    <div class="link">
                        <!--Lien github -->
                        <a href="<?php echoValue($row, 'github_link'); ?>" class="btn-link github" target="_blank">github</a>
                        <!--Lien projet -->
                        <a href="<?php echoValue($row, 'project_link'); ?>" class="btn-link project-url" target="_blank">Voir</a>
                    </div>
                    <!--Technos -->

                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="skills" class="skills">
        <h2>Mes competences</h2>
        <div class="list-skills">
            <?php
            $skills = getAllSkills();
            foreach ($skills as $row) : ?>
                <article class="skill">
                    <?php if ($row['logo'] == null): ?>
                        <h3>
                            <?php echoValue($row, 'name'); ?>
                        </h3>
                    <?php else: ?>
                        <p class="img">
                            <img
                                src="<?php echoValue($row, 'logo'); ?>"
                                alt="<?php echoValue($row, 'name'); ?>">
                        </p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>

    </section>
    <section class="references"></section>
</main>
<?php include_once "includes/footer.php"; ?>