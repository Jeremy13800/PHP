<?php
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Recupere tous les utilisateurs
    public function getAllUsers()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Recupere un utilisateur par son id
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajoute un utilisateur
    public function addUser($firstName, $lastName, $email, $password, $role)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            if (!$hashedPassword) {
                throw new Exception("Le hachage du mot de passe a échoué.");
            }

            $stmt = $this->pdo->prepare("INSERT INTO user (first_name, last_name, email, password, role) VALUES (:first_name, :last_name, :email, :password, :role)");

            $stmt->bindValue(':first_name', $firstName);
            $stmt->bindValue(':last_name', $lastName);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $hashedPassword);
            $stmt->bindValue(':role', $role);

            $result = $stmt->execute();

            if (!$result) {
                throw new Exception("Échec de l'exécution de la requête SQL.");
            }

            return true;
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    // Modifie un utilisateur
    public function updateUser($id, $firstName, $lastName, $email, $password, $role)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Crypte le mot de passe
        $stmt = $this->pdo->prepare("UPDATE user SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, role = :role WHERE id = :id");
        $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $this->pdo = null;
    }

    // Supprime un utilisateur
    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $this->pdo = null;
    }
}
