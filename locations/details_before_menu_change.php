<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/database.php';

require_once 'class/cafe.php';
require_once 'class/cafeimage.php';

$cafeObject 			= new class_cafe();
$cafeimageObject	= new class_cafeimage();

$city = isset($_REQUEST['city']) && isset($_REQUEST['city']) != '' ? trim($_REQUEST['city']) : '-1';
$cafe = isset($_REQUEST['cafe']) && isset($_REQUEST['cafe']) != '' ? trim($_REQUEST['cafe']) : '-1';

$cafeData = $cafeObject->getByLinks($city, $cafe);

if(!$cafeData) {
	header('Location /');
	exit;
}

/* Get gallery images. */
$cafegallery = $cafeimageObject->getGalleryByCafe($cafeData['cafe_code']);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Armani Lifestyle | Locations | <?php echo $cafeData['city_name']; ?> | <?php echo $cafeData['cafe_name']; ?></title>
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
    
<body class="locations">
<div id="upnav" class="row-fluid visible-phone">
			&nbsp;
</div>
    <div id="content-body" class="container-fluid">
      <div class="row-fluid">
        <div class="span3 hidden-phone">
       <div class="lifestyle">
       	<a href="index.php"><img src="/img/armani-lifestyle_loho.png" alt="Armani Lifestyle"></a>
        </div>
			<?php require_once 'includes/location-menu.php'; ?>
        </div><!--/span-->
        <div class="span9 web-copy">
          <div class="row-fluid">
            <div id="cafe-body">
            	
            <div id="slider-wrap">
            <div class="cafe-content-wrap">
           	<div class="content">
            <img src="<?php echo $cafeData['cafe_image_logo']; ?>" alt="<?php echo $cafeData['cafe_name']; ?>- Cafe" />
            <span class="address"><?php echo $cafeData['cafe_address']; ?>
								<br />
								<?php echo $cafeData['cafe_telephone']; ?>
								</span>
								
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr class="table-head">
				    <td colspan="2">Hours</td>
				  </tr>
				  <tr>
				    <td><?php echo $cafeData['cafe_openingweekdays']; ?></td>
				    <td><?php echo $cafeData['cafe_openingweekhours']; ?></td>
				  </tr>
				  <tr>
				    <td><?php echo $cafeData['cafe_openingweekenddays']; ?></td>
				    <td><?php echo $cafeData['cafe_openingweekendhours']; ?></td>
				  </tr>
				</table>
			</div>
			<div class="cafe-overlay"></div>
								
			</div>
			<ul class="cafe-slider">
				<?php 
					if($cafegallery) { 
						foreach($cafegallery as $image) {
				?>				
				<li><img src="<?php echo $image['cafeimage_path'].'/'.$image['cafeimage_code'].$image['cafeimage_extension']; ?>" /></li>
				<?php 
						}
					} else { 
				?>
			   <li><img src="/img/cafe-img.jpg" /></li>
			   <?php } ?>			  
			</ul>
			</div>
				<div id="map">
					
					<div id="map-canvas"></div>
					<a id="expand-map" href="#"></a>
					
					
				</div>
				<div id="menu">
				<h3>On the menu</h3>
