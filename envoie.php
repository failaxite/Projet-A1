<?php
require_once 'database/connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$name = $_POST['name'];
$mail = $_POST['mail'];
$tel = $_POST['tel'];

$insert_message = $database->prepare('INSERT INTO form(name, mail, tel) VALUES(?, ?, ?)');
$insert_message->execute(array($name, $mail, $tel));


header("Location: thanks.php");
exit();

?>
