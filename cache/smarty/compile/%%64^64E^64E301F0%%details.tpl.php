<?php /* Smarty version 2.6.20, created on 2014-01-20 10:45:03
         compiled from admin/cafes/menus/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/cafes/menus/details.tpl', 41, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Menus</title>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
	</head>
	<body>
		<div id="wrapper">
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/menu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/cafes/">cafes</a> &raquo; 
				<a href="/admin/cafes/details.php?code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
"><?php echo $this->_tpl_vars['cafeData']['cafe_name']; ?>
</a> &raquo; 
				<a href="/admin/cafes/menus/?code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
">Menu</a> &raquo; 
				<a href="#"><?php if (isset ( $this->_tpl_vars['menuData'] )): ?><?php echo $this->_tpl_vars['menuData']['menu_name']; ?>
<?php else: ?>New Menu<?php endif; ?></a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/cafes/menus/details.php?cafe=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
<?php if (isset ( $this->_tpl_vars['menuData'] )): ?>&code=<?php echo $this->_tpl_vars['menuData']['menu_code']; ?>
<?php endif; ?>" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">Menu Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="menu_active" id="menu_active" value="1" <?php if ($this->_tpl_vars['menuData']['menu_active'] == 1): ?> checked="checked"<?php endif; ?> />
						</p>
					</div>
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['menu_name'] )): ?> class="error"<?php endif; ?>>Name</a></h4>					
						<p class="short">
							<input type="text" name="menu_name" id="menu_name" value="<?php echo $this->_tpl_vars['menuData']['menu_name']; ?>
" size="40"/>
						</p>
					</div>					
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['category_code'] )): ?> class="error"<?php endif; ?>>Category</a></h4>					
						<p class="short">
							<select id="category_code" name="category_code">
								<option value=""> --- </option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categoryData'],'selected' => $this->_tpl_vars['menuData']['category_code']), $this);?>
</td>
							</select>
						</p>
					</div>
					<div class="article">
						<p class="short">
							<a class="link" href="javascript:submitForm();">Save Details</a>
						</p>
					</div>						
				</div>	
				<div class="col">					
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['menu_description'] )): ?> class="error"<?php endif; ?>>Description</a></h4>					
						<p class="short">
							<textarea id="menu_description" name="menu_description" cols="60" rows="10"><?php echo $this->_tpl_vars['menuData']['menu_description']; ?>
</textarea>
						</p>
					</div>						
				</div>				
				</form>					
				<div class="clr"></div>
			</div>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		</div>
		<?php echo '	
		<script type="text/javascript">
		function submitForm() {
			nicEditors.findEditor(\'menu_description\').saveContent();	
			document.forms.detailsForm.submit();					 
		}		
		
		$( document ).ready(function() {
			
			new nicEditor({
				iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
				/* buttonList 	: [\'bold\',\'italic\',\'underline\',\'left\',\'center\', \'ol\', \'ul\', \'xhtml\', \'fontFormat\', \'fontFamily\', \'fontSize\', \'unlink\', \'link\', \'strikethrough\', \'superscript\', \'subscript\'], */
				buttonList 	: [],
				maxHeight 	: \'800\'
			}).panelInstance(\'menu_description\');								
		});			
		</script>
		'; ?>
			
	</body>
</html>