 <?php 
 
	require_once 'class/continent.php';
	require_once 'class/city.php';
	
	$continentObject = new class_continent();
	$cityObject		 = new class_city();

	$continentData = $continentObject->getFrontAll();
	
?>
<div class="accordion" id="leftMenu">
	<?php if($continentData) { ?>
    <a href="/locations/" class="left-nav-item active" data-parent="#leftMenu">Locations</a>
	<?php foreach($continentData as $item) { ?>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="/#collapse<?php echo $item['continent_link']; ?>"><?php echo $item['continent_name']; ?><span></span></a>
		</div>
		<?php 
			$cityData = $cityObject->getFrontByContinent($item['continent_code']);
			
			if($cityData) {				
		?>
		<div id="collapse<?php echo $item['continent_link']; ?>" class="accordion-body collapse" style="height: 0px; ">
			<div class="accordion-inner">
				<ul>
					<?php foreach($cityData as $city)  { ?>
					<li><a href="/locations/<?php echo $city['city_link']; ?>/"><?php echo $city['city_name']; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php 
		}
	?>
	<a data-parent="#leftMenu" href="/features.html">Features</a>
	<a data-parent="#leftMenu" href="/stories.html">Story</a>
</div><!-- End Left Nav -->