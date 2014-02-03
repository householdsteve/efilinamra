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
				<a href="/admin/cafes/">cafes</a> &raquo; 
				<a href="/admin/cafes/details.php?code={$cafeData.cafe_code}">{$cafeData.cafe_name}</a> &raquo; 
				<a href="/admin/cafes/menus/?code={$cafeData.cafe_code}">Menu</a> &raquo; 
				<a href="#">{if isset($menuData)}{$menuData.menu_name}{else}New Menu{/if}</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/cafes/menus/details.php?cafe={$cafeData.cafe_code}{if isset($menuData)}&code={$menuData.menu_code}{/if}" method="post">
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
						<h4><a href="#"{if isset($errorArray.category_code)} class="error"{/if}>Category</a></h4>					
						<p class="short">
							<select id="category_code" name="category_code">
								<option value=""> --- </option>
								{html_options options=$categoryData selected=$menuData.category_code}</td>
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
		});			
		</script>
		{/literal}			
	</body>
</html>