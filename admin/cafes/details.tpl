<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Cafe</title>
		{include_php file='admin/includes/css.php'}
		{include_php file='admin/includes/javascript.php'}
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		{literal}
		<script type="text/javascript">
		var map;
		function mapa()
		{
			var opts = {'center': new google.maps.LatLng(42.505582498336494, 12.76611328125), 'zoom':6, 'mapTypeId': google.maps.MapTypeId.ROADMAP }
			map = new google.maps.Map(document.getElementById('mapdiv'),opts);
			
			google.maps.event.addListener(map,'click',function(event) {
				document.getElementById('cafe_latitude').value = event.latLng.lat()
				document.getElementById('cafe_longitude').value = event.latLng.lng()	
			})

			google.maps.event.addListener(map,'mousemove',function(event) {
				document.getElementById('latspan').innerHTML = event.latLng.lat()
				document.getElementById('lngspan').innerHTML = event.latLng.lng()
			});
			
		}
		</script>
		{/literal}
	</head>
	<body onload="mapa()">
		<div id="wrapper">
			{include_php file='admin/includes/header.php'}
			{include_php file='admin/includes/menu.php'}
			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/cafes/">Cafes</a> &raquo; 
				<a href="#">{if isset($cafeData)}Edit Cafe{else}Add a cafe{/if}</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/cafes/details.php{if isset($cafeData)}?code={$cafeData.cafe_code}{/if}" method="post"  enctype="multipart/form-data">
				<div class="col">						
					<div class="article">
						<h4><a href="#"{if isset($errorArray.cafe_featured)} class="error"{/if}>Featured?</a>{if isset($errorArray.cafe_featured)} <br />- {$errorArray.cafe_featured}{/if}</h4>
						<p class="short">
							{if isset($cafeData)}
							<input type="checkbox" name="cafe_featured" id="cafe_featured" value="1" {if $cafeData.cafe_featured eq 1} checked="checked"{/if} />
							{else}
								<span class="success">Please add a cafe first before you selected as featured. This will be displayed on the locations page. <a href="/locations/" target="_blank">Click to view locations here.</a></span>
							{/if}
						</p>
					</div>					
					<div class="article">
						<h4><a href="#"{if isset($errorArray.cafe_name)} class="error"{/if}>Name</a></h4>					
						<p class="short">
							<input type="text" name="cafe_name" id="cafe_name" value="{$cafeData.cafe_name}" size="40"/>
						</p>
					</div>					
					<div class="article">
						<h4><a href="#">Continent</a></h4>					
						<p class="short">
							<select id="continent_code" name="continent_code">
								<option value=""> --- </option>
								{html_options options=$continentPairs selected=$cafeData.continent_code}</td>
							</select>
						</p>
					</div>		
					<div class="article">
						<h4><a href="#">Country</a></h4>					
						<p class="short" id="countryp">
							<select id="country_code" name="country_code">
								<option value="{$cafeData.country_code}">{$cafeData.country_name|default:" --- "}</option>
							</select>
						</p>
					</div>	
					<div class="article">
						<h4><a href="#"{if isset($errorArray.city_code)} class="error"{/if}>City</a></h4>					
						<p class="short" id="cityp">
							<select id="city_code" name="city_code">
								<option value="{$cafeData.city_code}">{$cafeData.city_name|default:" --- "}</option>
							</select>						
						</p>
					</div>					
					<div class="article">
						<h4><a href="#"{if isset($errorArray.cafe_latitude)} class="error"{/if}>Latitude</a> <br />- Please use map below.</h4>					
						<p class="short">
							<input type="text" name="cafe_latitude" id="cafe_latitude" value="{$cafeData.cafe_latitude}" size="40"/>
						</p>
					</div>		
					<div class="article">
						<h4><a href="#"{if isset($errorArray.cafe_longitude)} class="error"{/if}>Longitude</a> <br />- Please use map below.</h4>					
						<p class="short">
							<input type="text" name="cafe_longitude" id="cafe_longitude" value="{$cafeData.cafe_longitude}"  size="40"/>
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
						<h4><a href="#"{if isset($errorArray.cafe_bookinglink)} class="error"{/if}>Booking LInk</a> <br />- External booking link.</h4>					
						<p class="short">
							<input type="text" name="cafe_bookinglink" id="cafe_bookinglink" value="{$cafeData.cafe_bookinglink}"  size="40"/>
						</p>
					</div>					
					<div class="article">
						<h4><a href="#"{if isset($errorArray.logofile)} class="error"{/if}>Logo Image</a> <br />- Image will be used on the cafe details page. Small image.</h4>	
						{if isset($errorArray.logofile)} <br /><span class="error">{$errorArray.logofile}</span>{/if}						
						<p class="short">
							<input type="file" id="logofile" name="logofile" />
						</p>
						{if isset($cafeData)}
						<p>
							{if $cafeData.cafe_image_logo neq ''}
								<img src="{$cafeData.cafe_image_logo}" width="100" />
							{else}
							<span class="error">No logo image has been uploaded yet.</span>
							{/if}
						</p>
						{/if}
					</div>					
					<div class="article">
						<h4><a href="#"{if isset($errorArray.searchfile)} class="error"{/if}>Search Image</a><br />- Image will be used when cafes are being searched.</h4>
						{if isset($errorArray.searchfile)} <br /><span class="error">{$errorArray.searchfile}</span>{/if}							
						<p class="short">
							<input type="file" id="searchfile" name="searchfile" />
						</p>
						{if isset($cafeData)}
						<p>
							{if $cafeData.cafe_image_search neq ''}
								<img src="{$cafeData.cafe_image_search}" width="160" />
							{else}
							<span class="error">No search image has been uploaded yet.</span>
							{/if}
						</p>
						{/if}						
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
							<textarea id="cafe_address" name="cafe_address" cols="35" rows="5">{$cafeData.cafe_address}</textarea>
						</p>
					</div>
					<div class="article">
						<h4><a href="#"{if isset($errorArray.cafe_openinghours)} class="error"{/if}>Opening Week Days</a></h4>					
						<p class="short">
							{if isset($cafeData)}
							<textarea id="cafe_openinghours" name="cafe_openinghours" cols="35" rows="14">{$cafeData.cafe_openinghours}</textarea>
							{else}
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
							{/if}
						</p>
					</div>
					<div class="article">
						<h4><a href="#"{if isset($errorArray.cafe_telephone)} class="error"{/if}>Telephone</a> <br />- e.g. +39 1 419 4849 </h4>					
						<p class="short">
							<input type="text" name="cafe_telephone" id="cafe_telephone" value="{$cafeData.cafe_telephone}" size="40"/>
						</p>
					</div>					
					</div>					
				</div>
				<div class="col fr">
					<div class="article">
						<h4><a href="{if isset($cafeData)}/admin/cafes/images.php?code={$cafeData.cafe_code}{else}#{/if}">Gallery</a></h4>					
						<p class="short">
							{if isset($cafeData)}<span class="success">Add images for this cafe.</span>{else}<span class="error">Please add a cafe before adding images</span>{/if}
						</p>
					</div>	
					<div class="article">
						<h4><a href="{if isset($cafeData)}/admin/cafes/featured.php?code={$cafeData.cafe_code}{else}#{/if}">Feature Images</a></h4>					
						<p class="short">
							{if isset($cafeData)}<span class="success">Select this cafe as feature and add an image for it</span>{else}<span class="error">Please add a cafe before selecting it as featured</span>{/if}
						</p>
					</div>
					<div class="article">
						<h4><a href="{if isset($cafeData)}/admin/cafes/menus/?code={$cafeData.cafe_code}{else}#{/if}">Menu</a></h4>					
						<p class="short">
							{if isset($cafeData)}<span class="success">Add or update menu foods for this cafe</span>{else}<span class="error">Please add a cafe before you can add a menu</span>{/if}
						</p>
					</div>					
				</div>				
				</form>					
				<div class="clr"></div>
			</div>
			{include_php file='admin/includes/footer.php'}
		</div>
		{literal}	
		<script type="text/javascript">
		function submitForm() {
			nicEditors.findEditor('cafe_address').saveContent();	
			nicEditors.findEditor('cafe_openinghours').saveContent();	
			document.forms.detailsForm.submit();					 
		}		
		
		$( document ).ready(function() {
		
			new nicEditor({
				iconsPath	: '/library/javascript/nicedit/nicEditorIcons.gif',
				/* buttonList 	: ['bold','italic','underline','left','center', 'ol', 'ul', 'xhtml', 'fontFormat', 'fontFamily', 'fontSize', 'unlink', 'link', 'strikethrough', 'superscript', 'subscript'], */
				buttonList 	: [],
				maxHeight 	: '800'
			}).panelInstance('cafe_address');
			
			new nicEditor({
				iconsPath	: '/library/javascript/nicedit/nicEditorIcons.gif',
				buttonList 	: ['xhtml'], 
				maxHeight 	: '800'
			}).panelInstance('cafe_openinghours');
			
			$('#continent_code').change(function() {
			
			var continent	= $('#continent_code :selected').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/cafes/details.php",
					data: "{/literal}{if isset($cafeData)}code={$cafeData.cafe_code}{/if}{literal}&country_code_search="+continent,
					dataType: "html",
					success: function(items){
						//show table
						$('#country_code').html(items);
					}
				});	
				
				return false;
				
			});	

			$('#country_code').change(function() {
			
				var country	= $('#country_code :selected').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/cafes/details.php",
					data: "{/literal}{if isset($cafeData)}code={$cafeData.cafe_code}{/if}{literal}&city_code_search="+country,
					dataType: "html",
					success: function(items){
						//show table
						$('#city_code').html(items);
					}
				});	
				
				return false;
				
			});
		});			
		</script>
		{/literal}			
	</body>
</html>