<?php
mysql_connect('localhost','root',''); //connexion a mysql	
mysql_select_db('blog2');//selection base	
mysql_query("SET NAMES 'utf8'");//choix encodage
session_start();//debut de session