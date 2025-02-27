<?php
session_start();

$_SESSION['isConnected'] = 'On';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Connexion à la base de données
    $host = 'mysql';
    $dbname = 'letscook_php_db';
    $username = 'root';
    $password = 'root';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Définit le mode d'erreur PDO sur exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }


    // suppression d'un utilisateur

    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        echo "Erreur de suppression : " . $e->getMessage();
    }
}
