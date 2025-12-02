<?php
require_once "db/db_connect.php";

function getAllProjects()
{
    $pdo = getDBConnection();

    $sql = "SELECT * FROM my_portfolio_php.projects proj
            LEFT JOIN my_portfolio_php.projects_skills projski ON proj.idprojects = projski.idproject
            LEFT JOIN my_portfolio_php.skills ON skills.idskills = projski.idskill;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $projects = [];
    foreach ($result as $row) {
        // Est-ce que le projet est dans le tableau
        // s'il n'y est pas, on l'ajoute + le skill
        if (isset($projects[$row['idprojects']]) == false) {
            $project = [
                'title' => $row['title'],
                'description' => $row['description'],
                'github_link' => $row['github_link'],
                'project_link' => $row['project_link'],
                'skills' => [],
            ];
            $projects[$row['idprojects']] = $project;
        }
        // un skill est il présent dans la row ?
        // oui on ajoute son nom dans la tableau skills
        if (isset($row['idskills'])) {
            // ajpouter le skill
            $projects[$row['idprojects']]['skills'][] = $row['name'];
        }
    }

    return $projects;
}

function getAllSkills()
{
    $pdo = getDBConnection();

    $sql = "SELECT * FROM my_portfolio_php.skills;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    return $result;
}

function echoValue($row, $name)
{
    echo htmlspecialchars($row[$name], ENT_QUOTES, 'UTF-8') . "\t";
}

function setProject($title, $description, $github_link, $project_link)
{
    $pdo = getDBConnection();

    // Préparer la requête
    $sql = "INSERT INTO my_portfolio_php.projects (title, description, github_link, project_link) VALUES (:title, :description, :github_link, :project_link);";

    $stmt = $pdo->prepare($sql);

    // Exécuter avec les données
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':github_link' => $github_link,
        ':project_link' => $project_link,
    ]);
    $id = $pdo->lastInsertId();

    echo "Inscription réussie !";

    return $id;
}

function setProjectSkill($idproject, $idskill)
{
    $pdo = getDBConnection();

    // Préparer la requête
    $sql = "INSERT INTO my_portfolio_php.projects_skills (idproject, idskill) VALUES (:idproject, :idskill);";

    $stmt = $pdo->prepare($sql);

    // Exécuter avec les données
    $stmt->execute([
        ':idproject' => $idproject,
        ':idskill' => $idskill,
    ]);

    echo "Inscription skill réussie !";

    return true;
}
