<?php
// Vérification si des données ont été envoyées
if (isset($_GET["nom"]) && isset($_GET["age"]) && isset($_GET["marit"])) {
    $nom = htmlspecialchars($_GET["nom"]);
    $age = (int) $_GET["age"];
    $marit = htmlspecialchars($_GET["marit"]);

    // Vérification des centres d'intérêts
    $internet = isset($_GET["internet"]) ? 1 : 0;
    $micro = isset($_GET["micro"]) ? 1 : 0;
    $jeux = isset($_GET["jeux"]) ? 1 : 0;

    echo "<h2>Merci à vous, $nom.</h2>";
    echo "<p>Vous avez donc le bel âge de <strong>$age</strong> ans, vous êtes <strong>$marit</strong> et vous vous intéressez à ";
    
    $interets = [];
    if ($internet) $interets[] = "Internet";
    if ($micro) $interets[] = "la micro-informatique";
    if ($jeux) $interets[] = "les jeux vidéo";

    echo !empty($interets) ? implode(", ", $interets) . "." : "rien de particulier.";

    // Construction de la requête SQL (sécurisée)
    $requeteSQL = "INSERT INTO Matable (nom, age, marit, internet, micro, jeux) VALUES ('$nom', $age, '$marit', $internet, $micro, $jeux);";
    
    echo "<p>Je m'empresse d'envoyer la requête :</p>";
    echo "<p><strong>$requeteSQL</strong></p>";
} else {
    echo "<p>Erreur : certaines informations sont manquantes.</p>";
}
?>
