<?php

class Connexion {
    private string $server = "localhost";
    private string $serverLogin = "root";
    private string $serverPassword = "";
    private string $databaseName = "ecf";
    private int $port = 3306;
    private $connexion;


    public function connect() {
        try {
            $this->connexion = new PDO("mysql:dbname=$this->databaseName;host=$this->server;port:$this->port", "$this->serverLogin", "$this->serverPassword", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    public function getConnexion() {
        return $this->connexion;
    }
}