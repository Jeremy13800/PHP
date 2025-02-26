<?php
$host = 'mysql';
$dbname = 'letscook_php_db';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définit le mode d'erreur PDO sur exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}


try {
    $stmt = $pdo->prepare("SELECT * FROM user");
    $stmt->execute();

    // Récupérer les résultats
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($resultats);
    // foreach ($resultats as $row) {
    //     // Traiter chaque ligne de résultat
    // }
} catch(PDOException $e) {
    echo "Erreur de lecture : " . $e->getMessage();
}

// try {
//     $stmt = $pdo->prepare("INSERT INTO user (first_name,last_name, email, password, role ) VALUES (:first_name, :last_name, :email, :password, :role)");
//     $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
//     $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
//     $stmt->bindParam(':last_name', $lastName);
//     $stmt->bindParam(':email', $email);
//     $stmt->bindParam(':password', $password);
//     $stmt->bindParam(':role', $role);
    

//     // Remplacer les valeurs
//     $firstName = 'jane';
//     $lastName = 'dupont';
//     $email = 'janedupont@example.com';
//     $password = '123456';
//     $role = 'editor';
//     $stmt->execute();
// } catch(PDOException $e) {
//     echo "Erreur d'insertion : " . $e->getMessage();
// }

// try {
//     $stmt = $pdo->prepare("UPDATE user SET first_name = :first_name, last_name = :last_name WHERE id = :id");
//     $stmt->bindValue(':id', '5');
//     $stmt->bindValue(':first_name', 'Marty');
//     $stmt->bindValue(':last_name', 'McFly');

    
//     $stmt->execute();
// } catch(PDOException $e) {
//     echo "Erreur de mise à jour : " . $e->getMessage();
// }

// try {
//     $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
//     $stmt->bindParam(':id', $id);

//     // Remplacer la condition
//     $id = '3';
//     $stmt->execute();
// } catch(PDOException $e) {
//     echo "Erreur de suppression : " . $e->getMessage();
// }

?>