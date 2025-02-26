<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>
        <?php if (!(isset($_SESSION['name']))) {
            echo 'error';
        } else {
            echo 'Bonjour ' . $_SESSION['name'];
        }
        ?>
    </title>
    <body>
        <?php if (!(isset($_SESSION['name']))) {
            echo '<p>Veuillez vous connecter pour accéder à votre espace personnel.</p>';
        } else {
            echo '<p>Bienvenue dans votre espace personnel.</p>';
        }
       ?>
    </body>

</head>