<div id="menu-content">
  <div class="tabbable verticaltabs-container"> <!-- Wrap the Bootstrap Tabs/Pills in this container to position them vertically -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Appetizers</a></li>
      <li><a href="#profile" data-toggle="tab">Soups</a></li>
      <li><a href="#messages" data-toggle="tab">First Courses</a></li>
      <li><a href="#settings" data-toggle="tab">Main Courses</a></li>
      <li><a href="#contact" data-toggle="tab">Desert</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="home">
        <h3>Appetizers</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed urna diam, ac gravida tellus. Mauris eu augue non arcu hendrerit consequat. Donec pharetra lacus ac ipsum tincidunt vestibulum. Aliquam erat volutpat. Phasellus tristique lectus nec massa scelerisque semper et id purus. Aenean mollis iaculis lacus, id tincidunt dolor malesuada a. Proin eget magna lorem. Nullam vel rhoncus sapien. Donec tincidunt nulla eget velit egestas auctor. Sed vitae aliquet nulla. Donec nec eros justo, semper mattis metus. Sed suscipit adipiscing lacus id pulvinar. Cras in dui turpis, at cursus lacus. Suspendisse volutpat dapibus nibh ac sollicitudin.</p>
      </div>
      <div class="tab-pane fade" id="profile">
        <h3>Soups</h3>
        <p>Nunc feugiat risus vel diam hendrerit mattis ultrices urna bibendum. Ut ac est sit amet elit posuere lacinia. Ut a dui ligula. Maecenas quis sapien sit amet est porta elementum id vel nibh. Sed venenatis magna quis nisi fermentum aliquet. Morbi ultricies, urna eget semper feugiat, justo eros facilisis dolor, quis pulvinar purus nibh quis nunc. Duis eget ligula a nisl pellentesque laoreet. Suspendisse eu rhoncus erat. Quisque pharetra facilisis dignissim.</p>
      </div>
      <div class="tab-pane fade" id="messages">
        <h3>First Courses</h3>
        <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur vestibulum convallis ante, non iaculis nisl mattis sed. Duis auctor justo a lectus posuere ultrices. Phasellus sagittis convallis diam, sit amet lobortis est varius ac. Phasellus erat lorem, ornare non dignissim dictum, sodales et quam. Proin est velit, venenatis eget fermentum a, condimentum nec arcu. Praesent condimentum, elit ac sagittis porta, dolor neque posuere quam, vitae posuere est purus nec dui. Fusce ut arcu mauris, vitae congue mi. Sed nec tincidunt ligula. Donec ut lectus vitae justo tempus congue. Sed vitae ipsum eu ante ultricies aliquam eu ut lacus. Aenean fringilla, mauris tincidunt consectetur posuere, nisi quam lacinia erat, eget elementum libero lorem eget elit. Nunc non massa vel metus eleifend tincidunt. Donec ac libero non arcu rutrum ullamcorper eu vel felis. Quisque dignissim metus in dui sollicitudin vel placerat ligula dictum.</p>
      </div>
      <div class="tab-pane fade" id="settings">
        <h3>Main Courses</h3>
        <p>Aenean dignissim lectus in magna fringilla euismod. Nullam erat sapien, lobortis nec pellentesque eu, molestie et risus. Pellentesque non sem magna. Morbi tristique, purus eu dignissim interdum, leo ante dignissim mauris, vitae aliquam tellus purus pellentesque enim. Aenean molestie fermentum ipsum, scelerisque egestas ante cursus et. Morbi lacus risus, malesuada in fermentum nec, mattis ullamcorper libero. Quisque magna velit, aliquet eu luctus nec, malesuada eget mauris. Nunc et congue eros. Morbi convallis, nulla at gravida suscipit, odio elit tincidunt urna, at pretium sapien lorem quis dolor. Praesent libero est, vestibulum vel ultricies ut, vestibulum non metus. Cras accumsan, metus quis ornare condimentum, dui sem elementum nulla, quis sollicitudin leo ipsum eu magna. Etiam auctor ultrices risus, vitae condimentum lectus feugiat a. Proin lacus sapien, lobortis id dapibus vitae, accumsan quis ipsum. Mauris quis lectus ut neque iaculis vestibulum ac in turpis. Proin pellentesque justo vel felis dignissim non iaculis dolor bibendum. Fusce vitae leo a urna imperdiet aliquam.</p>
      </div>
      <div class="tab-pane fade" id="contact">
        <h3>Deserts</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed urna diam, ac gravida tellus. Mauris eu augue non arcu hendrerit consequat. Donec pharetra lacus ac ipsum tincidunt vestibulum. Aliquam erat volutpat. Phasellus tristique lectus nec massa scelerisque semper et id purus. Aenean mollis iaculis lacus, id tincidunt dolor malesuada a. Proin eget magna lorem. Nullam vel rhoncus sapien. Donec tincidunt nulla eget velit egestas auctor. Sed vitae aliquet nulla. Donec nec eros justo, semper mattis metus. Sed suscipit adipiscing lacus id pulvinar. Cras in dui turpis, at cursus lacus. Suspendisse volutpat dapibus nibh ac sollicitudin.</p>
       
        
      </div>
    </div>
  </div>
</div>
					
				</div>


            </div><!--/div-->

          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->
		<input type="hidden" name="longitude" id="longitude" value="<?php echo $cafeData['cafe_longitude']; ?>" />
		<input type="hidden" name="latitude" id="latitude" value="<?php echo $cafeData['cafe_latitude']; ?>" />
    </div><!--/.fluid-container-->
       





		<!-- Boilerplate  -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="//js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        
        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/maps.js"></script>
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
		 
		$('.cafe-slider').bxSlider({
		 auto: true,
		 controls: false,
		 slideMargin: 10
		}); 
		

				function toggleMap(e) {
					e.preventDefault();
					$(e.currentTarget).toggleClass('active');
					var origHeight = $('#map-canvas').data('origHeight');

					if (origHeight) {
						$('#map-canvas').removeData('origHeight');
						$('#map-canvas').animate({
							height : origHeight
						});
					} else {
						origHeight = $('#map-canvas').height();
						$('#map-canvas').data('origHeight', origHeight);
						$('#map-canvas').animate({
							height : origHeight * 1.5
						});
					}

				};

				$('#expand-map').click(toggleMap);

				$('#expand-map').click(function() {

				})
			
			//function toggleMap(e) {
     		
		
		
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
