<?php
session_start();

var_dump($_SESSION);

// var_dump($_REQUEST);
var_dump($_POST);

var_dump(!empty($_POST));
var_dump(isset($_POST));
var_dump(count($_POST) > 0);

// REVIEW: Vérifier si le formulaire a été soumis et traiter les données avant de les insérer dans la base de données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // NOTE require rend l'inclusion de Database.php obligatoire
    // Si le fichier Database.php est manquant ou contient une erreur, le script s'arrêtera immédiatement.
    require 'Database.php';

    try {
        // NOTE Nettoyage et validation des entrées utilisateur

        // NOTE trim() supprime les espaces avant et après la chaîne de caractères
        // Cela empêche qu'un utilisateur saisisse uniquement des espaces dans un champ
        $firstName = trim(htmlspecialchars($_POST['first-name'], ENT_QUOTES, 'UTF-8'));
        $lastName = trim(htmlspecialchars($_POST['last-name'], ENT_QUOTES, 'UTF-8'));

        // NOTE filter_input() avec FILTER_VALIDATE_EMAIL vérifie que l'email est valide
        // Retourne FALSE si l'email n'est pas au bon format
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        $password = $_POST['password']; // NOTE Le mot de passe sera haché avant l'insertion

        // NOTE trim() est appliqué au rôle pour éviter les espaces superflus
        $role = trim(htmlspecialchars($_POST['role'], ENT_QUOTES, 'UTF-8'));

        // NOTE Vérification que tous les champs sont bien remplis avant d'aller plus loin
        if (!$firstName || !$lastName || !$email || !$password || !$role) {
            throw new Exception("Tous les champs sont obligatoires !");
        }

        // NOTE password_hash() applique un hachage sécurisé au mot de passe
        // PASSWORD_DEFAULT utilise l'algorithme le plus récent recommandé par PHP
        // Cet algorithme peut évoluer dans les futures versions de PHP pour améliorer la sécurité
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // NOTE Préparation de la requête SQL pour insérer un nouvel utilisateur
        $stmt = $pdo->prepare("INSERT INTO user (first_name, last_name, email, password, role) 
                               VALUES (:first_name, :last_name, :email, :password, :role)");

        // NOTE Liaison des valeurs aux paramètres SQL avec bindValue()
        // bindValue() passe la valeur directement (pas de référence)
        // Cela évite les effets de bord liés à une modification ultérieure de la variable

        // NOTE PDO::PARAM_STR indique que la valeur est traitée comme une chaîne de caractères
        // Contrairement à ce qu'on pourrait penser, PDO::PARAM_STR **ne force pas la conversion**
        // Il indique uniquement au moteur de base de données comment interpréter la donnée envoyée
        $stmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':role', $role, PDO::PARAM_STR);

        // NOTE Exécution de la requête préparée
        $stmt->execute();
        $pdo = null;
        echo "Utilisateur ajouté avec succès !";
    } catch (Exception $e) {
        // NOTE Gestion des erreurs
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // NOTE Si la requête HTTP n'est pas de type POST, on affiche un message d'erreur
    echo "Veuillez remplir le formulaire.";
}


// header('Location: index.php');
// exit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>

</body>

</html>


<a href="index.php">Retour</a>