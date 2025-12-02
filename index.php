<?php require_once "db/functions.php"; ?>
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
        <section id="Hero" class="hero-section">
            <div>
                <h1>Développer l'avenir sans effacer la nature</h1>
                <h2>Frédérique Avrillon</h2>
                <p>Je peux vous aider à concrétiser vos idées, vos envies, vos besoins ...</p>
                <p>en respectant au mieux la planète et tous ses habitants ...</p>
                <p>Il est grandement temps !</p>
            </div>
            <img src="./img/logo/birlicolocoe.svg" alt="photo de profil Fred">
        </section>
        <section id="MyProjects" class="projects">
            <h2>Mes projets</h2>
            <div class="list-projects">
                <?php
                $projects = getAllProjects();
                foreach ($projects as $row) : ?>
                    <article class="project">
                        <!--Image -->
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
                            <a href="<?php echoValue($row, 'github_link'); ?>">github</a>
                            <!--Lien projet -->
                            <a href="<?php echoValue($row, 'project_link'); ?>">Voir</a>
                        </div>
                        <!--Technos -->

                    </article>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="skills">
            <h2>Mes skills</h2>
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
</body>

</html>