<?php

require_once 'Header.php';
require_once 'menu.php';

if(isset($_GET['id']) && !empty($_GET['id'])){ //si on get un id ou que l'id n'est pas vide alors
    $id = htmlspecialchars(strip_tags($_GET['id'])); //definition de l'id et attribution de l'id stocké dans la bdd
    $article = $database->prepare('SELECT * FROM message WHERE id_Message = ?'); //ici on séléctionne la table message pour ensuite prendre le contenu de l'id message.

    $article->execute(array($id));//ici on stock l'id dans un array (tableau)
    if($article->rowCount() != 1){ // si l'article n'est pas = a 1
        header("Location: index.php"); //envoi sur la  page index
        exit(); //quitte l'execution
    }
    $query = $article->fetchAll(PDO::FETCH_ASSOC); //on retourne le contenu de la table message dans un tableau indexé.
    $content = $query[0]["contenu"]; 
    /*
$comment cette ligne est représenté
$fetchall = [
    [
        "id_message" => 70,
        "contenu" => "ceci est un test"
    ],
    [
        "id_message" => 72,
        "contenu" => "ceci est un troisième test"
    ]
];

*/
    $photo = $query[0]["photoPath"];

    /*$comment cette ligne est représenté
$fetchall = [
    [
        "id_message" => 70,
        "photoPath" => "lien vers l'image"
    ],
    [
        "id_message" => 72,
        "photoPath" => "lien vers l'image"
    ]
];

*/
    $name = explode("\\", $photo); //l'explode retourne un tableau de chaînes de caractères , on met donc ensuite les deux  "\\" qui ne serviront pour la destination des images pour finir avec le lien pour la photo enregistré dans la bdd.
                $name = $name[sizeof($name)-1]; // $name = $name[sizeof($name)-1] Cela signifie que la taille du tableau name vaut 5.
                
} else {
    header("Location: index.php");
    exit();
}

//Voir les articles//

?>
<body>
    <h2>Contenu de l'article : </h2>
    <?php echo '<p>'.$content.'</p>'; //paste du contenu du blog (ex: ceci est un test)
    echo '<img src="./uploads/' . $name . '" alt="">'; //paste de l'image envoyé. On sélectionne d'abord le dossier qui est .../uploads/ ensuite on met le name de l'image.?>

</body>
<?php require_once 'Footer.php'; ?>
</html>