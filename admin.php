<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'Header.php';
require 'menu.php';
if(isset($_GET['item']) && !empty($_GET['item'])){
    if($_GET['item'] == "avis"){
        if(isset($_GET['action']) && !empty($_GET['action'])){
            if($_GET['action'] == "delete"){
                if(isset($_GET['id']) && !empty($_GET['id'])){
                    $id = htmlspecialchars(strip_tags($_GET['id']));
                    if($id == "all"){
                        $delete_avis = $database->prepare('DELETE FROM avis');
	                    $delete_avis->execute(array());
                    }else {
                        $delete_avis = $database->prepare('DELETE FROM avis WHERE avis_id = ?');
	                    $delete_avis->execute(array($id));
                    }
	                header('Location: admin.php');
	                exit();
                }
            }
        } else {
            header('Location: admin.php');
	        exit();
        }
    } else {
        header('Location: admin.php');
        exit();
    }
	
}

?>


<h1>Derniers avis des utilisateurs:</h1>

	<?php
$reception_review = $database -> prepare('SELECT * FROM avis ORDER BY avis_id DESC LIMIT 3');
$reception_review ->execute();

foreach($reception_review as $rev){
    echo "<h4> $rev[nom] </h4>";
    echo "<p> Note: $rev[note] </p>";
    echo "<p>$rev[message]</p>";
    echo '<a href="admin.php?item=avis&action=delete&id='.$rev['avis_id'].'">Supprimer</a>';
    echo"<hr>";
}
?>
<a href="admin.php?item=avis&action=delete&id=all">Supprimer</a>

</div>


<label for="">Blog-Messages</label>


<body class="login">
    <div class="btn-container">
        <?php
        $select_cat = $database->prepare('SELECT * FROM categorie');
        $select_cat->execute(array());
        while($ca = $select_cat->fetch()){
            echo '<button class="btn-'.$ca['nom'].' btn">Trier catégorie '.$ca['nom'].'</button>';
        }
        ?>
    </div>
    <form action="envoi.php" method="POST" enctype="multipart/form-data" class="envoi">

        <div><label for="">Message</label>
            
            <input type="text" name="message" placeholder="Message">
        </div>

        <div>
            <label for="">Photo</label>
            <input type="file" name="photo" placeholder="Message">
        </div>

        <div>
            <label for="">Catégorie :</label>
            <select name="categorie" id="">
                <?php
                $select_categorie = $database->prepare('SELECT * FROM categorie');
                $select_categorie->execute(array());

                while ($cat = $select_categorie->fetch()) {
                    echo '<option value="' . $cat['id_Categorie'] . '">' . $cat['nom'] . '</option>';
                }
                ?>
            </select>
        </div>

        <button type="submit">Envoyer</button>
    </form>

    <?php
    $jeRecois = $database->prepare("SELECT * FROM message JOIN users ON message.fk_user = users_id ORDER BY user_name ASC");
    $jeRecois->execute();
    $index = 1;
    ?>

    <section class="users">
        <?php while ($user = $jeRecois->fetch()) {

            $select_categorie = $database->prepare('SELECT * FROM categorie WHERE id_Categorie = ?');
            $select_categorie->execute(array($user['fk_categorie']));
            echo '<div class="card article ' . $select_categorie->fetchAll()[0]['nom'] . '">';
        ?>
            <h5>Blog <?php echo $index;
                        $index++; ?></h5>
            <p></p>
            <?php
            if ($user['photoPath'] != null) {
                $name = explode("\\", $user['photoPath']);
                $name = $name[sizeof($name)-1];
                echo '<img src="./uploads/' . $name . '" alt="">';
            } ?>
            <h3><?php echo $user["user_name"]; ?></h3>
            <p><?php echo $user['contenu']; ?></p>

            <form action="delete.php" method="POST">
                <input type="hidden" name="del" value="<?php echo $user['id_Message']; ?>">
                <button type="submit">Supprimer</button>
            </form>
            </div>
        <?php } ?>
        <script type="text/javascript" src="assets/js/script.js"></script>
        <script type="text/javascript" src="assets/js/app.js"></script>
    </section>

    <?php require 'Footer.php'; ?>

    </div>
</body>

</html>