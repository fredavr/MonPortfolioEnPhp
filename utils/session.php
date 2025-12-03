<?php
session_start();

// savoir si l'utilisateur est connecté
function isLoggedIn()
{
    return isset($_SESSION['idUser']);
};

function requireLogin()
{
    if (!isLoggedIn()) {
        header('location: login.php');
        exit;
    }
};
