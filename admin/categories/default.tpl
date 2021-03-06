<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		{include_php file='admin/includes/css.php'}
		{include_php file='admin/includes/javascript.php'}	
		<script type="text/javascript" language="javascript" src="default.js"></script>
		<title>Categories</title>
	</head>
	<body>
		<div id="wrapper">
			{include_php file='admin/includes/header.php'}
			{include_php file='admin/includes/menu.php'}
			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/categories/">Categories</a>
			</p>
			<p class="linebreak"></p>
			<div id="main">
				<a class="link" href="/admin/categories/details.php">Add new category</a>
				<div id="tableContent" align="center">
					<!-- Start Content Table -->
					<div class="content_table">
						<form name="htmlForm" id="htmlForm" action="/admin/bookings/" method="post">
							<table border="0" cellspacing="0" cellpadding="0" id="dataTable">							
								<thead>
								<tr>
									<th>Added</th>
									<th>Code</th>
									<th>Name</th>
									<th>Active</th>
									<th></th>
								</tr>
								</thead>							
							   <tbody>
							  {foreach from=$categoryData item=item}
							  <tr>
								<td>{$item.category_added|date_format}</td>
								<td align="left"><a href="/admin/categories/details.php?code={$item.category_code}">{$item.category_code}</a></td>	
								<td align="left">{$item.category_name}</td>	
								<td align="left">{if $item.category_active eq '1'}<span class="success">Active</span>{else}<span class="error">Not Active</span>{/if}</td>
								<td align="left"><a class="link" href="javascript:deleteItem('{$item.category_code}', '{$item.category_name}')">Delete</a></td>	
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
			if(confirm('Are you sure you want to delete '+item+'. Please note, you will not be able to see foods that below to this category. Do you still want to continue?')) {
				$.ajax({ 
						type: "GET",
						url: "default.php",
						data: "code_delete="+code,
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