<?php
session_start();
var_dump($_SESSION);
// var_dump($_REQUEST);
var_dump($_POST);



var_dump(!empty($_POST));
var_dump(isset($_POST));
var_dump(count($_POST) > 0);

if (count($_POST) > 0) :





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
        var_dump($resultats);
        $rows = $resultats;
        // foreach ($resultats as $row) {
        //     // Traiter chaque ligne de résultat
        // }
    } catch (PDOException $e) {
        echo "Erreur de lecture : " . $e->getMessage();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO user (first_name,last_name, email, password, role ) VALUES (:first_name, :last_name, :email, :password, :role)");
        $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);


        // Remplacer les valeurs
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur d'insertion : " . $e->getMessage();
    }
else :
    echo "Formulaire non soumis";
endif;

header('Location: index.php');
exit;


?>;

<a href="index.php">retour</a>