<?php

if (isset($_SESSION['user'])) {
    header('Location: http://localhost/exo_php/Exo_Login/logged.php');
} else {
    session_start();

    $server = "localhost";
    $serverLogin = "root";
    $serverPassword = "";
    $databaseName = "exo_login";
    $port = 3306;


    try {
        $pdo = new PDO("mysql:dbname=$databaseName;host=$server;port:$port", "$serverLogin", "$serverPassword", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    } catch (PDOException $e) {
        print_r($e->getMessage());
    }


    $createLogin = $_POST['createLogin'];
    $createPassword = $_POST['createPassword'];
    $createFirstname = $_POST['createFirstname'];
    $createLastname = $_POST['createLastname'];
    $createSexe = $_POST['createSexe'];


    $sql = "INSERT INTO users (first_name, last_name, login, sexe, password) VALUES (:first_name, :last_name, :login, :sexe, :password)";


    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':first_name', $createFirstname);
    $stmt->bindParam(':last_name', $createLastname);
    $stmt->bindParam(':login', $createLogin);
    $stmt->bindParam(':sexe', $createSexe);
    $stmt->bindParam(':password', $createPassword);


    if ($stmt->execute()) {
        $_SESSION['user'] = $createLogin;
        $_SESSION['sexe'] = $createSexe;
        $_SESSION['firstname'] = $createFirstname;
        $_SESSION['lastname'] = $createLastname;
        header('Location: http://localhost/exo_php/Exo_Login/logged.php');
    } else {
        header('Location: http://localhost/exo_php/Exo_Login/createAccount.php');
    }
}

