<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="https://skillicons.dev/icons?i=php" type="image/x-icon">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #080b0e;
            color: hsla(0, 0%, 100%, 0.8);
        }

        main {
            padding: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: hsla(0, 0%, 0%, 0.5);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .services {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            background-color: hsla(0, 0%, 0%, 0.2);
            padding: 10px;
            border-top: 1px solid hsla(0, 0%, 100%, 0.1);
            border-bottom: 1px solid hsla(0, 0%, 100%, 0.1);
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        a {
            text-decoration: none;
            color: #fff;
        }

        .d-flex {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .jc-c {
            justify-content: center;
        }

        .jc-sb {
            justify-content: space-between;
        }

        .ai-c {
            align-items: center;
        }

        .btn {
            padding: 5px 10px;
            border: 1px solid hsla(0, 0%, 100%, 0.1);
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .status {
            display: flex;
            gap: 10px;
        }

        .status span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <h1 class="d-flex jc-sb">
                <span class="d-flex ai-c">
                    <img src="https://www.vectorlogo.zone/logos/docker/docker-tile.svg" alt="PHP" height="36">
                    <span>Docker - Server</span>
                </span>
                <span>
                    <time datetime=""></time>
                </span>
            </h1>
            <div class="services">
                <span class="d-flex ai-c">
                    <img src="https://www.vectorlogo.zone/logos/apache/apache-official.svg" alt="Apache" height="24">
                    <span>
                        <?= $_SERVER['SERVER_SOFTWARE']; ?>
                    </span>
                </span>
                <span class="d-flex ai-c">
                    <img src="https://www.vectorlogo.zone/logos/php/php-ar21.svg" alt="PHP" height="24">
                    <span>
                        PHP
                        <?= phpversion(); // Affiche la version actuelle de PHP 
                        ?>
                    </span>
                </span>
                <span class="d-flex ai-c">
                    <img src="https://www.vectorlogo.zone/logos/mysql/mysql-ar21.svg" alt="MySQL" height="24">
                    <span>
                        <?php
                        $host = "mysql"; // Nom du conteneur MySQL dans docker-compose.yml
                        $username = "root";
                        $password = "root";
                        $database = "test";

                        try {
                            // Connexion au serveur MySQL
                            $connection = new mysqli($host, $username, $password, $database);

                            if ($connection->connect_error) {
                                echo "Erreur de connexion MySQL : " . $connection->connect_error;
                            } else {
                                echo "MySQL " . $connection->server_info;
                            }
                        } catch (Exception $e) {
                            echo "Erreur de connexion MySQL : " . $e->getMessage();
                        } finally {
                            if (isset($connection) && $connection instanceof mysqli) {
                                $connection->close();
                            }
                        }
                        ?>
                    </span>
                </span>
                <a class="btn d-flex ai-c" href="http://localhost:8081" target="_blank">
                    <img src="https://www.vectorlogo.zone/logos/phpmyadmin/phpmyadmin-ar21.svg" alt="PHP" height="24">
                    <span>PHPMyAdmin</span>
                </a>
            </div>

            <div class="status">
                <?php
                // Vérifications des extensions
                $checks = [
                    'PDO' => extension_loaded('pdo_mysql'),
                    'MySQLi' => function_exists('mysqli_connect'),
                    'XDebug' => extension_loaded('xdebug'),
                ];

                foreach ($checks as $name => $status) {
                    echo sprintf(
                        '<span>%s %s</span>',
                        $status ? '✅' : '❌',
                        htmlspecialchars($name . ' support ' . ($status ? 'OK' : 'non disponible'))
                    );
                }
                ?>
            </div>

        </div>
        <div class="container">
            <?php
            // Récupérer le chemin du dossier courant
            $directory = __DIR__;
            // Scanner le dossier courant
            $files = scandir($directory);
            echo "<nav>";
            foreach ($files as $file) {
                // Ignorer les entrées spéciales '.' et '..'
                if ($file !== '.' && $file !== '..' && $file !== 'index.php') {
                    // Vérifier si c'est un dossier ou un fichier
                    $path = $directory . DIRECTORY_SEPARATOR . $file;
                    if (is_dir($path)) {
                        echo "<a href=\"$file\">📁 $file</a>";
                    } else {
                        echo "<a href=\"$file\">📄 $file</a>";
                    }
                }
            }
            echo "</nav>";
            ?>
        </div>
        <div>
            <details class="container">
                <summary>PHP infos</summary>
                <?php
                var_dump('HTTP_SEC_CH_UA_PLATFORM :');
                var_dump($_SERVER['HTTP_SEC_CH_UA_PLATFORM']);
                // phpinfo(); // Décommentez pour afficher les infos PHP complètes
                ?>
            </details>
        </div>

    </main>
    <script>
        const dateElement = document.querySelector('time');
        const intervalId = setInterval(() => {
            const now = new Date();
            dateElement.textContent = now.toLocaleString();
        }, 1000);
        dateElement.datetime = new Date().toISOString();
    </script>
</body>

</html>

