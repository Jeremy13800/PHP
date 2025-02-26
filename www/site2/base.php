<?php
$world = "world";
echo "Hello $world";
$name = "Toto"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        <?php echo "Hello $world";
        echo "<br>";
        // Commentaire
        ?>
        
        <?=
        $name
        ?>
    </h1>

        <?php
        echo "<br>";
        // Concaténation
        $age_du_visiteur = 17;
        echo 'Le visiteur a ' . $age_du_visiteur . ' ans';
        // OU
        echo "<br>";
        echo "Le visiteur a $age_du_visiteur ans";
        $result = 5 / 2; // $nombre prend la valeur 5
        echo $result;
        echo "<br>";
        // Opération
        $nombre = 3 * 5 + 1; // $nombre prend la valeur 16
        echo $nombre;
        echo "<br>";
        $nombre2 = (1 + 2)* 2; // $nombre prend la valeur 6
        echo $nombre2;
        echo "<br>";
        $html = true;
        $css = true;
        $php = true;
        $js = true;
        $django = false;

        if ($html == true && $css == true && $js == true) {

            echo "FRONT-END"; //faux


        } elseif ($php == true || $django == true && $js == true ) {

            echo "BACK-END"; //vrai
        } else {

            echo "Apprentissae en-cours"; //faux
        }

        // autre syntaxe
        echo "<br>";
        $html = true;
        $css = false;
        $php = true;
        $js = true;
        $django = false;

        if ($html == true && $css == true && $js == true) :

            echo "FRONT-END"; //faux


         elseif ($php == true || $django == true && $js == true ) :

            echo "BACK-END"; //vrai
        else :

            echo "Apprentissae en-cours"; //faux
        endif;
        //Tableau
        echo "<br>";
        $prenoms[] = 'François'; // Créera $prenoms[0]
        $prenoms[] = 'Michel'; // Créera $prenoms[1]
        $prenoms[] = 'Nicole'; // Créera $prenoms[2]

        echo $prenoms[1]; // Affichera Michel
        echo "<br>";
        for ($i = 0; $i < count($prenoms); $i++) :
            echo $prenoms[$i] . '<br />';
        
        endfor;

        // tableau associatif
        echo "<br>";
        $coordonnees = array (
            'prenom' => 'François',
            'nom' => 'Dupont',
            'adresse' => '3 Rue du Paradis',
            'ville' => 'Marseille');
        
            echo $prenoms[0];
            echo $coordonnees['ville']; // Affichera Marseille


        // NEW tableau associatif
        echo "<br>";
        $coordonnees['prenom'] = 'François';
        $coordonnees['nom'] = 'Dupont';
        $coordonnees['adresse'] = '3 Rue du Paradis';
        $coordonnees['ville'] = 'Marseille';

        // equivalent console.log
        var_dump($coordonnees);

        // afficher un tableau associatif sans xDebug
        echo "<br>";
        echo "<pre>";
        print_r($coordonnees);
        echo "</pre>";

        echo $coordonnees['adresse']; // affiche 3 Rue du Paradis

        $today = date("F j, Y, g:i a");
        echo $today;
        echo "<br>";

        foreach($coordonnees as $key => $value)
        {
            echo '[' . $key . '] : ' . $value . '<br>';
        }

        //test de la fonction isset
        echo "<br>";
        echo isset($coordonnees['prenom']); // true
        echo isset($coordonnees['age']); // false
        echo "<br>";
        echo isset($coordonnees['adresse']); // true
        echo "<br>";
        echo isset($coordonnees['ville']); // true

        // tester isset dans un if
        echo "<br>";
        if (isset($coordonnees['prenom'])) :
            echo "Le prénom est présent dans le tableau";
        else :
            echo "Le prénom n'est pas présent dans le tableau";
        endif;

        // test 2 isset 
        echo "<br>";
        if (isset($coordonnees['prenom']) AND  isset($coordonnees['ville'])) :
            echo "Le prénom et la ville sont présents dans le tableau";
        else :
            echo "Le prénom ou la ville n'est pas présent dans le tableau";
        endif;

        // test 3 
        echo "<br>";
        if (isset($coordonnees['prenom']) OR  isset($coordonnees['ville'])) :
            echo "Le prénom ou la ville sont présents dans le tableau";
        else :
            echo "Le prénom et la ville n'est pas présent dans le tableau";
        endif;

        // test de isset dans une boucle
        echo "<br>";
        foreach($coordonnees as $key => $value)
        {
            if (isset($value)) :
                echo '['. $key. '] : '. $value. '<br>';
            endif;
        }


        //  dans une fonction
        echo "<br>";
        function afficherTableau($tableau)
        {
            foreach($tableau as $key => $value)
            {
                if (isset($value)) :
                    echo '['. $key. '] : '. $value. '<br>';
                endif;
            }
        }
        afficherTableau($coordonnees);
        echo "<br>";

        // test de scope
        $a = 1;
        function testScope()
        {
            $a = 2;
            echo $a; // affiche 2
        }
        testScope();
        echo "<br>";
        echo $a; // affiche 1


        // test de empty
        echo "<br>";    
        $var = 0;
        if (empty($var)) :
            echo 'La variable est vide';
            echo "<br>";
            $var = 'non vide';
        endif;
        echo $var; // affiche non vide
        ?>  


        


</body>
</html>