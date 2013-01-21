<?php
	
	include('includes/connexion.inc.php');
	include('includes/fonctions.inc.php');//inclusions
	
	if(!isset($_POST['connexion']))
	{
		include('includes/haut.inc.php'); 
	}
	
	$email_ok='email';//def var
	$mdp_ok='mdp';
	
	$id = (int)var_get('id');
	
	if ($id) //test id
	{
		setcookie('sid', '', 1);
		header ('Location:index.php');	
	}
	
	
	if (isset($_POST['connexion'])) //test de la connexion
	{
		$email = mysql_real_escape_string(var_post('email'));
		$mdp = mysql_real_escape_string(var_post('password'));
		
		if (!$email || !$mdp) //test email ou mdp
		{
			connecte_notif(0, 'utilisateur', 'erreur-login-password-vide');
			header('location:conn.php');
			exit();
		}
		//requete de recuperation pour validation utilisateur
		$sql = 'SELECT mail, password FROM utilisateurs WHERE mail = "'.$email.'" AND password = "'.$mdp.'" LIMIT 1' ;
		$requete = mysql_query($sql);
		
		if(mysql_num_rows($requete) == 0) //si requete nulle
		{
			connecte_notif(0, 'utilisateur', 'erreur-login');//erreur-login
			header('location:conn.php');
			exit();
		}
		
		else
		{
			$sid=md5($email.time()); //cryptage du mail avec horodateur en md5 = sid
			
			$sql="UPDATE utilisateurs SET sid = '$sid' WHERE mail = '$email'";//ajout du sid a la base
			$requete = mysql_query($sql);
			setcookie('sid', $sid, time()+15*60);//creation cookie
			connecte_notif(0, 'utilisateur', 'connecte');
			header('location:index.php');
			exit();
		
			
		}
	}
	
	?>

<h5>Veuillez remplir les champs suivants pour vous connecter : </h5><!--formulaire de connxion-->
	<form  id="form_connexion" action="conn.php" method="post">
    	<label>E-mail :</label><input type="text" name="email" id="email" placeholder="Votre email"></br>
        <label>Mot de Passe :</label><input type="password" name="password" id="password" placeholder="Votre mot de passe""></br>
        <input type ="submit" value = "connexion" name="connexion" id="connexion">
   	</form>
	<script type="text/javascript">
		$(function() { 
			$(" #form_connexion").submit(function(){
			  var email = $("#mail").val();
			  var mdp = $("#password").val();
			    	if (!email || !mdp ) {
					//console.debug("Aie !"); //affichage dans debugger
					$("#notif").hide();
					$("#notif span").html("ERREUR : Veuillez remplir tous les champs");
					$("#notif").removeClass();
							   .addClass("alert-error")
							   .show()
							   
				 return false;
				}
				
				else {
				return true;}
			});
		});
	</script>


<?php
	include('includes/bas.inc.php');
?>