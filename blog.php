<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>



<?php require 'Header.php'; ?>
<?php require 'menu.php'; ?>

<body class="login">
    <div class="btn-container">
        <?php
        $select_cat = $database->prepare('SELECT * FROM categorie');
        $select_cat->execute(array()); //execute la requete préparé a l'aide d'un tableau.
        while($ca = $select_cat->fetch()){ // récupère la ligne de la variable $select_cat.
            echo '<button class="btn-'.$ca['nom'].' btn">Trier catégorie '.$ca['nom'].'</button>'; //mise en place d'un bouton avec comme nom de classe "btn- (le nom de la catégorie) Trier le categorie et encore le nom de la catégorie.
        }
        ?>
    </div>
    <form action="envoi.php" method="POST" enctype="multipart/form-data" class="envoi">

        <div>
            <label for="">Message</label>
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
                $select_categorie->execute(array()); //execute la requete préparé a l'aide d'un tableau.

                while ($cat = $select_categorie->fetch()) { // récupère la ligne de la variable $select_cat.
                    echo '<option value="' . $cat['id_Categorie'] . '">' . $cat['nom'] . '</option>'; 
                }
                ?>
            </select>
        </div>

        <button type="submit">Envoyer</button>
    </form>

    <?php
    $jeRecois = $database->prepare("SELECT * FROM message JOIN users ON message.fk_user = users_id ORDER BY user_name ASC"); // selectionne table message , jointure avec fk_users = users id par la clé et c'est classé par rapport a l'user_name.
    // Le join permet de faire une jointure (associer plusieurs table) dans ce cas ci
    // on a associé le fk_users de la table message au users_id de la table users avec une clé primaire et une clé secondaire.
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
            if ($user['photoPath'] != null) { // on verif si photoPath n'est pas égale a rien
                $name = explode("\\", $user['photoPath']);
                $name = $name[sizeof($name)-1];
                echo '<img src="./uploads/' . $name . '" alt="">';
            } ?>
            <h3><?php echo $user["user_name"]; //on envoie l'user_name du mec?></h3> 
            <p><?php echo $user['contenu']; //on envoie le contenu du mec?></p> 
            <a href="article.php?id=<?php echo $user['id_Message']; //si l'utilisateur clique sur voir l'article il est envoyé vers une page ou on y rajouter l'id du truc?>">Voir l'article</a>
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