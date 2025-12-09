<?php

function getDBConnection()
{
    $config = require 'config.php';
    try {
        //phpinfo();
        $user = $config['DB_USER'];
        $pass = $config['DB_PASS'];
        $host = $config['DB_HOST'];
        $dbname = $config['DB_NAME'];

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        // echo ('OK');
        return $pdo;
    } catch (PDOException $e) {
        die('Erreur lors de la connexion à la BDD : ' . $e->getMessage());
    }
}
