<?php /* Smarty version 2.6.20, created on 2013-08-29 16:15:49
         compiled from admin/menus/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/menus/details.tpl', 39, false),array('modifier', 'default', 'admin/menus/details.tpl', 47, false),)), $this); ?>
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
				<a href="/admin/menus/">Menus</a> &raquo; 
				<a href="#"><?php if (isset ( $this->_tpl_vars['menuData'] )): ?>Edit Category<?php else: ?>Add a category<?php endif; ?></a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/menus/details.php<?php if (isset ( $this->_tpl_vars['menuData'] )): ?>?code=<?php echo $this->_tpl_vars['menuData']['menu_code']; ?>
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
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['continent_code'] )): ?> class="error"<?php endif; ?>>Continent</a></h4>					
						<p class="short">
							<select id="continent_code" name="continent_code">
								<option value=""> --- </option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['continentPairs'],'selected' => $this->_tpl_vars['menuData']['continent_code']), $this);?>
</td>
							</select>
						</p>
					</div>		
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['country_code'] )): ?> class="error"<?php endif; ?>>Country</a></h4>					
						<p class="short" id="countryp">
							<select id="country_code" name="country_code">
								<option value="<?php echo $this->_tpl_vars['menuData']['country_code']; ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['menuData']['country_name'])) ? $this->_run_mod_handler('default', true, $_tmp, " --- ") : smarty_modifier_default($_tmp, " --- ")); ?>
</option>
							</select>
						</p>
					</div>	
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['city_code'] )): ?> class="error"<?php endif; ?>>City</a></h4>					
						<p class="short" id="cityp">
							<select id="city_code" name="city_code">
								<option value="<?php echo $this->_tpl_vars['menuData']['city_code']; ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['menuData']['city_name'])) ? $this->_run_mod_handler('default', true, $_tmp, " --- ") : smarty_modifier_default($_tmp, " --- ")); ?>
</option>
							</select>						
						</p>
					</div>
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['cafe_code'] )): ?> class="error"<?php endif; ?>>Cafe</a></h4>					
						<p class="short" id="cafep">
							<select id="cafe_code" name="cafe_code">
								<option value="<?php echo $this->_tpl_vars['menuData']['cafe_code']; ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['menuData']['cafe_name'])) ? $this->_run_mod_handler('default', true, $_tmp, " --- ") : smarty_modifier_default($_tmp, " --- ")); ?>
</option>
							</select>						
						</p>
					</div>
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['category_code'] )): ?> class="error"<?php endif; ?>>Category</a></h4>					
						<p class="short" id="categoryp">
							<select id="category_code" name="category_code">
								<option value="<?php echo $this->_tpl_vars['menuData']['category_code']; ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['menuData']['category_name'])) ? $this->_run_mod_handler('default', true, $_tmp, " --- ") : smarty_modifier_default($_tmp, " --- ")); ?>
</option>
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
							
			$(\'#continent_code\').change(function() {
			
			var continent	= $(\'#continent_code :selected\').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/menus/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['menuData'] )): ?>code=<?php echo $this->_tpl_vars['menuData']['menu_code']; ?>
<?php endif; ?><?php echo '&country_code_search="+continent,
					dataType: "html",
					success: function(items){
						//show table
						$(\'#country_code\').html(items);
					}
				});	
				
				return false;
				
			});	

			$(\'#country_code\').change(function() {
			
				var country	= $(\'#country_code :selected\').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/menus/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['menuData'] )): ?>code=<?php echo $this->_tpl_vars['menuData']['menu_code']; ?>
<?php endif; ?><?php echo '&city_code_search="+country,
					dataType: "html",
					success: function(items){
						//show table
						$(\'#city_code\').html(items);
					}
				});	
				
				return false;
				
			});
			
			$(\'#city_code\').change(function() {
			
				var country	= $(\'#city_code :selected\').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/menus/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['menuData'] )): ?>code=<?php echo $this->_tpl_vars['menuData']['menu_code']; ?>
<?php endif; ?><?php echo '&cafe_code_search="+country,
					dataType: "html",
					success: function(items){
						//show table
						$(\'#cafe_code\').html(items);
					}
				});	
				
				return false;
				
			});

			$(\'#cafe_code\').change(function() {
			
				var cafe	= $(\'#cafe_code :selected\').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/menus/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['menuData'] )): ?>code=<?php echo $this->_tpl_vars['menuData']['menu_code']; ?>
<?php endif; ?><?php echo '&category_code_search="+cafe,
					dataType: "html",
					success: function(items){
						//show table
						$(\'#category_code\').html(items);
					}
				});	
				
				return false;
				
			});				
		});			
		</script>
		'; ?>
			
	</body>
</html>