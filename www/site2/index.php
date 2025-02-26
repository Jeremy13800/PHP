<?php
session_start();

$_SESSION['isConnected'] = 'On';

// Connexion à la base de données
$host = 'mysql';
$dbname = 'letscook_php_db';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définit le mode d'erreur PDO sur exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}


try {
    $stmt = $pdo->prepare("SELECT * FROM user");
    $stmt->execute();

    // Récupérer les résultats
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($resultats);
    $rows = $resultats;
    // foreach ($resultats as $row) {
    //     // Traiter chaque ligne de résultat
    // }
} catch (PDOException $e) {
    echo "Erreur de lecture : " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <?php
    var_dump(__DIR__);
    include 'inc/header.php'; ?>

    <h1>
        Welcome


    </h1>

    <h2>Liste des utilisateur</h2>
    <table>
        <tr>
            <th>id</th>
            <th>First Name</th>
            <th>Last Nime</th>
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
                <td><a id="name" href="delete.php?id=<?php echo $row['id'] ?>">Supprimer</a></td>

            </tr>



        <?php


        }

        ?>

    </table>
    <h2>Creation d'un utilisateur</h2>
    <form action="create_user.php" method="post">
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
        <button type="submit" value="Create">Create User</button>
    </form>
    <!-- <a href="create_user.php?test=abc">test</a> -->

    <?php

    include 'inc/footer.php'
    ?>
</body>

</html>