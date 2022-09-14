<?php require 'header.php';
require 'menu.php';
$appJs = true; 
?>

<main class="page">
	<section class="page__section page__section_1">
		<h1 class="page__title">
			Thin Space Industry
		</h1>
		<div>
			<div id="carbon-block"></div>
			<div class="page__text">
				<p>
					Thin space.
				</p>
				<p>
					THin space est un jeu vr qui a pour theme l'espace.
				</p>
			</div>
	</section>
	<div class="container">
		<div class="part">
			<div class="img">

			</div>
			<div class="txt">
				<p>Thin space est un jeu qui a pour but de révolutionner le monde de la vr ! De nombreuses exclusivités seront misent en place afin de satisfaire les utilisateurs ! A noter que nous mettons aussi a dispositions des casques VR a des prix peu élevé. Pour ce qui est du contenu du jeu , il vous sera annoncé a partir d'un trailer ou de blogs sur ce site meme. Tout ce que nous pouvons vous  dire a ce sujet ce que vous ne serez pas decu et que vous pourrez découvrir d'autres univers de chez vous ;)</p>
			</div>
		</div>
		<div class="part">
			<div class="txt">
				<p>N'hesitez pas a rejoindre nos réseaux se trouvant a la fin de cette page ! On y poste toutes les informations concernant les ajouts ou les news en général ! N'hesitez pas non plus a remplir le formulaire "beta" pour participer a la beta de notre jeu et par la suite nous indiqué ce qui serait a modifier / changer ! Nous vous remercions d'etre autant a nous soutenir ;)</p>
			</div>
			<div class="img">

			</div>
	</div>


	<div class="part">
			<div class="line">
				<p></p>
			</div>
		</div>
</main>

<h1>Derniers avis des utilisateurs:</h1>

	<?php
$reception_review = $database -> prepare('SELECT * FROM avis ORDER BY avis_id DESC LIMIT 3'); //Séléction de la table avis et de la colonne avis_id , on se limite a récupérer les 3 dernier avis.
$reception_review ->execute(); //On confirme la requete

foreach($reception_review as $rev){
    echo "<h4> $rev[nom] </h4>"; //on envoie le nom entré par la personne
    echo "<p> Note: $rev[note] </p>"; //on envoie laa note entré par la personne
    echo "<p>$rev[message]</p>"; //on envoie le message entré par la personne
    echo"<hr>";
}
?>
</div>

<p>
	<button class="button" data-modal="modalOne">S'inscrire a la beta !</button>
</p>
<div id="modalOne" class="modal">
	<div class="modal-content">
		<div class="contact-form">
			<a class="close">&times;</a>
			<form action="envoi.php" method="POST" class="envoie">
				<h2>S'inscrire a la beta</h2>
				<div>
					<input type="text" name="name" placeholder="Nom/Prenom" />
					<input type="text" name="mail" placeholder="Email" />
					<input type="text" name="tel" placeholder="Numero de telephone" />
				</div>
				<button type="submit">Envoyer</button>
			</form>
		</div>
	</div>
</div>



<?php require 'Footer.php'; ?>
<script type="text/javascript" src="assets/js/script.js"></script>
<script type="text/javascript" src="test.js"></script>
<script type="text/javascript" src="assets/js/localstorage.js"></script>
</body>

</html>