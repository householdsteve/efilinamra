<?php /* Smarty version 2.6.20, created on 2013-08-29 17:39:10
         compiled from admin/menus/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/menus/default.tpl', 42, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
		<script type="text/javascript" language="javascript" src="default.js"></script>
		<title>Menus</title>
	</head>
	<body>
		<div id="wrapper">
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/menu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/menus/">Menus</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<a class="link" href="/admin/menus/details.php">Add new menu</a>
				<div id="tableContent" align="center">
					<!-- Start Content Table -->
					<div class="content_table">
						<form name="htmlForm" id="htmlForm" action="/admin/bookings/" method="post">
							<table border="0" cellspacing="0" cellpadding="0" id="dataTable">							
								<thead>
								<tr>
									<th>Added</th>
									<th>Code</th>
									<th>Name</th>
									<th>Category</th>
									<th>Cafe</th>
									<th>City</th>
									<th>Country</th>
									<th>Continent</th>
									<th>Active</th>
								</tr>
								</thead>							
							   <tbody>
							  <?php $_from = $this->_tpl_vars['menuData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							  <tr>
								<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['menu_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
								<td align="left"><a href="/admin/menus/details.php?code=<?php echo $this->_tpl_vars['item']['menu_code']; ?>
"><?php echo $this->_tpl_vars['item']['menu_code']; ?>
</a></td>	
								<td align="left"><?php echo $this->_tpl_vars['item']['menu_name']; ?>
</td>									
								<td align="left"><?php echo $this->_tpl_vars['item']['category_name']; ?>
</td>	
								<td align="left"><?php echo $this->_tpl_vars['item']['cafe_name']; ?>
</td>	
								<td align="left"><?php echo $this->_tpl_vars['item']['city_name']; ?>
</td>	
								<td align="left"><?php echo $this->_tpl_vars['item']['country_name']; ?>
</td>									
								<td align="left"><?php echo $this->_tpl_vars['item']['continent_name']; ?>
</td>	
								<td align="left"><?php if ($this->_tpl_vars['item']['menu_active'] == '1'): ?><span class="success">Active</span><?php else: ?><span class="error">Not Active</span><?php endif; ?></td>
							  </tr>
							  <?php endforeach; endif; unset($_from); ?>     
							  </tbody>
							</table>
						 </form>
					 </div>
					 <!-- End Content Table -->
					<div class="clear"></div>				
				
				</div>
			</div>							
			<div class="clr"></div>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			</div>
	</body>
</html>