<?php
function var_post($champ) {
	return (isset($_POST[$champ]))? $_POST[$champ]:false;
}

function var_get($champ) {
	return (isset($_GET[$champ]))? $_GET[$champ]:false;
}

function requete_notif($sql,$var,$val){
//possibilité de la faire en ternaire
	if (mysql_query($sql)) $_SESSION[$var]=$val;
	else $_SESSION[$var]='erreur';
}

function connecte_notif($id, $var, $val){
	if (isset($id)){
		$_SESSION[$var]=$val;	
	}
	
	else{
		$_SESSION[$var]='erreur';		
	}
}

