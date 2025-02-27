<?php
session_start();

$_SESSION['isConnected'] = 'On';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Connexion à la base de données
    require 'Database.php';


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
