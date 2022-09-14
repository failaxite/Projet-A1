<?php

require "database/connect.php";
$del = $_POST['del'];
$data = [
    "formDel" => $del
];

$jeSupp = $database->prepare("DELETE FROM message WHERE id_Message = :formDel"); //on selectionne table message pour delete l'id_message selectionné
$jeSupp->execute($data);

header("Location: blog.php");
exit();
