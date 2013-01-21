<?php
function var_post($champs) {
$champs=(isset($_POST[$champs])) ? $_POST[$champs] : false;

return $champs;
}

function requete_notif($sql,$var, $val) {

	if (mysql_query($sql)) {
	
	$_SESSION[$var]=$val;
	}
	else{
	
	$_SESSION[$var]='erreur';
	}
	
	}
function var_post($champs) {
$champs=(isset($_GET[$champs])) ? $_GET[$champs] : false;

return $champs;
}
	
// article = 'ajoute' = modifier = supprimer = erreur 
// requete_notif(" LA REquetE " , 'article', 'ajoute' ,supprimer, erreur '
?>