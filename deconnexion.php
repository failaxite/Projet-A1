<?php
session_start();
if (isset($_SESSION['connect']) && !empty($_SESSION['connect'])) { //on verifi si il y a bien une session d'active
    session_unset(); //on enleve
    session_destroy(); //on la detruit

    header('location: index.php'); //on remet sur la page index
    exit();
} else { //sinon
    header('location: login.php'); //dirige vers la page de login
    exit();
}
