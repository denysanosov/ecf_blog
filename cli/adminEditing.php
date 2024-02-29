<?php
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Connexion.php';

            $maConnexion = new Connexion();
            $maConnexion->connect();
            $connexion = $maConnexion->getConnexion();

            $postId = $_POST['postId'];
            $title = $_POST['title'];
            $body = $_POST['body'];
            date_default_timezone_set('Europe/Paris');
            $now = date("Y-m-d H:i:s");

            if (empty($title) || empty($body)) {
                header("Location: adminEdit?id={$postId}&error=emptyfields");
                exit();
            } else {
                $sql = "UPDATE posts SET title=?, body=?, createdAt = ? WHERE id=?";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([$title, $body, $now, $postId]);
                header("Location: adminEdit?id={$postId}&success=update");
                exit();
            }
        } else {
            header("Location: adminEdit?error=accessdenied");
            exit();
        }
    } else {
        header('Location: login');
    }
} else {
    header('Location: login');
}