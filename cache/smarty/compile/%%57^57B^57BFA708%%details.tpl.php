<?php /* Smarty version 2.6.20, created on 2014-01-27 15:44:15
         compiled from admin/continents/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Continents</title>
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
				<a href="/admin/continents/">Continents</a> &raquo; 
				<a href="#"><?php if (isset ( $this->_tpl_vars['continentData'] )): ?>Edit Continent<?php else: ?>Add a Continent<?php endif; ?></a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/continents/details.php<?php if (isset ( $this->_tpl_vars['continentData'] )): ?>?code=<?php echo $this->_tpl_vars['continentData']['continent_code']; ?>
<?php endif; ?>" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">Continent Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="continent_active" id="continent_active" value="1" <?php if ($this->_tpl_vars['continentData']['continent_active'] == 1): ?> checked="checked"<?php endif; ?> />
						</p>
					</div>
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['continent_name'] )): ?> class="error"<?php endif; ?>>Name</a></h4>					
						<p class="short">
							<input type="text" name="continent_name" id="continent_name" value="<?php echo $this->_tpl_vars['continentData']['continent_name']; ?>
" size="40"/>
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
			document.forms.detailsForm.submit();					 
		}		
			
		</script>
		'; ?>
			
	</body>
</html>