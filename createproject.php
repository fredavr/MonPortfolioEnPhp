<?php
require_once 'utils/session.php';
require_once "db/functions.php";
requireLogin();


$message = null;
// Si le formulaire a été posté
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // récupérer les données du formulaire
    $title = $_POST['title'];
    $description = $_POST['description'];
    $github_link = $_POST['github_link'];
    $project_link = $_POST['project_link'];

    // création du projet
    $idprojects = insertProject($title, $description, $github_link, $project_link);
    if ($idprojects != null) {
        $success = true;
        $message = "Le projet " . $title . " a été créé";
        // gestion des skills pour le projet créé
        $nbSkills = 0;
        if (isset($_POST['skills'])) {
            foreach ($_POST['skills'] as $skill) {
                $result = insertProjectSkill($idprojects, $skill);
                if ($result) {
                    $nbSkills += 1;
                }
            }
        }
        $message .= " avec " . $nbSkills . " skills";
    } else {
        $success = false;
        $message = "Un problème a été rencontré lors de la création du projet !";
    }
}
require_once "includes/header.php"; ?>

<div class="form-container">
    <?php if (isset($success)):
        if ($success): ?>
            <div class="alert success"><?php echo $message ?> </div>
        <?php else: ?>
            <div class="alert error"><?php echo $message ?></div>

    <?php endif;
    endif; ?>

    <h1>Création d'un projet pour mon portfolio</h1>
    <form method="post" action="">
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