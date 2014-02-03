 <?php 
 
	require_once 'class/continent.php';
	require_once 'class/city.php';
	require_once 'class/cafe.php';
	
	$continentObject = new class_continent();
	$cityObject		 = new class_city();
	$cafeObject		 = new class_cafe();

	$continentmenuData = $continentObject->getFrontAll();
?>
<!-- </div -->
<div id="leftMenu" data-spy="affix" data-offset-top="0">
	
	
	
	
<?php if($continentmenuData) { ?>
<a href="/locations/" class="left-nav-item<?php if($isopen) echo(' active')?>">Locations</a>
<div class="accordion" id="accordion">
<?php 
$counter = 0;
foreach($continentmenuData as $item) { ?>
<div class="accordion-group">
    <div class="accordion-heading <?php if(!$isopen) echo(' hidden')?>">
    	
    	
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?php echo $counter; ?>" href="#collapse<?php echo $item['continent_link']; ?>">
          <span></span>  <?php echo $item['continent_name']; ?></a>
    </div>
    <div id="collapse<?php echo $item['continent_link']; ?>" class="accordion-body collapse" style="height: 0px;">
        <div class="accordion-inner">
            <div class="accordion" id="accordion<?php echo $counter; ?>">
			<?php 
				$citymenuData = $cityObject->getFrontByContinent($item['continent_code']);
				
				if($citymenuData) {
				
				foreach($citymenuData as $city)  {
			?>				
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?php echo $counter; ?>" href="#collapse<?php echo $city['city_code']; ?>">
						<span></span><?php echo $city['city_name']; ?></a>
				</div>
				<div id="collapse<?php echo $city['city_code']; ?>" class="accordion-body collapse" style="height: 0px;">
				<?php 
					$cafesideData = $cafeObject->getByCityLink($city['city_link']);
					
					if($cafesideData) {
										
				?>						
					<div class="accordion-inner">
							<ul>
							<?php foreach($cafesideData as $cafe)  { ?>
								<li><a  rel='<?php echo $item['continent_link']; ?>-<?php echo $city['city_code']; ?>'  href="/locations/<?php echo $city['city_link']; ?>/<?php echo $cafe['cafe_link']; ?>/"><?php echo $cafe['cafe_name']; ?></a></li>
							<?php } ?>
							</ul>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php 
					} 
				} 
			?>				
            </div>
        </div>
    </div>
</div>
<?php $counter++; } ?>
</div>
<?php } ?>
<a class="left-nav-item <?php if($is_features) echo(' active2')?>" href="/features.php">Features</a>
<a class="left-nav-item <?php if($is_story) echo(' active2')?>" href="/stories.php">Story</a>
<a class="left-nav-item  " style='background:#666666;margin-top:12px;'  href="/locations/reservation.php">RESERVE NOW</a>
</div>