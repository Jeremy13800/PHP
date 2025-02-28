<?php

class Database
{
    private  $host = 'mysql';
    private  $dbname = 'letscook_php_db';
    private  $username = 'root';
    private  $password = 'root';
    private  $pdo;

    // Constructeur qui initialise la connexion
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die(" Erreur de connexion : " . $e->getMessage());
        }
    }

    // Méthode pour récupérer l'instance PDO
    public function getConnection()
    {
        return $this->pdo;
    }
}

// Exemple d'utilisation
$db = new Database();
$pdo = $db->getConnection();
