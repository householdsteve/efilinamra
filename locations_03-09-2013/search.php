<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/database.php';

require_once 'class/cafe.php';
require_once 'class/city.php';

$cafeObject 	= new class_cafe();
$cityObject	= new class_city();

$city = isset($_REQUEST['city']) && isset($_REQUEST['city']) != '' ? trim($_REQUEST['city']) : '-1';

$currentCityData = $cityObject->getByLink($city);

if(!$currentCityData) {
	header('Location: /404/');
	exit;
}

$cafeData = $cafeObject->getByCityLink($city);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Armani Lifestyle | Locations Search | <?php echo $currentCityData['city_name']; ?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link href="/css/bootstrap.css" rel="stylesheet">
		<link href="/css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="/css/normalize.css">
		<link rel="stylesheet" href="/css/main.css">
		<script src="/js/vendor/modernizr-2.6.2.min.js" type="text/javascript"></script>

		<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type='text/css' />

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="/../assets/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="http://cdn2.yoox.biz/Os/armanigroup/common/armani.ico">
    </head>

    
    <body class="search">

		<div id="upnav" class="row-fluid visible-phone">
 <?php require_once 'includes/mobile-menu.php'; ?>
		</div>
	<div id="content-body" class="container-fluid">
      <div class="row-fluid">
        <div class="span3 hidden-phone">
       <div class="lifestyle">
       	<a href="/index.php"><img src="/img/armani-lifestyle_loho.png" alt="Armani Lifestyle"></a>
        </div>
			<?php require_once 'includes/location-menu.php'; ?>
        </div><!--/span-->
        <div class="span9 web-copy">

<div id="search-area">
<h2>Search for location</h2>
<div id="search-box"><input id="search" /> <!-- a id="my-location" href="/#">Find my location</a--> </div>
</div>

          
          <div class="row-fluid">
            <div id="search-body">

			<div class="search-group"> 
			<h3>Search Results</h3>
			<h4><?php echo $currentCityData['city_name']; ?></h4>
			
			
			<ul id="search-results">
			<?php 
				if($cafeData) {
				foreach($cafeData as $cafe) {
			?>
			  <li>
			  	<div class=" overlay-area">
			  	<a style="display: none;" href="/locations/<?php echo $cafe['city_link'].'/'.$cafe['cafe_link']; ?>">Discover</a>
			  	<div class="overlay-content">
			  		<img src="<?php if($cafe['cafe_image_logo'] == '') { echo '/img/default-logo.png'; } else { echo trim($cafe['cafe_image_logo']); } ?>" alt="Armani Cafe Location" /><br />
			  		<span class="city"><?php echo $cafe['cafe_name']; ?></span>
			  	</div>
			  	<span style="display: none;" class="img-overlay"></span>
			  	
			  	<img src="<?php if($cafe['cafe_image_search'] == '') { echo '/img/default-search.jpg'; } else { echo trim($cafe['cafe_image_search']); } ?>" />
			  	</div>
			  <span class="cafe-address">	
					<?php echo $cafe['cafe_address']; ?>
			  	</span>
			  	</li>
			  <?php 
					}
				} else {
				?>
			  <li>
					There are no cafes in this city.
			  	</li>				
				<?php 
				}
				?>
			</ul>
			</div>
            </div><!--/span-->
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->
		<!-- Boilerplate  -->
        <script src="///ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/jquery.bxslider.min.js"></script>
        <!-- Bootstrap -->
	    <script src="/js/bootstrap.min.js"></script>

        
        <script>
  		$(document).ready(function(){
			$('.accordion-toggle').click(function(){
			    $('.accordion-toggle.active').not(this).removeClass('active');
			    $(this).toggleClass('active');
			 })
			 
			 $('.left-nav-item.active').click(function(){
			 	$('.accordion-group').slideToggle();  
			 })
			 
			$('.slider').bxSlider({
			  pager: false,
			  minSlides: 2,
			  maxSlides: 2,
			  nextText: '',
			  prevText: '',
			  //slideWidth: 0,
			  slideMargin: 10
			}); 
			
		
	   		$('.overlay-area').mouseenter(function() {
		               $(this).find('.img-overlay').fadeIn('fast');
		               $(this).find('a').fadeIn('fast');
		    });
		    $(".overlay-area").mouseleave(function() {
		               $(this).find(".img-overlay").fadeOut('fast');
		               $(this).find('a').fadeOut('fast');
		   	});
		 
			$( "#search" ).autocomplete({
				source: "/feeds/locations.php",
				minLength: 2,
				select: function( event, ui ) {				
					if(ui.item.id == '') {
						/* Do nothing. */
					} else { 
						window.location.href = '/locations/'+ui.item.id;
					}
					
					$('#search').val('');										
				}
			});	
			
		
		});	
  		</script>  
        
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
