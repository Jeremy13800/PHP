<?php
session_start();

$_SESSION['isConnected'] = 'On';

// Connexion à la base de données
require 'Database.php';

//recuperation de la classe
require_once 'userClass.php';

// Initialisation de l'objet 
$superUser = new User($pdo);

// Vérifier si un ID est passé dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID utilisateur invalide.");
}

$id = intval($_GET['id']);
$user = $superUser->getUserById($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $superUser->updateUser($id, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['role']);
    header("Location: index.php");
    exit;
}

// Récupérer les données actuelles de l'utilisateur
// $user = null;
// try {
//     $stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
//     $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//     $stmt->execute();
//     $user = $stmt->fetch();

//     if (!$user) {
//         die("Utilisateur non trouvé.");
//     }
// } catch (PDOException $e) {
//     die("Erreur lors de la récupération des données : " . $e->getMessage());
// }

// // Si le formulaire est soumis
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['role'])) {
//         try {
//             $stmt = $pdo->prepare("UPDATE user SET first_name = :first_name, last_name = :last_name, email = :email,password = :password ,role = :role WHERE id = :id");
//             $stmt->bindValue(':id', intval($_POST['id']), PDO::PARAM_INT);
//             $stmt->bindValue(':first_name', $_POST['first_name'], PDO::PARAM_STR);
//             $stmt->bindValue(':last_name', $_POST['last_name'], PDO::PARAM_STR);
//             $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
//             $stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
//             $stmt->bindValue(':role', $_POST['role'], PDO::PARAM_STR);

//             $stmt->execute();

//             // Redirection après mise à jour
//             header('Location: index.php');
//             exit;
//         } catch (PDOException $e) {
//             echo "Erreur de mise à jour : " . $e->getMessage();
//         }
//     } else {
//         echo "Erreur : Veuillez remplir tous les champs.";
//     }
// }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier Utilisateur</title>
</head>

<body>

    <h2>Modifier Utilisateur</h2>

    <?php if ($user): ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">

            <label for="first_name">Prénom :</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required><br>

            <label for="last_name">Nom :</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required><br>

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required><br>

            <label for="role">Rôle :</label>
            <input type="text" name="role" id="role" value="<?php echo htmlspecialchars($user['role']); ?>" required><br>

            <input type="submit" value="Mettre à jour">
        </form>
    <?php else: ?>
        <p>Utilisateur introuvable.</p>
    <?php endif; ?>

</body>

</html>