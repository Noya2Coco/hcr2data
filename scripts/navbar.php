<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/style.css">
	</head>

	<body>
		<div class="navbar">
			<ul>
				<li><a href="/">ACCUEIL</a></li>
				
				
				
				<!-- Ordre pages : 
					- Page liste des mois précédents
					- (!) Page exportation des données
					- (!) Page de modération des données pas encore validées
					- (!!!) Page de modération de toutes les données
				-->
				<li><a href="/includes/dataMonthly.php">MOIS PRÉCÉDENTS</a></li>
				
				
				<?php 
					if (!$_SESSION["connected"]){
						?>
						<li><a href="/includes/login.php">CONNEXION</a></li>
						<?php
					}
					else{
						?>
						<li><a href="#"></a>EXPORTATIONS</li>
						<li><a href="#">DONNÉES EN ATTENTE</a></li>
						<li><a href="#">TOUTES LES DONNÉES</a></li>
						<li><a href="/includes/logout.php">DÉCONNEXION</a></li>
						<?php
					}
				?>

			</ul>
		
		</div>


	</body>
</html>
