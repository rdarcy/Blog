<?php /* Smarty version Smarty-3.1.12, created on 2013-01-18 11:09:24
         compiled from "templates\index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:2465650f92d641e2f22-85657593%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f07560281418c212564496accb7681386c7b59f' => 
    array (
      0 => 'templates\\index.phtml',
      1 => 1358506842,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2465650f92d641e2f22-85657593',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rech' => 0,
    'articles' => 0,
    'article' => 0,
    'connecte' => 0,
    'page' => 0,
    'tag' => 0,
    'nb_pages' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f92d643c23a8_09842662',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f92d643c23a8_09842662')) {function content_50f92d643c23a8_09842662($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\wamp\\www\\tp\\tp\\libs\\plugins\\modifier.date_format.php';
?> <html>
	<head>
		
	</head>
	<body>
		<?php if ($_smarty_tpl->tpl_vars['rech']->value){?>
			<h2>Resultat pour la recherche <?php echo $_smarty_tpl->tpl_vars['rech']->value;?>
 </h2>
		<?php }else{ ?>
			<h2>Derniers Articles</h2>
		<?php }?>
		<?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value){
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
			<h3><?php echo $_smarty_tpl->tpl_vars['article']->value['titre'];?>
</h3>
			<p><?php echo $_smarty_tpl->tpl_vars['article']->value['texte'];?>
</p>
			<?php if (isset($_smarty_tpl->tpl_vars['article']->value['image'])&&!empty($_smarty_tpl->tpl_vars['article']->value['image'])){?>
				<img src="<?php echo $_smarty_tpl->tpl_vars['article']->value['image'];?>
" />
			<?php }?>
			<?php if (!empty($_smarty_tpl->tpl_vars['article']->value['tag'])){?>
				<p>tags: <a href="index.php?&tag=<?php echo $_smarty_tpl->tpl_vars['article']->value['tag'];?>
"><?php echo $_smarty_tpl->tpl_vars['article']->value['tag'];?>
</a></p>
			<?php }?>
			<p><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value['date'],"%A %d/%m/%Y");?>
</p>
					
			<?php if (($_smarty_tpl->tpl_vars['connecte']->value)){?>
				<br><br>
				<a href="article.php?id=<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
" class="btn btn-primary">Modifier</a>
				<a href="supprimer-article.php?id=<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
" class="btn btn-danger"> Supprimer</a>   
			<?php }?>
				
				<hr>
			<?php } ?>
			
			<div class="pagination">
				<ul>
					<li class="prev<?php if ($_smarty_tpl->tpl_vars['page']->value<=1){?> disabled<?php }?>">
						<a href="?p=<?php if ($_smarty_tpl->tpl_vars['page']->value<=1){?>#<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
<?php }?><?php if (!empty($_smarty_tpl->tpl_vars['rech']->value)){?>&r=<?php echo $_smarty_tpl->tpl_vars['rech']->value;?>
<?php }?><?php if (isset($_smarty_tpl->tpl_vars['tag']->value)){?>&tag=<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
<?php }?>">&larr;Precedent</a>
					</li> <!-- reprensente des "left-arrow" -->
									
					<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['nb_pages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nb_pages']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?><!-- On boucle jusqu a l'avant dernier page-->
						<li <?php if ($_smarty_tpl->tpl_vars['page']->value==$_smarty_tpl->tpl_vars['i']->value){?> class="active"<?php }?>>
							<a href="?p=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
<?php if (!empty($_smarty_tpl->tpl_vars['rech']->value)){?>&r=<?php echo $_smarty_tpl->tpl_vars['rech']->value;?>
<?php }?><?php if (!empty($_smarty_tpl->tpl_vars['tag']->value)){?>&tag=<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
<?php }?>"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a>
						</li>						
					<?php }} ?><!-- On arrete de boucler --> 
					<li class="next<?php if ($_smarty_tpl->tpl_vars['page']->value>=$_smarty_tpl->tpl_vars['nb_pages']->value){?> disabled<?php }?>">
						<a href="?p=<?php if ($_smarty_tpl->tpl_vars['page']->value!=$_smarty_tpl->tpl_vars['nb_pages']->value){?><?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
<?php }else{ ?>#<?php }?><?php if (!empty($_smarty_tpl->tpl_vars['rech']->value)){?>&r=<?php echo $_smarty_tpl->tpl_vars['rech']->value;?>
<?php }?><?php if (!empty($_smarty_tpl->tpl_vars['tag']->value)){?>&tag=<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
<?php }?>">suivant &rarr;</a>
					</li>
				</ul>
			</div>
	</body>
</html>
<?php }} ?>