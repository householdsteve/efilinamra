<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Categories</title>
		{include_php file='admin/includes/css.php'}
		{include_php file='admin/includes/javascript.php'}	
	</head>
	<body>
		<div id="wrapper">
			{include_php file='admin/includes/header.php'}
			{include_php file='admin/includes/menu.php'}
			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/categories/">Categories</a> &raquo; 
				<a href="#">{if isset($categoryData)}Edit Category{else}Add a category{/if}</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/categories/details.php{if isset($categoryData)}?code={$categoryData.category_code}{/if}" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">Category Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="category_active" id="category_active" value="1" {if $categoryData.category_active eq 1} checked="checked"{/if} />
						</p>
					</div>
					<div class="article">
						<h4><a href="#"{if isset($errorArray.category_name)} class="error"{/if}>Name</a></h4>					
						<p class="short">
							<input type="text" name="category_name" id="category_name" value="{$categoryData.category_name}" size="40"/>
						</p>
					</div>
					<div class="article">
						<h4><a href="#"{if isset($errorArray.category_description)} class="error"{/if}>Description</a></h4>					
						<p class="short">
							<textarea id="category_description" name="category_description" cols="60" rows="5">{$categoryData.category_description}</textarea>
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
			{include_php file='admin/includes/footer.php'}
		</div>
		{literal}	
		<script type="text/javascript">
		function submitForm() {
			nicEditors.findEditor('category_description').saveContent();	
			document.forms.detailsForm.submit();					 
		}		
		
		$( document ).ready(function() {
		
			new nicEditor({
				iconsPath	: '/library/javascript/nicedit/nicEditorIcons.gif',
				/* buttonList 	: ['bold','italic','underline','left','center', 'ol', 'ul', 'xhtml', 'fontFormat', 'fontFamily', 'fontSize', 'unlink', 'link', 'strikethrough', 'superscript', 'subscript'], */
				buttonList 	: [],
				maxHeight 	: '800'
			}).panelInstance('category_description');		
							
			$('#continent_code').change(function() {
			
			var continent	= $('#continent_code :selected').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/categories/details.php",
					data: "{/literal}{if isset($categoryData)}code={$categoryData.category_code}{/if}{literal}&country_code_search="+continent,
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
					url: "/admin/categories/details.php",
					data: "{/literal}{if isset($categoryData)}code={$categoryData.category_code}{/if}{literal}&city_code_search="+country,
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
					url: "/admin/categories/details.php",
					data: "{/literal}{if isset($categoryData)}code={$categoryData.cafe_code}{/if}{literal}&cafe_code_search="+country,
					dataType: "html",
					success: function(items){
						//show table
						$('#cafe_code').html(items);
					}
				});	
				
				return false;
				
			});			
		});			
		</script>
		{/literal}			
	</body>
</html>