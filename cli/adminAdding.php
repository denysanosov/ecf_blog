<?php
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {

            require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Connexion.php';

            $maConnexion = new Connexion();
            $maConnexion->connect();
            $connexion = $maConnexion->getConnexion();

            

    } else {
        header('Location: login');
    }
} else {
    header('Location: login');
}