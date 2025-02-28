<?php
session_start();

// base de donnée
require_once 'Database.php';

//recuperation de la classe
require_once 'userClass.php';

// Initialisation de l'objet 
$superUser = new User($pdo);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $superUser->deleteUser($_GET['id']);
}

header("Location: index.php");
exit;


//-------------------------------------------------------------------------------------------------------------------------------------//
?>









// $_SESSION['isConnected'] = 'On';
// if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
// // Connexion à la base de données
// require 'Database.php';


// // suppression d'un utilisateur

// $id = $_GET['id'];
// try {
// $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
// $stmt->bindParam(':id', $id);

// $stmt->execute();
// header('Location: index.php');
// exit();
// } catch (PDOException $e) {
// echo "Erreur de suppression : " . $e->getMessage();
// }
// }