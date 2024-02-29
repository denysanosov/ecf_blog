<?php
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {

        if (isset($_POST['postId'])) {
            require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Connexion.php';

            $maConnexion = new Connexion();
            $maConnexion->connect();
            $connexion = $maConnexion->getConnexion();
            $postId = $_POST['postId'];
        
            $sql = "DELETE FROM posts WHERE id = ?";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$postId]);
        
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    } else {
        header('Location: login');
    }
} else {
    header('Location: login');
}