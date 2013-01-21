<?php
include('includes/connexion.inc.php');
include('includes/fonctions.inc.php');

$id=(int)var_get('id');

if(isset($id))
{	//requete de suppression
	$sql="SELECT COUNT(*) FROM tags INNER JOIN articles ON articles.id = tags.id_articles";
	$req=mysql_fetch_array(mysql_query($sql));
	if(isset($req))
	{
		$sql="DELETE FROM articles WHERE id=$id";
		$sql2="DELETE FROM tags WHERE id_articles=$id";
		mysql_query($sql2);
		requete_notif($sql,'article','supprimer');
	}
	else
	{
		$sql="DELETE FROM articles WHERE id=$id";
		requete_notif($sql,'article','supprimer');
	}
	unlink("data/images/$id.jpg");
	header('Location:index.php');
}

//exit();