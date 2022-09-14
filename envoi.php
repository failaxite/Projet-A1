<?php
require_once 'database/connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//$caractere = possible entre 0 et 9 & a et z & A et Z
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        return $randstring;
    }
if(isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['categorie']) && !empty($_POST['categorie']) && isset($_FILES['photo'])){ //on verifi si (message,catégorie,photo) ne sont pas vide
    if(!(isset($_SESSION['connect']) && !empty($_SESSION['connect']))){ //on regarde si l'user n'est pas connecté 
        header("Location: login.php");//envoi vers login.php
        exit();
    }

    $allowedTypes = [ //format autorisé a mettre dans le lecteur de fichier (photo)
        'image/png' => 'png',
        'image/jpeg' => 'jpg'
     ];
    $filepath = $_FILES['photo']['tmp_name']; //on associe la photo a un nom temporaire
    $fileSize = filesize($filepath);
    if(!in_array($_FILES['photo']['type'], array_keys($allowedTypes)) || $fileSize == 0 || $fileSize > (1*1024*1024*10)){
        header("Location: blog.php");
        exit();
    }
    $filetype = $allowedTypes[$_FILES['photo']['type']]; //mise en place du nom final , la photo +le type
    $filename = basename($filepath); //retourne le nom final
    $newfilename = RandomString() . sha1(time()); //création d'un nouveau nom aléatoire 
    $targetDirectory = __DIR__ . "\\uploads"; //on defini le fichier d'enregistrement
    if(!is_dir($targetDirectory)){ // on verifi si le dossier uploads est déja crée
        mkdir($targetDirectory);//si non on le crée
    }

    $newFilepath = $targetDirectory . "\\" . $newfilename . "." . $filetype; // lien du fichier = uploads\nom_du_file.png/jpg
    
    if (!copy($filepath, $newFilepath)) {
        header("Location: blog.php");
        exit();
    }
    unlink($filepath);
    $message = $_POST['message'];
    $categorie = $_POST['categorie'];

    $select_user = $database->prepare('SELECT * FROM users WHERE user_token = ?');
    $select_user->execute(array($_SESSION['connect']));
    $id = $select_user->fetchAll()[0]['users_id'];

/*
$select_user->fetchAll() peut être représenté par ça :

$fetchall = [
    [
        "users_id" => 17,
        "user_name" => "test"
    ],
    [
        "users_id" => 24,
        "user_name" => "f"
    ]
];

*/

/*
$select_user->fetchAll()[0] à l'exécution de ça tu obtiens une ligne qui peut être représenté comme ça :

$ligne = [
    "users_id" => 17,
    "user_name" => "test"
];
*/

    $insert_message = $database->prepare('INSERT INTO message(contenu, photoPath, fk_categorie, fk_user) VALUES(?, ?, ?, ?)');
    $insert_message->execute(array($message, $newFilepath, $categorie, $id));

    header("Location: blog.php");
    exit();
} else if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['tel']) && !empty($_POST['tel'])){
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];

    $insert_message = $database->prepare('INSERT INTO form(nom, mail, tel) VALUES(?, ?, ?)');
    $insert_message->execute(array($name, $mail, $tel));


    header("Location: index.php");
    exit();
}else if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['note']) && !empty($_POST['note'])){
    $nom = $_POST['nom'];
    $message = $_POST['message'];
    $note = $_POST['note'];

    $insert_message = $database->prepare('INSERT INTO avis(nom, message, note) VALUES(?, ?, ?)');
    $insert_message->execute(array($nom, $message, $note));


    header("Location: index.php");
    exit();

}
