<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Cities</title>
		{include_php file='admin/includes/css.php'}
		{include_php file='admin/includes/javascript.php'}	
	</head>
	<body>
		<div id="wrapper">
			{include_php file='admin/includes/header.php'}
			{include_php file='admin/includes/menu.php'}
			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/cities/">Cities</a> &raquo; 
				<a href="#">{if isset($cityData)}Edit city{else}Add a city{/if}</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<form id="detailsForm" name="detailsForm" action="/admin/cities/details.php{if isset($cityData)}?code={$cityData.city_code}{/if}" method="post">
				<div class="col">						
					<div class="article">
						<h4><a href="#">City Active?</a></h4>
						<p class="short">
							<input type="checkbox" name="city_active" id="city_active" value="1" {if $cityData.city_active eq 1} checked="checked"{/if} />
						</p>
					</div>
					<div class="article">
						<h4><a href="#" {if isset($errorArray.continent_code)} class="error"{/if}>Continent</a></h4>					
						<p class="short">
							<select id="continent_code" name="continent_code">
								<option value=""> --- </option>
								{html_options options=$continentPairs selected=$cityData.continent_code}</td>
							</select>
						</p>
					</div>		
					<div class="article">
						<h4><a href="#" {if isset($errorArray.country_code)} class="error"{/if}>Country</a></h4>					
						<p class="short" id="countryp">
						<span class="success">{$cityData.country_name}</span>
						<input type="hidden" name="country_code" id="country_code" value="{$cityData.country_code}" />
						</p>
					</div>					
					<div class="article">
						<h4><a href="#" {if isset($errorArray.city_name)} class="error"{/if}>Name</a></h4>					
						<p class="short">
							<input type="text" name="city_name" id="city_name" value="{$cityData.city_name}" size="40"/>
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
		
		$( document ).ready(function() {
				
			$('#continent_code').change(function() {
			
			var continent	= $('#continent_code :selected').val();
			
				$.ajax({
					type: "GET",
					url: "/admin/cities/details.php",
					data: "{/literal}{if isset($cityData)}code={$cityData.city_code}{/if}{literal}&country_code_search="+continent,
					dataType: "html",
					success: function(items){
						//show table
						$('#countryp').html(items);
					}
				});	
			});
		});			
		</script>
		{/literal}			
	</body>
</html>