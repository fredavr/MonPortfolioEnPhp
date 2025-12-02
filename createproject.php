<?php require_once "db/functions.php"; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un projet</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php require_once "includes/header.php"; ?>
    <div class="form-container">
        <h1>Création d'un projet pour mon portfolio</h1>
        <form method="post" action="traiteForm.php">
            <div class="form-project">
                <div class="form-zone">
                    <label for="title">Titre</label>
                    <input id="title" type="text" name="title" placeholder="Titre du nouveau projet" required>
                </div>
                <div class="form-zone">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Décrire le nouveau projet" required></textarea>
                </div>
                <div class="form-zone">
                    <label for="github_link">Lien github</label>
                    <input id="github_link" type="url" name="github_link" placeholder="https://github.com/...">
                </div>
                <div class="form-zone">
                    <label for="project_link">Lien du projet</label>
                    <input id="project_link" type="url" name="project_link" placeholder="https://exemple.fr">
                </div>
            </div>
            <div class="form-skills">
                <fieldset class="form-zone">
                    <legend>Cocher les skills</legend>
                    <?php
                    $skills = getAllSkills();
                    foreach ($skills as $row) : ?>
                        <div class="form-skill">
                            <input id="<?php echoValue($row, 'name'); ?>" type="checkbox" name="skills[]" value="<?php echoValue($row, 'idskills'); ?>">
                            <label for="<?php echoValue($row, 'name'); ?>"><?php echoValue($row, 'name'); ?></label>
                        </div>
                    <?php endforeach; ?>
                </fieldset>
            </div>
            <button type="submit" class="submit-btn">Créer le projet</button>
        </form>
    </div>
    <?php include_once "includes/footer.php"; ?>
</body>

</html>