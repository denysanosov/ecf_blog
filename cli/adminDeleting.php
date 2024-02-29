<?php
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {

        if (isset($_POST['postId'])) {
            require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Connexion.php';

            $maConnexion = new Connexion();
            $maConnexion->connect();
            $connexion = $maConnexion->getConnexion();
            // Récupérer l'ID du post à supprimer
            $postId = $_POST['postId'];
        
            // Supprimer le post de la base de données
            // $pdo = $connexion->getPDO();
        
            $sql = "DELETE FROM posts WHERE id = ?";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$postId]);
        
            // Répondre avec un statut HTTP 200 (OK) pour indiquer que la suppression a réussi
            http_response_code(200);
        } else {
            // Si l'ID du post à supprimer n'a pas été envoyé, répondre avec un statut HTTP 400 (Bad Request)
            http_response_code(400);
        }
    } else {
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}