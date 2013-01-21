<?php 
include('includes/connexion.inc.php');
include('includes/fonctions.inc.php'); 
	
	//pour la modification
	$id =(int)var_get('id');
	$action_label=($id)?'modifie':'ajoute';
	
	//var_dump($_FILES['image']['size']);
	if (isset($id)) //test de la presence de l id
	{
		$resultat = mysql_query("SELECT * FROM articles,tags WHERE id=$id AND articles.id = tags.id_articles");
		$data = mysql_fetch_array($resultat);
	}

	if(isset($_POST['post']))//test du post de l'image
	{
		//variables pour la verification et l'upload de l'image
		$image =  $_FILES['image'];
		$erreur = $_FILES['image']['error'];
		$type = $_FILES['image']['type'];
		$taille = $_FILES['image']['size'];
		$name=$_FILES['image']['tmp_name'];
		
		
		//vérification des valeurs entrées
		if(!empty($_POST['texte']) && !empty($_POST['titre']))
		{
			$titre= var_post('titre');
			$texte= var_post('texte');
			if(isset($_POST['tags'])) //verif de la presence du tag
				$tags = var_post('tags');
			else
				$tags="";
				
			if(isset($titre) && isset($texte)) //si texte et tire entres
			{
				$titre=mysql_real_escape_string($titre);
				$texte=mysql_real_escape_string($texte);
				$id=(int)var_post('id');
				if (isset($id) && $id >0)
				{
					if(!empty($name))
					{ //test des erreus + taille + format
						if( $erreur!=0 && ($taille >500*1024 || $type!='image/jpeg'))
						{
							$_SESSION['image']=$erreur;
							header('Location:article.php');//si erreur on retourne a l index
							exit();
						}
						else
						{
							$sql="UPDATE articles SET titre='$titre', texte='$texte' WHERE id='$id'";
							$sql2="UPDATE tags SET tag='$tags' WHERE id_articles='$id'";
							mysql_query($sql);
							requete_notif($sql2,'article','modifier');
							
							$dest="data/images/$id.jpg";//chemin entier
							move_uploaded_file($name,$dest);
							header('Location:index.php');
							exit();
						}
					}
					else
					{
						$sql="UPDATE articles SET titre='$titre', texte='$texte' WHERE id='$id'";
						$sql2="UPDATE tags SET tag='$tags' WHERE id_articles='$id'"; //ajout du tag
						mysql_query($sql);
						requete_notif($sql2,'article','modifier');
						header('Location:index.php');
						exit();
					}
				}
				else
				{
					if(!empty($name)) 
					{
						if($$erreur !=0 && ($taille >500*1024 || $type!='image/jpeg'))
						{
							$_SESSION['image']=$erreur;
							header('Location:article.php');
							exit();
						}
						else
						{
							$sql="INSERT INTO articles (titre,texte,date) VALUES ('$titre','$texte',".time().")";
							mysql_query($sql);
							$id=mysql_insert_id();
							$sql2="INSERT INTO tags(id_articles,tag) VALUES ('$id','$tags')";
							requete_notif($sql2,'article','ajouter');
							
							$dest=dirname(__FILE__)."/data/images/$id.jpg";
							move_uploaded_file($name,$dest);
							
							header('Location:index.php');
							exit();
						}
					}
					else
					{//notifications
						$sql="INSERT INTO articles (titre,texte,date) VALUES ('$titre','$texte',".time().")";
						mysql_query($sql);
						$id=mysql_insert_id();
						$sql2="INSERT INTO tags(id_articles,tag) VALUES ('$id','$tags')";
						
						requete_notif($sql2,'article','ajouter');
						header('Location:index.php');
						exit();
					}
				}
			
			}
			else
			{
				requete_notif('','article','ajouter');
				header('Location:article.php');
				exit();
			}
		}
		else
		{
			$action_label=($id)?'Ajouter':'Modifier';
		}	
	}
	else
	{
		include('includes/haut.inc.php');
		echo ("<h2>".$action_label." un article</h2>");
	?><!--partie html-->
<form action="article.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name='post' value="1"> <!-- Permet de savoir si on se trouve en traitement -->
	<input type="hidden" name='id' value="<?php if (isset($id)) echo $id; ?>"> <!-- Permet de savoir si on se trouve en modification -->
	
	<div class="clearfix">
		<label for="titre">Titre</label>
		<div class="input"><input type="text" name="titre" id="titre" value="<?php if (isset($data['titre'])) echo $data['titre']; ?>"></div> 
	</div>
	
	<div class="clearfix">
		<label for="texte">Texte</label>
		<div class="input"><textarea name="texte" id="texte"><?php if (isset($data['texte'])) echo $data['texte']; ?></textarea></div> 
	</div>
	
	<div class="clearfix"> <!--info de taille-->
    	<label>taille max 512 ko </label>
    	<div class="input"><input type="file" name="image" /></div>
    </div>
	
	<div class="clearfix">
    	
    	<label>Tags (optionnel)</label><!-- zone de saisie du tag -->
    	<div class="input"><input type="text" name="tags" id="tags" style="height:35px;" placeholder="tag1,tag2,tag3,..." value="<?php if(isset($data))echo $data['tag']; ?>" /></div>
    </div>
	
	<div class="form-actions"> <!--action du formulaire-->
		<input type="submit" value="<?php echo $action_label; ?>" class="btn btn-large btn-primary"> 
	</div>
</form>
<?php
	require_once('includes/bas.inc.php');
	}