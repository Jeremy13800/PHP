<?php
session_start(); // Démarrage de la session

// Vérification si l'utilisateur est bien connecté
if (!isset($_SESSION['email'])) {
    // Redirection vers form1.php si pas d'identification
    header("Location: form1.php");
    exit;
}

// Récupération de l'email de l'utilisateur connecté
$email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>

    <h2>Bienvenue sur la page protégée</h2>

    <p>Bienvenue, <?= htmlspecialchars($email); ?> ! Vous êtes bien connecté.</p>

    <a href="logout.php">Déconnexion</a>

</body>
</html>
