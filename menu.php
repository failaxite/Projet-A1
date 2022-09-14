<?php
session_start();
require_once 'database/connect.php';
if(isset($_SESSION['connect']) && !empty($_SESSION['connect'])){ //si une session est connecté / si il n'y a rien
	$select_user_with_token = $database->prepare('SELECT * FROM users WHERE user_token = ?'); //selection de la table users et surtout de son user_token.
	$select_user_with_token->execute(array($_SESSION['connect'])); //on lance une session
	$nom = $select_user_with_token->fetchAll(PDO::FETCH_ASSOC)[0]['user_name']; //on prend les informations de l'user
}
?>

<header class="header">
		<div class="header__container">
			<!-- Logo -->
			<img src="Images/ThinSpace_logo.png" href="" class="header__logo"></a>

			<div class="header__menu menu">
				<div class="menu__icon">
					<span></span>
				</div>

				<nav data-sub_menu_auto_close="true" class="menu__body">
					<ul class="menu__list">
						<li>
							<a data-goto=".page__section_1" href="index.php" class="menu__link"
								>Accueil</a
							>
						</li>
						<li>
							<a data-goto=".page__section_2" href="store.php" class="menu__link"
								>Boutique</a
							>
						</li>
						<li>
							<a data-goto=".page__section_3" href="blog.php" class="menu__link"
								>Blog</a
							>
						</li>
						<li>
						<?php echo (isset($nom) && !empty($nom)) ? '<a href="deconnexion.php" class="menu__link">Se Déconnecter</a>' : '<a href="login.php" class="menu__link">Se Connecter</a>'; 
						//2 possibilités , si il y a un nom et si il n'y en a pas. | Si = le se connecter est devenu un bouton se déconnecter qui mene vers deconnexion.php
						// Non = Bouton se connecter pour aller vers la page login.php ?>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header>