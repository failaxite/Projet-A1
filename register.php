<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'header.php';
require 'menu.php';
$appJs = true;
if (isset($_POST['submit'])) {
    if (isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['password']) && !empty($_POST['password'])) { //si les champs name , mail et password ne sont pas vide
        
        $token = sha1(time()).time().uniqid("", true); //Création d'un token unique associé a la session d'un utilisateur
        $name = htmlspecialchars(strip_tags($_POST['name'])); //strips_tags permet de supr les balises php et html d'une chaine | htmlspecialchars converti tout les caractères spéciaux de la parenthèse en entité html
        $email = htmlspecialchars(strip_tags($_POST['mail']));//strips_tags permet de supr les balises php et html d'une chaine | htmlspecialchars converti tout les caractères spéciaux de la parenthèse en entité html
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //filter_var permet de verifier une variable avec un filtre spécifique , ici notre filtre est Filter_validate_email , on verifie donc l'email entré par l'user.
            //Dans ce cas ci-dessus on voit qu'on demande  si la variable ne peut pas etre vérifié 
            header("Location: register.php?error=2"); //on retourne donc l'erreur
            exit();
        }
        $password = password_hash(htmlspecialchars(strip_tags($_POST['password'])), PASSWORD_BCRYPT); //password_hash permet de haché un mot de passe , c'est ce qui est fait actuellement. On utilise le hash BCCRYPT.
        $check_email = $database->prepare('SELECT * FROM users WHERE user_email = ?');
        $check_email->execute(array($email));

        if($check_email->rowCount() != 0){//si aucune email n'est trouvé dans user_email
            header("Location: register.php?error=1");//on retrourne une erreur sur une autre page
            exit();
        }
        $register_user = $database->prepare('INSERT INTO users (user_email, user_name, user_password, user_token) VALUES (?, ?, ?, ?)'); //on envoie toutes les infos entré par l'user.
        $register_user->execute(array($email, $name, $password, $token));

        header('Location: register.php');
        exit();
    }
}
if(isset($_GET['error']) && !empty($_GET['error'])){ //si il y a une erreur
    switch(htmlspecialchars(strip_tags($_GET['error']))){
        case 1: //id 1 (ex: "Location: register.php?error=1" )
            echo '<h3>Un compte existe déjà avec cet email</h3>';
            break;
        case 2: //id 2 (ex: "Location: register.php?error=2" )
                echo '<h3>Mauvais email</h3>';
                break;
    }
    
}

?>

<form class="form" action="register.php" method="POST" class="envoi">
    <div>
        <p> Register</p>
        <label for="">Entre ton Email</label>
        <input type="mail" name="mail" placeholder="Email">
    </div>

    <div>
        <label for="">Entre ton Pseudo</label>
        <input type="message" name="name" placeholder="Pseudo">
    </div>

    <div>
        <label for="">Entre ton Password</label>
        <input type="password" name="password" placeholder="Password">
    </div>

    <button name="submit" type="submit">REGISTER</button>
</form>




<?php require 'Footer.php'; ?>
<script type="text/javascript" src="assets/js/script.js"></script>
<script type="text/javascript" src="test.js"></script>
</body>

</html>