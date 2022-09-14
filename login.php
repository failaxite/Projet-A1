<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'header.php';
require 'menu.php';
$appJs = true; 
if(isset($_SESSION['connect']) && !empty($_SESSION['connect'])){
    header('Location: index.php');
    exit();
}
if(isset($_POST['submit'])){
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
        $email = htmlspecialchars(strip_tags($_POST['email']));//email verif
        $password = htmlspecialchars(strip_tags($_POST['password'])); //password verif
        $check_user = $database->prepare('SELECT * FROM users WHERE user_email = ?'); //on va dans la db voir l'user_email
        $check_user->execute(array($email));//check de l'email
        if($check_user->rowCount() == 0 || $check_user->rowCount() != 1){ //si il n'y a aucun valeurs correspondante
            header("Location: login.php?error=1");// envoie vers l'erreur 1
            exit();
        }
        $user = $check_user->fetchAll(PDO::FETCH_ASSOC);
        echo $user[0]['user_password']. '   '. $password;
        if(password_verify($password, $user[0]['user_password'])){ //verification du password
            $_SESSION['connect'] = $user[0]['user_token']; //préparation de la session et attribution d'un token unique.
            header("Location: index.php");
            exit();
        } else {//sinon
            header("Location: login.php?error=2"); //envoie vers l'erreur 2
            exit();
        }
    }
}

if(isset($_GET['error']) && !empty($_GET['error'])){
    switch(htmlspecialchars(strip_tags($_GET['error']))){
        case 1: //erreur 1 = aucune compte pour l'email marqué
            echo '<h3>Aucun compte trouvé pour cet email</h3>';
            break;
        case 2: //erreur 2 = le password ne match pas
            echo '<h3>Mauvais mot de passe</h3>';
            break;
    }
    
}
?>

    <form class= "form" action="login.php" method="POST" class="envoi">
        <div>
            <p> Login</p>
            <label for="">Entre ton email</label>
            <input type="message" name="email" placeholder="Email">
        </div>
        
        <div>
            <label for="">Entre ton Password</label>
            <input type="password" name="password" placeholder="Password">
        </div>

        <button name="submit" type="submit">LOGIN</button>
    </form>




<?php require 'Footer.php'; ?>
<script type="text/javascript" src="assets/js/script.js"></script>
<script type="text/javascript" src="test.js"></script>
</body>

</html>