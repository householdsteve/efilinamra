<?php /* Smarty version 2.6.20, created on 2014-01-27 15:45:10
         compiled from admin/cafes/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/cafes/details.tpl', 65, false),array('modifier', 'default', 'admin/cafes/details.tpl', 73, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Cafe</title>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<?php echo '
		<script type="text/javascript">
		var map;
		function mapa()
		{
			var opts = {\'center\': new google.maps.LatLng(42.505582498336494, 12.76611328125), \'zoom\':6, \'mapTypeId\': google.maps.MapTypeId.ROADMAP }
			map = new google.maps.Map(document.getElementById(\'mapdiv\'),opts);
			
			google.maps.event.addListener(map,\'click\',function(event) {
				document.getElementById(\'cafe_latitude\').value = event.latLng.lat()
				document.getElementById(\'cafe_longitude\').value = event.latLng.lng()	
			})

			google.maps.event.addListener(map,\'mousemove\',function(event) {
				document.getElementById(\'latspan\').innerHTML = event.latLng.lat()
				document.getElementById(\'lngspan\').innerHTML = event.latLng.lng()
			});
			
		}
		</script>
		'; ?>

	</head>
	<body onload="mapa()">
		<div id="wrapper">
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/menu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/cafes/">Cafes</a> &raquo; 
				<a href="#"><?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>Edit Cafe<?php else: ?>Add a cafe<?php endif; ?></a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/cafes/details.php<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>?code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
<?php endif; ?>" method="post"  enctype="multipart/form-data">
				<div class="col">						
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['cafe_featured'] )): ?> class="error"<?php endif; ?>>Featured?</a><?php if (isset ( $this->_tpl_vars['errorArray']['cafe_featured'] )): ?> <br />- <?php echo $this->_tpl_vars['errorArray']['cafe_featured']; ?>
<?php endif; ?></h4>
						<p class="short">
							<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>
							<input type="checkbox" name="cafe_featured" id="cafe_featured" value="1" <?php if ($this->_tpl_vars['cafeData']['cafe_featured'] == 1): ?> checked="checked"<?php endif; ?> />
							<?php else: ?>
								<span class="success">Please add a cafe first before you selected as featured. This will be displayed on the locations page. <a href="/locations/" target="_blank">Click to view locations here.</a></span>
							<?php endif; ?>
						</p>
					</div>					
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['cafe_name'] )): ?> class="error"<?php endif; ?>>Name</a></h4>					
						<p class="short">
							<input type="text" name="cafe_name" id="cafe_name" value="<?php echo $this->_tpl_vars['cafeData']['cafe_name']; ?>
" size="40"/>
						</p>
					</div>					
					<div class="article">
						<h4><a href="#">Continent</a></h4>					
						<p class="short">
							<select id="continent_code" name="continent_code">
								<option value=""> --- </option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['continentPairs'],'selected' => $this->_tpl_vars['cafeData']['continent_code']), $this);?>
</td>
							</select>
						</p>
					</div>		
					<div class="article">
						<h4><a href="#">Country</a></h4>					
						<p class="short" id="countryp">
							<select id="country_code" name="country_code">
								<option value="<?php echo $this->_tpl_vars['cafeData']['country_code']; ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['cafeData']['country_name'])) ? $this->_run_mod_handler('default', true, $_tmp, " --- ") : smarty_modifier_default($_tmp, " --- ")); ?>
</option>
							</select>
						</p>
					</div>	
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['city_code'] )): ?> class="error"<?php endif; ?>>City</a></h4>					
						<p class="short" id="cityp">
							<select id="city_code" name="city_code">
								<option value="<?php echo $this->_tpl_vars['cafeData']['city_code']; ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['cafeData']['city_name'])) ? $this->_run_mod_handler('default', true, $_tmp, " --- ") : smarty_modifier_default($_tmp, " --- ")); ?>
</option>
							</select>						
						</p>
					</div>					
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['cafe_latitude'] )): ?> class="error"<?php endif; ?>>Latitude</a> <br />- Please use map below.</h4>					
						<p class="short">
							<input type="text" name="cafe_latitude" id="cafe_latitude" value="<?php echo $this->_tpl_vars['cafeData']['cafe_latitude']; ?>
" size="40"/>
						</p>
					</div>		
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['cafe_longitude'] )): ?> class="error"<?php endif; ?>>Longitude</a> <br />- Please use map below.</h4>					
						<p class="short">
							<input type="text" name="cafe_longitude" id="cafe_longitude" value="<?php echo $this->_tpl_vars['cafeData']['cafe_longitude']; ?>
"  size="40"/>
						</p>
					</div>
					<div class="article">
						<h4><a href="#">Current Longitude and Latitude Details</a></h4>					
						<p class="short">
							<div>Lattitude:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="latspan"></span></div>
							<div>Longitude:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="lngspan"></span></div>						
						</p>
					</div>
					<div class="article">
						<h4><a href="#">Map</a></h4>					
						<p class="short">
							&nbsp;&nbsp;
							<div id="mapdiv" style="width: 900px; height:400px;"></div>	
						</p>						
					</div>
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['cafe_bookinglink'] )): ?> class="error"<?php endif; ?>>Booking LInk</a> <br />- External booking link.</h4>					
						<p class="short">
							<input type="text" name="cafe_bookinglink" id="cafe_bookinglink" value="<?php echo $this->_tpl_vars['cafeData']['cafe_bookinglink']; ?>
"  size="40"/>
						</p>
					</div>					
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['logofile'] )): ?> class="error"<?php endif; ?>>Logo Image</a> <br />- Image will be used on the cafe details page. Small image.</h4>	
						<?php if (isset ( $this->_tpl_vars['errorArray']['logofile'] )): ?> <br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['logofile']; ?>
</span><?php endif; ?>						
						<p class="short">
							<input type="file" id="logofile" name="logofile" />
						</p>
						<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>
						<p>
							<?php if ($this->_tpl_vars['cafeData']['cafe_image_logo'] != ''): ?>
								<img src="<?php echo $this->_tpl_vars['cafeData']['cafe_image_logo']; ?>
" width="100" />
							<?php else: ?>
							<span class="error">No logo image has been uploaded yet.</span>
							<?php endif; ?>
						</p>
						<?php endif; ?>
					</div>					
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['searchfile'] )): ?> class="error"<?php endif; ?>>Search Image</a><br />- Image will be used when cafes are being searched.</h4>
						<?php if (isset ( $this->_tpl_vars['errorArray']['searchfile'] )): ?> <br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['searchfile']; ?>
</span><?php endif; ?>							
						<p class="short">
							<input type="file" id="searchfile" name="searchfile" />
						</p>
						<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>
						<p>
							<?php if ($this->_tpl_vars['cafeData']['cafe_image_search'] != ''): ?>
								<img src="<?php echo $this->_tpl_vars['cafeData']['cafe_image_search']; ?>
" width="160" />
							<?php else: ?>
							<span class="error">No search image has been uploaded yet.</span>
							<?php endif; ?>
						</p>
						<?php endif; ?>						
					</div>					
					<div class="article">
						<p class="short">
							<a class="link" href="javascript:submitForm();">Save Details</a>
						</p>
					</div>						
				</div>	
				<div class="col">	
					<div class="article">
						<h4><a href="#">Address</a> - Separate lines by space.</h4>					
						<p class="short">
							<textarea id="cafe_address" name="cafe_address" cols="35" rows="5"><?php echo $this->_tpl_vars['cafeData']['cafe_address']; ?>
</textarea>
						</p>
					</div>
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['cafe_openinghours'] )): ?> class="error"<?php endif; ?>>Opening Week Days</a></h4>					
						<p class="short">
							<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>
							<textarea id="cafe_openinghours" name="cafe_openinghours" cols="35" rows="14"><?php echo $this->_tpl_vars['cafeData']['cafe_openinghours']; ?>
</textarea>
							<?php else: ?>
							<textarea id="cafe_openinghours" name="cafe_openinghours" cols="35" rows="15">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tbody><tr class="table-head">
										<td colspan="2">Hours</td>
									  </tr>
									  <tr>
										<td>Mon - Thur</td>
										<td>10:00 - 21:30</td>
									  </tr>
									  <tr>
										<td>Fri - Sun</td>
										<td>10:00 - 00</td>
									  </tr>
									</tbody></table>							
							</textarea>
							<?php endif; ?>
						</p>
					</div>
					<div class="article">
						<h4><a href="#"<?php if (isset ( $this->_tpl_vars['errorArray']['cafe_telephone'] )): ?> class="error"<?php endif; ?>>Telephone</a> <br />- e.g. +39 1 419 4849 </h4>					
						<p class="short">
							<input type="text" name="cafe_telephone" id="cafe_telephone" value="<?php echo $this->_tpl_vars['cafeData']['cafe_telephone']; ?>
" size="40"/>
						</p>
					</div>					
					</div>					
				</div>
				<div class="col fr">
					<div class="article">
						<h4><a href="<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>/admin/cafes/images.php?code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
<?php else: ?>#<?php endif; ?>">Gallery</a></h4>					
						<p class="short">
							<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?><span class="success">Add images for this cafe.</span><?php else: ?><span class="error">Please add a cafe before adding images</span><?php endif; ?>
						</p>
					</div>	
					<div class="article">
						<h4><a href="<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>/admin/cafes/featured.php?code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
<?php else: ?>#<?php endif; ?>">Feature Images</a></h4>					
						<p class="short">
							<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?><span class="success">Select this cafe as feature and add an image for it</span><?php else: ?><span class="error">Please add a cafe before selecting it as featured</span><?php endif; ?>
						</p>
					</div>
					<div class="article">
						<h4><a href="<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>/admin/cafes/menus/?code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
<?php else: ?>#<?php endif; ?>">Menu</a></h4>					
						<p class="short">
							<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?><span class="success">Add or update menu foods for this cafe</span><?php else: ?><span class="error">Please add a cafe before you can add a menu</span><?php endif; ?>
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
			nicEditors.findEditor(\'cafe_address\').saveContent();	
			nicEditors.findEditor(\'cafe_openinghours\').saveContent();	
			document.forms.detailsForm.submit();					 
		}		
		
		$( document ).ready(function() {
		
			new nicEditor({
				iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
				/* buttonList 	: [\'bold\',\'italic\',\'underline\',\'left\',\'center\', \'ol\', \'ul\', \'xhtml\', \'fontFormat\', \'fontFamily\', \'fontSize\', \'unlink\', \'link\', \'strikethrough\', \'superscript\', \'subscript\'], */
				buttonList 	: [],
				maxHeight 	: \'800\'
			}).panelInstance(\'cafe_address\');
			
			new nicEditor({
				iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
				buttonList 	: [\'xhtml\'], 
				maxHeight 	: \'800\'
			}).panelInstance(\'cafe_openinghours\');
			
			$(\'#continent_code\').change(function() {
			
			var continent	= $(\'#continent_code :selected\').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/cafes/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
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
					url: "/admin/cafes/details.php",
					data: "'; ?>
<?php if (isset ( $this->_tpl_vars['cafeData'] )): ?>code=<?php echo $this->_tpl_vars['cafeData']['cafe_code']; ?>
<?php endif; ?><?php echo '&city_code_search="+country,
					dataType: "html",
					success: function(items){
						//show table
						$(\'#city_code\').html(items);
					}
				});	
				
				return false;
				
			});
		});			
		</script>
		'; ?>
			
	</body>
</html>