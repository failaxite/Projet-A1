<?php 
    define('HOST', 'localhost');
    define('DBNAME', 'devweb');
    define('USER', 'root');
    define('PASS', 'root');

    try{
    	$database = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8;port=3306", USER, PASS);
    } catch(Exception $e){
    	die(print_r($e->getMessage()));
    }
/*
    $_SESSION['connect'] = "efefeVYEGVFCEGVCUec50852efefeVYEGVFCEGVCUec50852efefeVYEGVFCEGVCUec50852efefeVYEGVFCEGVCUec50852efefeVYEGVFCEGVCUec50852";

    if(isset($_SESSION['connect']) && !empty($_SESSION['connect'])){
        //connecté
        //SELECT * FROM users WHERE user_token = "efefeVYEGVFCEGVCUec50852";
    } else {
        //pas connecté
    }
*/