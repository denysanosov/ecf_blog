<?php

session_start();

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Connexion.php';

$maConnexion = new Connexion();
$maConnexion->connect();
$connexion = $maConnexion->getConnexion();

$loginUser = $_POST['username'];
$loginPassword = $_POST['password'];

$query = $connexion->prepare("SELECT name, username, role FROM user WHERE username = :login AND password = :password");

$query->bindParam(':login', $loginUser);
$query->bindParam(':password', $loginPassword);

$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $_SESSION['username'] = $result['username'];
    $_SESSION['role'] = $result['role'];

    header('Location: index.php');
} else {
    $_SESSION['connexionError'] = true;
    header('Location: login.php');
}