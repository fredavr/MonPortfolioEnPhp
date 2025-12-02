<?php
require_once "db/functions.php";

// récupérer les données du formulaire
$title = $_POST['title'];
$description = $_POST['description'];
$github_link = $_POST['github_link'];
$project_link = $_POST['project_link'];

// création du projet
$idprojects = setProject($title, $description, $github_link, $project_link);

// gestion des skills pour le projet créé
if (isset($_POST['skills']))
    foreach ($_POST['skills'] as $skill) {
        setProjectSkill($idprojects, $skill);
    }
