 <?php

require_once 'class/continent.php';
require_once 'class/city.php';
require_once 'class/cafe.php';

$continentObject = new class_continent();
$cityObject = new class_city();
$cafeObject = new class_cafe();

$continentmenuData = $continentObject -> getFrontAll();
?>
<!-- </div -->

<div id="mobile-nav-bar" class="navbar navbar-inverse navbar-fixed-top">
<div id="icon-wrap">
<!-- div><a id="open-mobile-nav"><img src="/img/mobile-open-icon.jpg" /></a></div> <div class="logo"><a href="/"><img src="/img/armani-logo-mobile-bar.jpg" /></a></div> 
<!--div><a href="/"><img src="/img/mobile-search-icon.jpg" /></a></div> <div><a href="/"><img src="/img/mobile-user-icon.jpg" /></a></div>
<div><a href="/"><img src="/img/mobile-shop-icon.jpg" /></a></div -->


  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
  </button>
          <a href="/"><img id='logo-mobile' src="/img/armani-logo-mobile-bar.jpg" /></a>
</div>
<div id="mobileMenu" class="nav-collapse collapse">
<?php if($continentmenuData) { ?>
<a href="/locations/" class="left-nav-item locations">Locations</a>
<div class="accordion" id="mobile-accordion" style="display: none;">
<?php 
$counter = 0;
foreach($continentmenuData as $item) { ?>
<div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#mobile-accordion<?php echo $counter; ?>" href="#mobile-collapse<?php echo $item['continent_link']; ?>">
            <?php echo $item['continent_name']; ?></a>
    </div>
    <div id="mobile-collapse<?php echo $item['continent_link']; ?>" class="accordion-body collapse" style="height: 0px;">
        <div class="accordion-inner">
            <div class="accordion" id="mobile-accordion<?php echo $counter; ?>">
			<?php 
				$citymenuData = $cityObject->getFrontByContinent($item['continent_code']);
				
				if($citymenuData) {
				
				foreach($citymenuData as $city)  {
			?>				
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#mobile-accordion<?php echo $counter; ?>" href="#mobile-collapse<?php echo $city['city_code']; ?>">
						<?php echo $city['city_name']; ?><span></span></a>
				</div>
				<div id="mobile-collapse<?php echo $city['city_code']; ?>" class="accordion-body collapse" style="height: 0px;">
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
<?php $counter++;
	}
 ?>
</div>
<?php } ?>
<a class="left-nav-item" href="/features.php">Features</a>
<a class="left-nav-item" href="/stories.php">Story</a>
<a class="left-nav-item  " style='background:#666666;margin-top:12px;'  href="/locations/reservation.php">RESERVE NOW</a>
</div>

<div style="clear: both;"></div>
</div>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script>
	$(document).ready(function(){
			if ($('body').hasClass('open-nav')) {
				//$("#mobileMenu").css("height","auto");
				$('a.locations').attr('href','#' );
				$('a.locations').click(function() {
					$('#mobile-accordion').slideToggle();
				});
			};
		

		// $('.left-nav-item').click(function() {
			// $('.left-nav-item.active').not(this).removeClass('active');
			// $(this).toggleClass('active');
		// });
	});

</script>