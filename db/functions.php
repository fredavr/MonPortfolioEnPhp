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
                'idprojects' => $row['idprojects'],
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

function insertProject($title, $description, $github_link, $project_link)
{
    $pdo = getDBConnection();

    // Préparer la requête
    $sql = "INSERT INTO my_portfolio_php.projects (title, description, github_link, project_link) VALUES (:title, :description, :github_link, :project_link);";

    $stmt = $pdo->prepare($sql);

    // Exécuter avec les données
    $result = $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':github_link' => $github_link,
        ':project_link' => $project_link,
    ]);
    if ($result) {
        //retour vrai la requete est ok, on peut récupérer l'id créé
        $id = $pdo->lastInsertId();
    } else {
        $id = null;
    }

    return $id;
}

function insertProjectSkill($idproject, $idskill)
{
    $pdo = getDBConnection();

    // Préparer la requête
    $sql = "INSERT INTO my_portfolio_php.projects_skills (idproject, idskill) VALUES (:idproject, :idskill);";

    $stmt = $pdo->prepare($sql);

    // Exécuter avec les données
    $result = $stmt->execute([
        ':idproject' => $idproject,
        ':idskill' => $idskill,
    ]);

    return $result;
}

function deleteProject($idProjectToDelete)
{
    $pdo = getDBConnection();

    // Préparer la requête
    $sql = "DELETE FROM my_portfolio_php.projects WHERE projects.idprojects = :idProjectToDelete;";

    $stmt = $pdo->prepare($sql);

    // Exécuter avec les données
    $result = $stmt->execute([
        ':idProjectToDelete' => $idProjectToDelete,
    ]);


    return $result;
}

function getUserByEmail($email)
{
    $pdo = getDBConnection();

    $sql = "SELECT * FROM my_portfolio_php.users WHERE email = :email;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $email,
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
