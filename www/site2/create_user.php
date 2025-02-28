<?php
session_start();
require_once 'Database.php';
require_once 'userClass.php';

// Vérifier si la requête est bien un POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// Connexion à la base de données
$db = new Database();
$pdo = $db->getConnection();
$superUser = new User($pdo);

// Récupération et validation des données du formulaire
$role = isset($_POST["role"]) ? htmlspecialchars($_POST["role"]) : null;
$firstName = isset($_POST["first-name"]) ? htmlspecialchars($_POST["first-name"]) : null;
$lastName = isset($_POST["last-name"]) ? htmlspecialchars($_POST["last-name"]) : null;
$email = isset($_POST["email"]) ? filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) : null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;

// Vérification des champs obligatoires
if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($role)) {
    $_SESSION['error_message'] = "Tous les champs doivent être remplis.";
    header("Location: error_page.php");
    exit;
}

// Vérification de l'email
if (!$email) {
    $_SESSION['error_message'] = "L'email fourni est invalide.";
    header("Location: error_page.php");
    exit;
}

// Sécurisation du mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // Création de l'utilisateur
    if ($superUser->addUser($firstName, $lastName, $email, $hashedPassword, $role)) {
        $_SESSION['message'] = "Utilisateur créé avec succès.";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Erreur lors de la création de l'utilisateur.";
        header("Location: error_page.php");
        exit;
    }
} catch (PDOException $e) {
    error_log("Erreur SQL : " . $e->getMessage()); // Log en arrière-plan
    $_SESSION['error_message'] = "Une erreur s'est produite. Veuillez réessayer.";
    header("Location: error_page.php");
    exit;
}
