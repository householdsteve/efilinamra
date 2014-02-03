<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		{include_php file='admin/includes/css.php'}
		{include_php file='admin/includes/javascript.php'}	
		<script type="text/javascript" language="javascript" src="default.js"></script>
		<title>Menus</title>
	</head>
	<body>
		<div id="wrapper">
			{include_php file='admin/includes/header.php'}
			{include_php file='admin/includes/menu.php'}
			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/cafes/">cafes</a> &raquo; 
				<a href="/admin/cafes/details.php?code={$cafeData.cafe_code}">{$cafeData.cafe_name}</a> &raquo; 
				<a href="/admin/cafes/menus/?code={$cafeData.cafe_code}">Menu</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<a class="link" href="/admin/cafes/menus/details.php?cafe={$cafeData.cafe_code}">Add new menu</a>
				<div id="tableContent" align="center">
					<!-- Start Content Table -->
					<div class="content_table">
						<form name="htmlForm" id="htmlForm" action="/admin/bookings/" method="post">
							<table border="0" cellspacing="0" cellpadding="0" id="dataTable">							
								<thead>
								<tr>
									<th>Added</th>
									<th>Name</th>
									<th>Description</th>									
									<th>Category</th>
									<th>Active</th>
									<th></th>
								</tr>
								</thead>							
							   <tbody>
							  {foreach from=$menuData item=item}
							  <tr>
								<td>{$item.menu_added|date_format}</td>
								<td align="left"><a href="/admin/cafes/menus/details.php?cafe={$item.cafe_code}&code={$item.menu_code}">{$item.menu_name}</a></td>										
								<td align="left">{$item.menu_description}</td>	
								<td align="left">{$item.category_name}</td>
								<td align="left">{if $item.menu_active eq '1'}<span class="success">Active</span>{else}<span class="error">Not Active</span>{/if}</td>
								<td align="left"><a class="link" href="javascript:deleteItem('{$item.menu_code}', '{$item.menu_name}')">Delete</a></td>
							  </tr>
							  {/foreach}     
							  </tbody>
							</table>
						 </form>
					 </div>
					 <!-- End Content Table -->
					<div class="clear"></div>				
				
				</div>
			</div>							
			<div class="clr"></div>
			{include_php file='admin/includes/footer.php'}
		{literal}	
		<script type="text/javascript">
		function deleteItem(code, item) {
			if(confirm('Are you sure you want to delete '+item)) {
				$.ajax({ 
						type: "GET",
						url: "default.php",
						data: "code={/literal}{$cafeData.cafe_code}{literal}&code_delete="+code,
						dataType: "json",
						success: function(data){
								if(data.result == 1) {
									alert('Deleted');
									window.location.href = window.location.href;
								} else {
									alert(data.error);
								}
						}
				});				
			}			
		}	
		</script>
		{/literal}				
			</div>
	</body>
</html>