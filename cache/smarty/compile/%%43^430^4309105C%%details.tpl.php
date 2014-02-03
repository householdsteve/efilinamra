<?php /* Smarty version 2.6.20, created on 2013-10-29 14:33:03
         compiled from admin/cities/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/cities/details.tpl', 33, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Cities</title>
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
				<a href="/admin/cities/">Cities</a> &raquo; 
				<a href="#"><?php if (isset ( $this->_tpl_vars['cityData'] )): ?>Edit city<?php else: ?>Add a city<?php endif; ?></a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/cities/details.php<?php if (isset ( $this->_tpl_vars['cityData'] )): ?>?code=<?php echo $this->_tpl_vars['cityData']['city_code']; ?>
<?php endif; ?>" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">City Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="city_active" id="city_active" value="1" <?php if ($this->_tpl_vars['cityData']['city_active'] == 1): ?> checked="checked"<?php endif; ?> />
						</p>
					</div>
					<div class="article">
						<h4><a href="#" <?php if (isset ( $this->_tpl_vars['errorArray']['continent_code'] )): ?> class="error"<?php endif; ?>>Continent</a></h4>					
						<p class="short">
							<select id="continent_code" name="continent_code">
								<option value=""> --- </option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['continentPairs'],'selected' => $this->_tpl_vars['cityData']['continent_code']), $this);?>
</td>
							</select>
						</p>
					</div>		
					<div class="article">
						<h4><a href="#" <?php if (isset ( $this->_tpl_vars['errorArray']['country_code'] )): ?> class="error"<?php endif; ?>>Country</a></h4>					
						<p class="short" id="countryp">
						<span class="success"><?php echo $this->_tpl_vars['cityData']['country_name']; ?>
</span>
						<input type="hidden" name="country_code" id="country_code" value="<?php echo $this->_tpl_vars['cityData']['country_code']; ?>
" />
						</p>
					</div>					
					<div class="article">
						<h4><a href="#" <?php if (isset ( $this->_tpl_vars['errorArray']['city_name'] )): ?> class="error"<?php endif; ?>>Name</a></h4>					
						<p class="short">
							<input type="text" name="city_name" id="city_name" value="<?php echo $this->_tpl_vars['cityData']['city_name']; ?>
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
		
		$( document ).ready(function() {
				
			$(\'#continent_code\').change(function() {
			
			var continent	= $(\'#continent_code :selected\').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/cities/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['cityData'] )): ?>code=<?php echo $this->_tpl_vars['cityData']['city_code']; ?>
<?php endif; ?><?php echo '&country_code_search="+continent,
					dataType: "html",
					success: function(items){
						//show table
						$(\'#countryp\').html(items);
					}
				});	
			});
		});			
		</script>
		'; ?>
			
	</body>
</html>