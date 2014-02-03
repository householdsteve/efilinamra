<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Countries</title>
		{include_php file='admin/includes/css.php'}
		{include_php file='admin/includes/javascript.php'}	
	</head>
	<body>
		<div id="wrapper">
			{include_php file='admin/includes/header.php'}
			{include_php file='admin/includes/menu.php'}
			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/countries/">Countries</a> &raquo; 
				<a href="#">{if isset($countryData)}Edit country{else}Add a country{/if}</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/countries/details.php{if isset($countryData)}?code={$countryData.country_code}{/if}" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">Country Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="country_active" id="country_active" value="1" {if $countryData.country_active eq 1} checked="checked"{/if} />
						</p>
					</div>
					<div class="article">
						<h4><a href="#" {if isset($errorArray.country_name)} class="error"{/if}>Continent</a></h4>					
						<p class="short">
							<select id="continent_code" name="continent_code">
								<option value=""> --- </option>
								{html_options options=$continentPairs selected=$countryData.continent_code}</td>
							</select>
						</p>
					</div>												
					<div class="article">
						<h4><a href="#" {if isset($errorArray.country_name)} class="error"{/if}>Name</a></h4>					
						<p class="short">
							<input type="text" name="country_name" id="country_name" value="{$countryData.country_name}" size="40"/>
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