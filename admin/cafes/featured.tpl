<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		{include_php file='admin/includes/css.php'}
		{include_php file='admin/includes/javascript.php'}	
		<title>Cafe Featured</title>
	</head>
	<body>
		<div id="wrapper">
			{include_php file='admin/includes/header.php'}
			{include_php file='admin/includes/menu.php'}
			<p class="breadcrum">
				<a class="first" href="/admin/">Home</a> &raquo; 
				<a href="/admin/cafes/">Cafes</a> &raquo; 
				<a href="/admin/cafes/details.php?code={$cafeData.cafe_code}">{$cafeData.cafe_name}</a> &raquo; 
				<a href="#">Featured</a>
			</p>			
			<div id="main">
				<div class="clr"></div>
				<p class="linebreak"></p>
				<div class="clr"></div>
				<h3>{$cafeData.cafe_name} Featured</h3>
				<div id="tableContent" align="center">				
					<!-- Start Content Table -->
					<div class="content_table">
						<form name="detailsForm" id="detailsForm" action="/admin/cafes/images.php?code={$cafeData.cafe_code}" method="post">
						<table id="grid_table" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<th>Added</th>
							<th>Type</th>
							<th>Filename</th>
							<th>Image</th>
							<th>Description</th>
							<th></th>
						   </tr>
						  {foreach from=$cafeimageData item=item}
						  <tr>							  
							<td align="left" class="alt">
								{$item.cafeimage_added|date_format}
							</td>													
							<td align="left" class="alt">
								<input type="text" name="cafeimage_name_{$item.cafeimage_code}" id="cafeimage_name_{$item.cafeimage_code}" value="{$item.cafeimage_name}" />
							</td>
							<td align="left" class="alt">
								{if $item.cafeimage_type eq 'FTR'}Featured Image{/if}
								{if $item.cafeimage_type eq 'FTRX'}Featured Image full{/if}
								{if $item.cafeimage_type eq 'FTRL'}Featured Logo{/if}
							</td>							
							<td align="left" class="alt">
								<img src="{$item.cafeimage_path}/{$item.cafeimage_code}{$item.cafeimage_extension}" width="120" />
							</td>								
							<td align="left" class="alt">
								<textarea name="cafeimage_description_{$item.cafeimage_code}" id="cafeimage_description_{$item.cafeimage_code}" cols="30" rows="5">{$item.cafeimage_description}</textarea>
							</td>							
							<td align="left" class="alt">
								<a class="link link_{$item.cafeimage_code}" href="javascript:deleteForm('{$item.cafeimage_code}');">Delete</a>	
							</td>							
						  </tr>
						  {foreachelse}
							<tr>
								<td colspan="8">There are no current items in the system.</td>
							</tr>
						  {/foreach}  						  						  							  
						</table>
						</form>
					</div>
					</div>
					<h3>Add a featured image</h3><span class="selecteditem">Please only add jpg, png and gif's.</span>
					<div id="tableContent" align="center">		
					<div class="content_table">		
					<form name="additemForm" id="additemForm" action="/admin/cafes/featured.php?code={$cafeData.cafe_code}" method="post"  enctype="multipart/form-data">					
						<table id="grid_table" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<th {if isset($errorArray.imagefile)}class="error"{/if}>Upload</th>
							<th {if isset($errorArray.cafeimage_name)}class="error"{/if}>Name</th>
							<th {if isset($errorArray.cafeimage_type)}class="error"{/if}>Type</th>
							<th {if isset($errorArray.cafeimage_description)}class="error"{/if}>Description</th>
							<th></th>
						   </tr>						
						  <tr>		
							<td align="left" class="alt">
								<input type="file" id="imagefile" name="imagefile" />
							</td>
							<td align="left" class="alt">
								<input type="text" name="cafeimage_name" id="cafeimage_name" size="40" />
							</td>
							<td align="left" class="alt">
								<select id="cafeimage_type" name="cafeimage_type">
									<option value=""> --- </option>
									<option value="FTR"> Featured Image </option>
									<option value="FTRX"> Featured Image XL </option>
									<option value="FTRL"> Featured Logo </option>
								</select>	
							</td>																					
							<td align="left" class="alt">
								<textarea name="cafeimage_description" id="cafeimage_description" rows="5" cols="20"></textarea>
							</td>	
							<td colspan="2">
							<a class="link" href="javascript:addItemForm();">Add</a>	
							</td>						
						  </tr>	
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
				
				function addItemForm() {
					document.forms.additemForm.submit();					 
				}			
				
				function deleteForm(id) {	
					if(confirm('Are you sure you want to delete this file?')) {

							$.ajax({ 
									type: "GET",
									url: "images.php",
									data: "code={/literal}{$cafeData.cafe_code}{literal}&cafeimage_code_delete="+id,
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