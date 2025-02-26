<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de Date</title>
</head>
<body>

<?php
$msg = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["jour"] ?? '';
    $msg = verifier($date);
}

// Fonction de validation
function verifier($d) {
    if (empty($d)) {
        return "⚠ Veuillez entrer une date.";
    }

    // Vérification avec une regex : jj/mm/aaaa
    if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d\d$/", $d)) {
        return "⚠ Format incorrect (jj/mm/aaaa attendu).";
    }

    // Vérification si la date est valide
    list($jour, $mois, $annee) = explode("/", $d);
    if (!checkdate($mois, $jour, $annee)) {
        return "⚠ Cette date n'existe pas.";
    }

    return "✅ Date valide.";
}
?>

<h2>Validation d'une Date</h2>
<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
    <label for="jour">Entrez une date (jj/mm/aaaa) :</label>
    <input type="text" name="jour" id="jour">
    <button type="submit">Vérifier</button>
</form>

<p><?php echo $msg; ?></p>

</body>
</html>