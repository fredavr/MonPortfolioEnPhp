<?php
session_start();

// savoir si l'utilisateur est connecté
function isLoggedIn()
{
    return isset($_SESSION['idUser']);
};
