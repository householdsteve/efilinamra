<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Continents</title>
		{include_php file='admin/includes/css.php'}
		{include_php file='admin/includes/javascript.php'}	
	</head>
	<body>
		<div id="wrapper">
			{include_php file='admin/includes/header.php'}
			{include_php file='admin/includes/menu.php'}
			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/continents/">Continents</a> &raquo; 
				<a href="#">{if isset($continentData)}Edit Continent{else}Add a Continent{/if}</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/continents/details.php{if isset($continentData)}?code={$continentData.continent_code}{/if}" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">Continent Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="continent_active" id="continent_active" value="1" {if $continentData.continent_active eq 1} checked="checked"{/if} />
						</p>
					</div>
					<div class="article">
						<h4><a href="#"{if isset($errorArray.continent_name)} class="error"{/if}>Name</a></h4>					
						<p class="short">
							<input type="text" name="continent_name" id="continent_name" value="{$continentData.continent_name}" size="40"/>
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
			document.forms.detailsForm.submit();					 
		}		
			
		</script>
		{/literal}			
	</body>
</html>