<?php
require("libs/smarty.class.php"); //inclusion de smarty 
include('includes/connexion.inc.php');
include('includes/haut.inc.php');
include('includes/notifications.inc.php');
include('includes/fonctions.inc.php'); 

$connecte = false;
$smarty = new Smarty();//instanciation smarty
$articles=array();

if(isset($_COOKIE['sid'])) //si cookie
{
	$sql = "SELECT * FROM utilisateurs WHERE sid='".$_COOKIE['sid']."'";	
	$result =  mysql_query($sql);
	
	if(mysql_num_rows($result))
	{
		$connecte = true;
		$util = mysql_fetch_array($result);
	}	
}

//on definit les variables pour la pagination
$app = 3 ; // article par page
$page = (int)var_get('p'); // page en get
$rech = var_get('r'); // si une rech est faite
$rech = htmlspecialchars($rech);
$rech = urlencode($rech);
//tags
$tag=var_get('tag');
if(isset($tag) && !empty($tag)) 
	{
		$tag=htmlspecialchars($tag);
		$tag=urlencode($tag);
		$smarty->assign('tag',$tag);
	}

//pagination
if (!$page) $page=1;//page n°1
$debut =($page-1)*$app ; 

if(!empty($rech) && empty($tag))
{
	//on recupere le nb d'articles
	$where = ($rech)?"WHERE texte like '%$rech%'":"";
	$sql1 = "SELECT COUNT(*) AS total FROM articles $where ;";
	$result1 = mysql_query($sql1);
}
elseif(!empty($tag) && empty($rech))
{
	// close de recherche pour sql
	$where=($tag)?"WHERE tags.tag LIKE '%$tag%'":"";
	//compte le nombre d'article
	$sql1=("SELECT COUNT(*) AS total FROM articles INNER JOIN tags ON articles.id = tags.id_articles $where ");
	$result1 = mysql_query($sql1);
}
elseif(empty($rech) && empty($tag))
{
		$sql1=("SELECT COUNT(*) AS total FROM articles");
		$result1 = mysql_query($sql1);
}
// traitement des requetes
$total = mysql_fetch_array($result1);
//on calcule le nb de pages
$total_art = $total['total'];
$nb_pages = ceil($total_art/$app);

	if(!empty($tag))
	{
		$sql="SELECT * FROM articles INNER JOIN tags ON articles.id = tags.id_articles  WHERE tags.tag='$tag' ORDER BY articles.id DESC LIMIT $debut,$app";
	}
	elseif(!empty($rech))
	{
		$sql="SELECT * FROM articles INNER JOIN tags ON articles.id = tags.id_articles $where ORDER BY id DESC LIMIT $debut,$app";
	}
	elseif(empty($tag_select) && empty($rech))
	{	
		$sql="SELECT * FROM articles INNER JOIN tags ON articles.id = tags.id_articles ORDER BY id DESC LIMIT $debut,$app";
	}
	$result = mysql_query($sql);
	
	while($data = mysql_fetch_array($result))
	{ //boucle qui fait apparaitre la liste d'article
		$chemin='data/images/'.$data['id'].'.jpg';
		if(file_exists($chemin))
		{
			$data['image']=$chemin;
		}
		$articles[]= $data;	
	}
		
	$smarty->assign('articles',$articles);//article
	$smarty->assign('connecte',$connecte);//etat
	$smarty->assign('app',$app); // article par page
	$smarty->assign('page',$page); // page en get
	$smarty->assign('rech',$rech); // si une rech est faite
	$smarty->assign('debut',$debut); //debut de la page
	$smarty->assign('nb_pages',$nb_pages);//nombre de page
	//$smarty->assign('rech_encode',$rech_encode);
	
	$smarty->display("templates/index.phtml");//affichage de l'html a l ecran avec smarty
	
include('includes/bas.inc.php');

