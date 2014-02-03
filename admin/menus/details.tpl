<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Menus</title>
		{include_php file='admin/includes/css.php'}
		{include_php file='admin/includes/javascript.php'}	
	</head>
	<body>
		<div id="wrapper">
			{include_php file='admin/includes/header.php'}
			{include_php file='admin/includes/menu.php'}
			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/menus/">Menus</a> &raquo; 
				<a href="#">{if isset($menuData)}Edit Category{else}Add a category{/if}</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/menus/details.php{if isset($menuData)}?code={$menuData.menu_code}{/if}" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">Menu Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="menu_active" id="menu_active" value="1" {if $menuData.menu_active eq 1} checked="checked"{/if} />
						</p>
					</div>
					<div class="article">
						<h4><a href="#"{if isset($errorArray.menu_name)} class="error"{/if}>Name</a></h4>					
						<p class="short">
							<input type="text" name="menu_name" id="menu_name" value="{$menuData.menu_name}" size="40"/>
						</p>
					</div>					
					<div class="article">
						<h4><a href="#"{if isset($errorArray.continent_code)} class="error"{/if}>Continent</a></h4>					
						<p class="short">
							<select id="continent_code" name="continent_code">
								<option value=""> --- </option>
								{html_options options=$continentPairs selected=$menuData.continent_code}</td>
							</select>
						</p>
					</div>		
					<div class="article">
						<h4><a href="#"{if isset($errorArray.country_code)} class="error"{/if}>Country</a></h4>					
						<p class="short" id="countryp">
							<select id="country_code" name="country_code">
								<option value="{$menuData.country_code}">{$menuData.country_name|default:" --- "}</option>
							</select>
						</p>
					</div>	
					<div class="article">
						<h4><a href="#"{if isset($errorArray.city_code)} class="error"{/if}>City</a></h4>					
						<p class="short" id="cityp">
							<select id="city_code" name="city_code">
								<option value="{$menuData.city_code}">{$menuData.city_name|default:" --- "}</option>
							</select>						
						</p>
					</div>
					<div class="article">
						<h4><a href="#"{if isset($errorArray.cafe_code)} class="error"{/if}>Cafe</a></h4>					
						<p class="short" id="cafep">
							<select id="cafe_code" name="cafe_code">
								<option value="{$menuData.cafe_code}">{$menuData.cafe_name|default:" --- "}</option>
							</select>						
						</p>
					</div>
					<div class="article">
						<h4><a href="#"{if isset($errorArray.category_code)} class="error"{/if}>Category</a></h4>					
						<p class="short" id="categoryp">
							<select id="category_code" name="category_code">
								<option value="{$menuData.category_code}">{$menuData.category_name|default:" --- "}</option>
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
						<h4><a href="#"{if isset($errorArray.menu_description)} class="error"{/if}>Description</a></h4>					
						<p class="short">
							<textarea id="menu_description" name="menu_description" cols="60" rows="10">{$menuData.menu_description}</textarea>
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
			nicEditors.findEditor('menu_description').saveContent();	
			document.forms.detailsForm.submit();					 
		}		
		
		$( document ).ready(function() {
			
			new nicEditor({
				iconsPath	: '/library/javascript/nicedit/nicEditorIcons.gif',
				/* buttonList 	: ['bold','italic','underline','left','center', 'ol', 'ul', 'xhtml', 'fontFormat', 'fontFamily', 'fontSize', 'unlink', 'link', 'strikethrough', 'superscript', 'subscript'], */
				buttonList 	: [],
				maxHeight 	: '800'
			}).panelInstance('menu_description');				
							
			$('#continent_code').change(function() {
			
			var continent	= $('#continent_code :selected').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/menus/details.php",
					data: "{/literal}{if isset($menuData)}code={$menuData.menu_code}{/if}{literal}&country_code_search="+continent,
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
					url: "/admin/menus/details.php",
					data: "{/literal}{if isset($menuData)}code={$menuData.menu_code}{/if}{literal}&city_code_search="+country,
					dataType: "html",
					success: function(items){
						//show table
						$('#city_code').html(items);
					}
				});	
				
				return false;
				
			});
			
			$('#city_code').change(function() {
			
				var country	= $('#city_code :selected').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/menus/details.php",
					data: "{/literal}{if isset($menuData)}code={$menuData.menu_code}{/if}{literal}&cafe_code_search="+country,
					dataType: "html",
					success: function(items){
						//show table
						$('#cafe_code').html(items);
					}
				});	
				
				return false;
				
			});

			$('#cafe_code').change(function() {
			
				var cafe	= $('#cafe_code :selected').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/menus/details.php",
					data: "{/literal}{if isset($menuData)}code={$menuData.menu_code}{/if}{literal}&category_code_search="+cafe,
					dataType: "html",
					success: function(items){
						//show table
						$('#category_code').html(items);
					}
				});	
				
				return false;
				
			});				
		});			
		</script>
		{/literal}			
	</body>
</html>