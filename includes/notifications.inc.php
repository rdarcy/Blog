<?php
$croix = '<a class="cacher_notif" href="#null"> X </a>';
//notification pour les images
if(isset($_SESSION['image']))
	{
		switch($_SESSION['image'])
		{
			case 1:
				echo "<div class='alert alert-error' id='notif'><span>erreur, le fichier est trop grand</span>$croix</div>";
				break;
				
			case 2:
				echo "<div class='alert alert-error' id='notif'><span>erreur, type de fichiers non supportés </span>$croix</div>";
				break;
				
			case 3:
				echo "<div class='alert alert-error' id='notif'><span>erreur sur le fichier </span>$croix</div>";
			break;
		}
		unset($_SESSION['image']);
	}

//notifications pour l'article
if(isset($_SESSION['article'])){
	switch ($_SESSION['article']){
		case 'ajoute':
			echo ("<div class='alert alert-success'>L'article a été ajouté. $croix</div>");
			break;
		case 'modifie':
			echo ("<div class='alert alert-success'>L'article a été modifié. $croix</div>");
			break;
		case 'supprime':
			echo ("<div class='alert alert-success'>L'article a été supprimé. $croix</div>");
			break;
		case 'erreur':
			echo ("<div class='alert alert-error'>Il y a une erreur. $croix</div>");
			break;
	}
	unset($_SESSION['article']);
}

//notification pour la connexion


if(isset($_SESSION['utilisateur'])){
	switch ($_SESSION['utilisateur']){
		case 'connecte':
			echo ("<div class='alert alert-success'id='notif'><span>Vous êtes bien connecté.</span> $croix</div>");
			break;
		case 'erreur-login':
			echo ("<div class='alert alert-error' id='notif'><span>Votre couple login/password est faux.</span> $croix</div>");
			break;
		case 'erreur-login-vide':
		echo ("<div class='alert alert-error' id='notif'><span>Veuillez renseigner le champs login.</span> $croix</div>");
			break;
			
		case 'erreur-password-vide':
		echo ("<div class='alert alert-error' id='notif'><span>Veuillez renseigner le champs password.</span> $croix</div>");
			break;
			
		case 'erreur-login-password-vide':
		echo ("<div class='alert alert-error' id='notif'><span>Veuillez renseigner les champs login et password.</span> $croix</div>");
			break;
			
	}
	unset($_SESSION['utilisateur']);
}
	else {
	 echo"<div class='alert hide' id='notif'><span>
		  </span>
	      <a class='cacher_notif' href='#null'> X</a></div>";
	 }
	 
