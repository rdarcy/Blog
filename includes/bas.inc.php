<?php

	$connecte = false;
	if(isset($_COOKIE['sid']))
	{
		$sql = "SELECT * FROM utilisateurs WHERE sid='".$_COOKIE['sid']."'";	
		$result =  mysql_query($sql);
		
		if(mysql_num_rows($result))
		{
			$connecte = true;
			$util = mysql_fetch_array($result);	
		}	
	}
?>

</div>
          
          <nav class="span4">
            <h2>Menu</h2>
            <form action="index.php" method="get">
            	<label for="rech">Recherche : </label>
            	<input type="text" name="r" id="rech" placeholder="Informatique, belles nanas" class="span3">&nbsp
            	<input type="submit" value="ok" class="btn">
            </form>
            
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <?php
                	if ($connecte)
					{
						echo '<li><a href="article.php">Rédiger un article</a></li>';
					}
				?>
                <?php
					if ($connecte)
					{
						echo '<li><a href="deco.php">Deconnexion</a></li>';                		
					}
					
					else 
					{
						echo '<li><a href="conn.php">Connexion</a></li>';
					}
				?>
            </ul>
  
          </nav>
          
        </div>
        
      </div>

      <footer>
        <p>&copy; Nilsine & ULCO 2012</p>

      </footer>

    </div>
    
	<script type="text/javascript">
		$(".cacher_notif").click(function(){
				$('.alert').slideUp();
				
			});
	</script>
  </body>
</html>