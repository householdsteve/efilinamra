<?php /* Smarty version 2.6.20, created on 2013-12-18 15:21:30
         compiled from admin/cafes/images.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/cafes/images.tpl', 41, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
		<title>Cafe Images</title>
	</head>
	<body>
		<div id="wrapper">
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/menu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/cafes/">Cafes</a> &raquo; 
				<a href="/admin/cafes/details.php?code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
"><?php echo $this->_tpl_vars['cafeData']['cafe_name']; ?>
</a> &raquo; 
				<a href="#">Images</a>
			</p>			
			<div id="main">
				<div class="clr"></div>
				<p class="linebreak"></p>
				<div class="clr"></div>
				<h3><?php echo $this->_tpl_vars['cafeData']['cafe_name']; ?>
 Images</h3>
				<div id="tableContent" align="center">				
					<!-- Start Content Table -->
					<div class="content_table">
						<form name="detailsForm" id="detailsForm" action="/admin/cafes/images.php?code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
" method="post">
						<table id="grid_table" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<th>Added</th>
							<th>Filename</th>
							<th>Image</th>
							<th>Description</th>
							<th>Order</th>
							<th></th>
							<th></th>
						   </tr>
						  <?php $_from = $this->_tpl_vars['cafeimageData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						  <tr>							  
							<td align="left" class="alt">
								<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['cafeimage_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

							</td>													
							<td align="left" class="alt">
								<input type="text" name="cafeimage_name_<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
" id="cafeimage_name_<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
" value="<?php echo $this->_tpl_vars['item']['cafeimage_name']; ?>
" />
							</td>
							<td align="left" class="alt">
								<img src="<?php echo $this->_tpl_vars['item']['cafeimage_path']; ?>
/<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
<?php echo $this->_tpl_vars['item']['cafeimage_extension']; ?>
" width="120" />
							</td>								
							<td align="left" class="alt">
								<textarea name="cafeimage_description_<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
" id="cafeimage_description_<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
" cols="30" rows="5"><?php echo $this->_tpl_vars['item']['cafeimage_description']; ?>
</textarea>
							</td>	
							<td align="left" class="alt">
								<select name="cafeimage_order_<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
" id="cafeimage_order_<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
">
									<?php unset($this->_sections['order']);
$this->_sections['order']['name'] = 'order';
$this->_sections['order']['start'] = (int)0;
$this->_sections['order']['loop'] = is_array($_loop=$this->_tpl_vars['imagecount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['order']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['order']['show'] = true;
$this->_sections['order']['max'] = $this->_sections['order']['loop'];
if ($this->_sections['order']['start'] < 0)
    $this->_sections['order']['start'] = max($this->_sections['order']['step'] > 0 ? 0 : -1, $this->_sections['order']['loop'] + $this->_sections['order']['start']);
else
    $this->_sections['order']['start'] = min($this->_sections['order']['start'], $this->_sections['order']['step'] > 0 ? $this->_sections['order']['loop'] : $this->_sections['order']['loop']-1);
if ($this->_sections['order']['show']) {
    $this->_sections['order']['total'] = min(ceil(($this->_sections['order']['step'] > 0 ? $this->_sections['order']['loop'] - $this->_sections['order']['start'] : $this->_sections['order']['start']+1)/abs($this->_sections['order']['step'])), $this->_sections['order']['max']);
    if ($this->_sections['order']['total'] == 0)
        $this->_sections['order']['show'] = false;
} else
    $this->_sections['order']['total'] = 0;
if ($this->_sections['order']['show']):

            for ($this->_sections['order']['index'] = $this->_sections['order']['start'], $this->_sections['order']['iteration'] = 1;
                 $this->_sections['order']['iteration'] <= $this->_sections['order']['total'];
                 $this->_sections['order']['index'] += $this->_sections['order']['step'], $this->_sections['order']['iteration']++):
$this->_sections['order']['rownum'] = $this->_sections['order']['iteration'];
$this->_sections['order']['index_prev'] = $this->_sections['order']['index'] - $this->_sections['order']['step'];
$this->_sections['order']['index_next'] = $this->_sections['order']['index'] + $this->_sections['order']['step'];
$this->_sections['order']['first']      = ($this->_sections['order']['iteration'] == 1);
$this->_sections['order']['last']       = ($this->_sections['order']['iteration'] == $this->_sections['order']['total']);
?>
										<option value="<?php echo $this->_sections['order']['iteration']; ?>
" <?php if ($this->_sections['order']['iteration'] == $this->_tpl_vars['item']['cafeimage_order']): ?>selected<?php endif; ?>><?php echo $this->_sections['order']['iteration']; ?>
</option>
									<?php endfor; endif; ?>
								</select>
							</td>		
							<td align="left" class="alt">
								<a class="link link_<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
" href="javascript:updateForm('<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
');">Update</a>	
							</td>							
							<td align="left" class="alt">
								<a class="link link_<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
" href="javascript:deleteForm('<?php echo $this->_tpl_vars['item']['cafeimage_code']; ?>
');">Delete</a>	
							</td>							
						  </tr>
						  <?php endforeach; else: ?>
							<tr>
								<td colspan="8">There are no current items in the system.</td>
							</tr>
						  <?php endif; unset($_from); ?>  						  						  							  
						</table>
						</form>
					</div>
					</div>
					<h3>Add an image</h3><span class="selecteditem">Please only add jpg, png and gif's.</span>
					<div id="tableContent" align="center">		
					<div class="content_table">		
					<form name="additemForm" id="additemForm" action="/admin/cafes/images.php?code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
" method="post"  enctype="multipart/form-data">					
						<table id="grid_table" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<th <?php if (isset ( $this->_tpl_vars['errorArray']['imagefile'] )): ?>class="error"<?php endif; ?>>Upload</th>
							<th <?php if (isset ( $this->_tpl_vars['errorArray']['cafeimage_name'] )): ?>class="error"<?php endif; ?>>Name</th>
							<th <?php if (isset ( $this->_tpl_vars['errorArray']['cafeimage_description'] )): ?>class="error"<?php endif; ?>>Description</th>
							<th></th>
						   </tr>						
						  <tr>		
							<td align="left" class="alt">
								<input type="file" id="imagefile" name="imagefile" />
							</td>
							<td align="left" class="alt">
								<input type="text" name="cafeimage_name" id="cafeimage_name" size="40" />
							</td>							
							<td align="left" class="alt">
								<textarea name="cafeimage_description" id="cafeimage_description" rows="5" cols="30"></textarea>
							</td>	
							<td colspan="2">
							<a class="link" href="javascript:addItemForm();">Add file</a>	
							</td>						
						  </tr>	
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

			<?php echo '
				<script type="text/javascript">
				
				function addItemForm() {
					document.forms.additemForm.submit();					 
				}			
				
				function updateForm(id) {					
					if(confirm(\'Are you sure you want to update this file ?\')) {
						$.ajax({ 
								type: "GET",
								url: "images.php",
								data: "code='; ?>
<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
<?php echo '&cafeimage_code_update="+id+"&cafeimage_name="+$(\'#cafeimage_name_\'+id).val()+"&cafeimage_order="+$(\'#cafeimage_order_\'+id).val() + "&cafeimage_description="+$(\'#cafeimage_description_\'+id).val(),
								dataType: "json",
								success: function(data){
										if(data.result == 1) {
											alert(\'Updated\');
											window.location.href = window.location.href;
										} else {
											alert(data.error);
										}
								}
						});							
					}
				}	
				
				function deleteForm(id) {	
					if(confirm(\'Are you sure you want to delete this file?\')) {

							$.ajax({ 
									type: "GET",
									url: "images.php",
									data: "code='; ?>
<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
<?php echo '&cafeimage_code_delete="+id,
									dataType: "json",
									success: function(data){
											if(data.result == 1) {
												alert(\'Deleted\');
												window.location.href = window.location.href;
											} else {
												alert(data.error);
											}
									}
							});								
						}
				}					
				</script>
			'; ?>

			</div>
	</body>
</html>