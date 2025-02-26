<?php
// Initialisation des variables
$msg = "Veuillez entrer vos identifiants."; // Message par défaut
$erreur = false; // Indicateur d'erreur

// Tableau des utilisateurs valides (email => password)
$utilisateurs = [
    "jean_valjean@academie.net" => "hugo",
    "steve_ostin@lesseries.org" => "3md",
    "david_banner@marvel.com" => "hulk"
];

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Vérification si les champs sont vides
    if (empty($email) || empty($password)) {
        $msg = "Saisie obligatoire";
        $erreur = true;
    } else {
        // Vérification si l'email existe et si le mot de passe correspond
        if (array_key_exists($email, $utilisateurs) && $utilisateurs[$email] === $password) {
            // Identifiants corrects : on stocke l'utilisateur en session et on redirige vers form2.php
            session_start();
            $_SESSION['email'] = $email;
            header("Location: form2.php");
            exit;
        } else {
            // Identifiants incorrects
            $msg = "Email ou mot de passe incorrect.";
            $erreur = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

    <h2>Connexion</h2>

    <p style="color: <?= $erreur ? 'red' : 'black'; ?>"><?= $msg; ?></p> <!-- Message en rouge si erreur -->

    <form action="" method="post">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        <br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <button type="submit">Se connecter</button>
    </form>

</body>
</html>

