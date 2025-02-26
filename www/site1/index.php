$host = 'mysql'; // Nom du service Docker pour MySQL
$dbname = 'test';
$username = 'user';
$password = 'user_password';

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création d'un nouvel utilisateur
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->execute(['name' => $name, 'email' => $email]);

        echo "<p>Utilisateur ajouté avec succès.</p>";
    }

    // Lecture des utilisateurs existants
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Suppression d'un utilisateur
    if (isset($_GET['delete'])) {
        $id = (int) $_GET['delete'];
        $pdo->exec("DELETE FROM users WHERE id = $id");
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Test</title>
</head>
<body>
    <h1>CRUD Test - Utilisateurs</h1>

    <h2>Ajouter un utilisateur</h2>
    <form method="POST" action="">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Liste des utilisateurs</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['created_at']) ?></td>
                    <td>
                        <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
