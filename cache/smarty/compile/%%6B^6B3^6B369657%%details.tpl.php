<?php /* Smarty version 2.6.20, created on 2013-08-31 14:42:05
         compiled from admin/countries/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/countries/details.tpl', 33, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Countries</title>
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
				<a href="/admin/countries/">Countries</a> &raquo; 
				<a href="#"><?php if (isset ( $this->_tpl_vars['countryData'] )): ?>Edit country<?php else: ?>Add a country<?php endif; ?></a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/countries/details.php<?php if (isset ( $this->_tpl_vars['countryData'] )): ?>?code=<?php echo $this->_tpl_vars['countryData']['country_code']; ?>
<?php endif; ?>" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">Country Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="country_active" id="country_active" value="1" <?php if ($this->_tpl_vars['countryData']['country_active'] == 1): ?> checked="checked"<?php endif; ?> />
						</p>
					</div>
					<div class="article">
						<h4><a href="#" <?php if (isset ( $this->_tpl_vars['errorArray']['country_name'] )): ?> class="error"<?php endif; ?>>Continent</a></h4>					
						<p class="short">
							<select id="continent_code" name="continent_code">
								<option value=""> --- </option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['continentPairs'],'selected' => $this->_tpl_vars['countryData']['continent_code']), $this);?>
</td>
							</select>
						</p>
					</div>												
					<div class="article">
						<h4><a href="#" <?php if (isset ( $this->_tpl_vars['errorArray']['country_name'] )): ?> class="error"<?php endif; ?>>Name</a></h4>					
						<p class="short">
							<input type="text" name="country_name" id="country_name" value="<?php echo $this->_tpl_vars['countryData']['country_name']; ?>
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