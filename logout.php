<?php
//$_SESSION['idUser'] = null;
session_start();
session_destroy();
header('location: index.php');
