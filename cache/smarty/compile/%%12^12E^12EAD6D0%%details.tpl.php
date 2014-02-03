<?php /* Smarty version 2.6.20, created on 2013-12-20 17:41:05
         compiled from admin/categories/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Categories</title>
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
				<a href="/admin/categories/">Categories</a> &raquo; 
				<a href="#"><?php if (isset ( $this->_tpl_vars['categoryData'] )): ?>Edit Category<?php else: ?>Add a category<?php endif; ?></a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/categories/details.php<?php if (isset ( $this->_tpl_vars['categoryData'] )): ?>?code=<?php echo $this->_tpl_vars['categoryData']['category_code']; ?>
<?php endif; ?>" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">Category Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="category_active" id="category_active" value="1" <?php if ($this->_tpl_vars['categoryData']['category_active'] == 1): ?> checked="checked"<?php endif; ?> />
						</p>
					</div>
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['category_name'] )): ?> class="error"<?php endif; ?>>Name</a></h4>					
						<p class="short">
							<input type="text" name="category_name" id="category_name" value="<?php echo $this->_tpl_vars['categoryData']['category_name']; ?>
" size="40"/>
						</p>
					</div>
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['category_description'] )): ?> class="error"<?php endif; ?>>Description</a></h4>					
						<p class="short">
							<textarea id="category_description" name="category_description" cols="60" rows="5"><?php echo $this->_tpl_vars['categoryData']['category_description']; ?>
</textarea>
						</p>
					</div>					
					<div class="article">
						<p class="short">
							<a class="link" href="javascript:submitForm();">Save Details</a>
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
			nicEditors.findEditor(\'category_description\').saveContent();	
			document.forms.detailsForm.submit();					 
		}		
		
		$( document ).ready(function() {
		
			new nicEditor({
				iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
				/* buttonList 	: [\'bold\',\'italic\',\'underline\',\'left\',\'center\', \'ol\', \'ul\', \'xhtml\', \'fontFormat\', \'fontFamily\', \'fontSize\', \'unlink\', \'link\', \'strikethrough\', \'superscript\', \'subscript\'], */
				buttonList 	: [],
				maxHeight 	: \'800\'
			}).panelInstance(\'category_description\');		
							
			$(\'#continent_code\').change(function() {
			
			var continent	= $(\'#continent_code :selected\').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/categories/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['categoryData'] )): ?>code=<?php echo $this->_tpl_vars['categoryData']['category_code']; ?>
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
					url: "/admin/categories/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['categoryData'] )): ?>code=<?php echo $this->_tpl_vars['categoryData']['category_code']; ?>
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
					url: "/admin/categories/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['categoryData'] )): ?>code=<?php echo $this->_tpl_vars['categoryData']['cafe_code']; ?>
<?php endif; ?><?php echo '&cafe_code_search="+country,
					dataType: "html",
					success: function(items){
						//show table
						$(\'#cafe_code\').html(items);
					}
				});	
				
				return false;
				
			});			
		});			
		</script>
		'; ?>
			
	</body>
</html>