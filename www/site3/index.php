<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if (!(isset($_SESSION['name']))) {
            echo 'error';
        } else {
            echo 'Bonjour ' . $_SESSION['name'];
        }
        ?>
    </title>
</head>
<body>
    <!--exo1 -->
    <?php 
    
    for ($i = 3; $i <= 7; $i++) {
        echo '<font size= "' . $i . "\">'Hello Word ! </font><br>";

    } 

    ?>

    <!--exo2 -->
    <?php
    $cejour = getdate();
    ?>

    <h2>
    En ce <?php echo $cejour['mday'] . ' ' . $cejour['month'] . ' ' . $cejour['year'] ?> 
    sur le seveur <?php echo $_SERVER['SERVER_NAME']; ?>,
    il est <?php echo $cejour['hours'] . 'h' . $cejour['minutes'] . 'm' . $cejour['seconds'] . 's' ?>

    </h2>
</br>

    <h3>Variable HTTP serveur ($_SERVER)</h3>
    <table border="1">
        <tr>
            <th>Clé</th>
            <th>Valeur</th>
        </tr>
        <?php
        foreach ($_SERVER as $key => $value) {
            echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
        }
        ?>

    </table>

    <!--exo3 -->
    <?php
    session_start();
    $_SESSION['name'] = $_POST['name'];
    header('Location: index.php');
    ?>
</br>
</body>
</html>