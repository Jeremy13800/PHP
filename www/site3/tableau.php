<?php

//1.echanger les valeurs des variables grace a list
$a = 5;
$b = 10;

// Échange en une seule instruction
list($a, $b) = array($b, $a);

// Affichage du résultat
echo "Après échange : a = $a, b = $b";
?>


<?php

//2- Déclarez un tableau $pays indexé par des entiers contenant les noms de trois pays.

$pays = [1 => "France", 2 => "Allemagne", 3 => "Belgique"];
?>

<?php

//3- Affichez le tableau avec var_dump
var_dump($pays);
?>

<?php

//4- Parcourez le tableau à l'aide d'une boucle for, vous pourrez utiliser la fonction count ().
for ($i = 1; $i <= count($pays); $i++) {
    echo "Pays $i : $pays[$i]<br>";
    
}
?>

<?php
//5- Parcourez le tableau à l'aide d'une boucle foreach
foreach ($pays as $key => $value) {
    echo "Pays $key : $value<br>";
}

?>

<?php
//6- Pour quelle raison n'est-il pas approprié d'utiliser une boucle do ... while

//Une boucle do ... while exécute toujours le bloc de code au moins une fois, même si le tableau est vide. Cela peut entraîner des erreurs si le tableau est vide et que le code à l'intérieur de la boucle do ... while ne peut pas être exécuté sans données.

$pays = []; // Tableau vide

$i = 0;
do {
    echo "Pays $i : " . $pays[$i] . "<br>"; // Erreur possible : Undefined offset
    $i++;
} while ($i < count($pays));
?>

<?php
//7- Ajoutez des index sous forme de chaînes de caractères pour associer les capitales aux pays du tableau $pays.

// Déclaration du tableau associatif avec pays => capitale
$pays = [
    "France" => "Paris",
    "Canada" => "Ottawa",
    "Japon" => "Tokyo"
];

// Affichage du tableau pour vérification
print_r($pays);
?>
"<br>"

<?php
//8- Combien vaut l'expression count($pays) ?
//La fonction count() renvoie le nombre d'éléments dans un tableau. Dans ce cas, le tableau $pays contient 3 éléments (pays => capitale), donc l'expression count($pays) vaut 3.

$pays = [
    "France" => "Paris",
    "Canada" => "Ottawa",
    "Japon" => "Tokyo"
];

echo "Le tableau contient " . count($pays) . " éléments.";
?>
"<br>"
<?php
//9- Comment parcourir ce tableau pour afficher chaque pays et sa capitale ?

$pays = [
    "France" => "Paris",
    "Canada" => "Ottawa",
    "Japon" => "Tokyo"
];

// Boucle foreach pour parcourir le tableau
foreach ($pays as $nom_pays => $capitale) {
    echo "La capitale de $nom_pays est $capitale.<br>";
}
?>

"<br>"
<?php
//10 - Ajouter au script en cours une fonction enumerer($t) qui prend le tableau comme paramètre et qui affiche la valeur de chaque index alphanumérique.

function enumerer($t) {
    foreach ($t as $key => $value) {
        echo "L'index '$key' contient la valeur '$value'.<br>";
    }
}
//appel de la fonction
enumerer($pays);
?>

"<br>"

<?php
//11 Insérez une valeur $t[« capitale »] = « pays » en créant une fonction ajouter($t) puis afficher les nouvelles valeurs du tableau résultant.


$pays = [
    "France" => "Paris",
    "Canada" => "Ottawa",
    "Japon" => "Tokyo"
];

function ajouter(&$t) { // Passer le tableau par référence
    $t["capitale"] = "pays"; // Ajout d'une nouvelle entrée
}

// Appel de la fonction
ajouter($pays);

// Affichage du tableau après modification
print_r($pays);

//12 Affichez par var_dump le tableau après l'exécution de la fonction. Qu'en concluez-vous ?
var_dump($pays);
?>





