<?php
session_start();

$_SESSION['isConnected'] = 'On';
// recuperation de la base de donnée
require_once 'Database.php';

//recuperation de la classe
require_once 'userClass.php';



// Initialisation de l'objet 
$superUser = new User($pdo);

// Recuperes tous les utilisateurs
$rows = $superUser->getAllUsers();

// fermeture de la connextion
$pdo = null;



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'inc/styles.php' ?>
    <title>Document</title>
</head>

<body>
    <?php

    include 'inc/header.php'; ?>

    <h1>
        Welcome


    </h1>

    <h2>Liste des utilisateur</h2>
    <table>
        <tr>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <th>Created At</th>
        </tr>

        <?php
        foreach ($rows as $row) {

        ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['last_name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['password'] ?></td>
                <td><?php echo $row['role'] ?></td>
                <td><?php echo $row['created_at'] ?></td>
                <td><a id="name" class="button" href="delete.php?id=<?php echo $row['id'] ?>">Supprimer</a></td>
                <td><a id="name" class="button" href="update.php?id=<?php echo $row['id'] ?>">Editer</a></td>

            </tr>



        <?php


        }

        ?>

    </table>
    <h2>Creation d'un utilisateur</h2>
    <form action="create_user.php" method="POST">
        <label for="first-name">First Name</label>
        <input type="text" name="first-name" id="first-name" placeholder="Marty"><br>
        <label for="last-name">Last Name</label>
        <input type="text" name="last-name" id="last-name" placeholder="McFly"><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="mmcfly@example.com"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="....."><br>
        <label for="role">Role</label>
        <input type="text" name="role" id="role"><br>
        <button type="submit" value="Create">CREATION DU PROFIL</button>
    </form>
    <!-- <a href="create_user.php?test=abc">test</a> -->

    <?php

    if ($pdo) {
        echo " connexion ouverte";
    } else {
        echo " connexion fermee";
    }

    include 'inc/footer.php'
    ?>
</body>

</html>