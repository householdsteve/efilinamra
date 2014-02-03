<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/database.php';

require_once 'class/cafe.php';
require_once 'class/cafeimage.php';
require_once 'class/menu.php';

$cafeObject 			= new class_cafe();
$cafeimageObject	= new class_cafeimage();
$menuObject			= new class_menu();

$city = isset($_REQUEST['city']) && isset($_REQUEST['city']) != '' ? trim($_REQUEST['city']) : '-1';
$cafe = isset($_REQUEST['cafe']) && isset($_REQUEST['cafe']) != '' ? trim($_REQUEST['cafe']) : '-1';

$cafeData = $cafeObject->getByLinks($city, $cafe);

if(!$cafeData) {
	header('Location /');
	exit;
}

/* Get menu items. */
$categoryData = $menuObject->getCategoryCount($cafeData['cafe_code']);

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
    
<body class="details open-nav">
<div id="upnav" class="row-fluid visible-phone">
 <?php require_once 'includes/mobile-menu.php'; ?>
</div>
    <div id="content-body" class="container-fluid">
      <div class="row-fluid">
        <div class="span3 hidden-phone">
       <div class="lifestyle">
       	<a href="/"><img src="/img/armani-lifestyle_loho.png" alt="Armani Lifestyle"></a>
        </div>
			<?php require_once 'includes/location-menu.php'; ?>
        </div><!--/span-->
        
        
        
        
        
        		<!--phone -->
					<div  id="phone-cafe-body" class="row-fluid visible-phone" >
						<div class="cafe-content-wrap">
							<div class="content">
								   <img src="<?php echo $cafeData['cafe_image_logo']; ?>" alt="<?php echo $cafeData['cafe_name']; ?>" />
								 <span class="address"><?php echo $cafeData['cafe_address']; ?>
								<br />
								<?php echo $cafeData['cafe_telephone']; ?>
								</span>
								<div style="clear:right"></div>
								<div id='infos_c'>
									
										<?php echo $cafeData['cafe_openinghours']; ?>
										
								</div>

								<div style="clear:left"></div>
							</div>

						</div>
					</div>

					<!--phone -->

        
        <div class="span9 web-copy">
          <div class="row-fluid">
            <div id="cafe-body">
            	
            <div id="slider-wrap">
            <div class="cafe-content-wrap hidden-phone">
           	<div class="content">
            <img src="<?php echo $cafeData['cafe_image_logo']; ?>" alt="<?php echo $cafeData['cafe_name']; ?>" />
            <span class="address"><?php echo $cafeData['cafe_address']; ?>
								<br />
								<?php echo $cafeData['cafe_telephone']; ?>
								</span>
								
			<?php echo $cafeData['cafe_openinghours']; ?>
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
				<?php if($categoryData) { ?>
				<div id="menu">
					
					<div id='bgtab'></div>
					
				<h3>On the menu</h3>
					<div id="menu-content">
					  <div class="tabbable verticaltabs-container"> <!-- Wrap the Bootstrap Tabs/Pills in this container to position them vertically -->
						<ul class="nav nav-tabs">
							<?php 
							
								$i = 0;
								$active = '';
								foreach($categoryData as $category)  {
								
									if($i == 0) { $active = 'class="active"'; } else {$active = ''; }
								?>
									<li <?php echo $active; ?>><a href="#<?php echo $category['category_code']; ?>" data-toggle="tab"><?php echo $category['category_name']; ?></a></li>								
								<?php 
									$i++;
								} 
								?>
						</ul>
						<div class="tab-content">
							
							
							
						<?php 
						$i = 0; 
						$active = '';
						foreach($categoryData as $category)  { 
							if($i == 0) { $active = 'active'; } else {$active = ''; }
						?>
						<div class="tab-pane fade in <?php echo $active; ?>" id="<?php echo $category['category_code']; ?>">
						<h3><?php echo $category['category_name']; ?></a></h3>
						
								<?php 
									$menuDataItems = $menuObject->getByCategoryCode($category['category_code']);
									if($menuDataItems) {
									
									$total = count($menuDataItems);
									if($total > 4) {
										$half = $total / 2;
										$half = (int)$half;
										$i = 0;
									} else {
										$half = 4;
									}
									
								?>						
							<ul>
								<?php 
									foreach($menuDataItems as $menuItem) {
										if($i%$half == 0 && $i>0) echo '</ul><ul>';
										?>
										<li><div class='title_m'><?php echo $menuItem['menu_name']; ?> </div> <?php echo $menuItem['menu_description']; ?></li>
										<?php
									$i++;	
									}
								?>
							</ul>
							<?php } ?>
						
						</div>
						<?php 
						$i++;
						} 
						?>
						</div>
					  </div>
					</div>
				</div>
				<?php } ?>


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
			 $('#leftMenu .accordion-group .accordion-group').click(function(){
			    $('#leftMenu .accordion-group .accordion-group .accordion-heading ').not((this)).removeClass('active');
			    $(this).toggleClass('active');
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

				
			
			   var sel_current=$('a[href="'+ window.location.pathname+'"]');
			   
			  
			   if(sel_current.length==0)  {
			   	
			    sel_current=$('a[href="'+ window.location.pathname+'/"]'); 	
			   }  
			   var rel=sel_current.attr('rel').split('-');
			   $('a[href="#collapse'+ rel[0]+'"], a[href="#collapse'+ rel[1]+'"]').trigger('click');
     		
		
		
		});
  		</script>  
        
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        
        <style>
        
   
        	
        	
        	@media (min-width: 768px) and (max-width: 979px) {
        		
        		     	#cafe-body .cafe-content-wrap table{
        		
        		margin: 0 0 0 0
        		
        	}
        	}
        	
        	
        @media (min-width: 980px) and (max-width: 1120px) {
        	#cafe-body .content {
        		
        		margin-top:30px;
        	
        	}
        
        	
        
        	
        	
        }
        
        

           
        	
        	#menu-content   .tab-content ul{ width:40% ; margin:0 5% 0 0 ;float :left ; padding:0 0 0 25px }
        	
        		#menu-content   .tab-content ul li{  list-style-type:none  ;color:#FFFFFF;font-size:80%;margin:0 0 30px 0;font-weight:100 ;padding:0 40px 0 0;}
        		
        		#menu-content   .tab-content ul li div.title_m {font-size:90%; }
        		#menu-content   .tab-content h3 {font-weight:normal ; }
        		
        	
        		
        		
        		
        		   .verticaltabs-container > .nav-tabs{
         		
         		float:left;
         			width:25%;
         			position:relative;
         			padding:0!important
         	}
         	
         	
         	.verticaltabs-container > .tab-content{
         		
         			float:left;
         			width:75%;
         			
         			overflow:visible;
         		
         			position:relative;
         			margin-top:1px;
         	}
         	
        		
        		
        		
        		
        		#cafe-body .content{right:0!important}
        		
        		.verticaltabs-container {  min-width:100px!important; min-height:auto; ;height:auto  ;}
        		
        		
        		
        		
        		
        		
        		
        		
        		
        	    @media (max-width: 920px) {	
        			#menu-content   .tab-content ul{width:100%; margin:0 5% 0 0 ;float :none ; }
        		
        		}
        		
        		
        		
         @media (max-width: 480px) {
         	

        	
        	 #menu-content   .tab-content ul{width:100%; margin:0 5% 0 0 ;float :none ; }
        	
        		#menu-content   .tab-content ul li{  width:80%;  list-style-type:none  ;color:#FFFFFF;line-height:14px;font-size:85% ;padding:0}
        	
        	
        }     
             
             
             #menu{
             	
             	position:relative;
             }
             #bgtab{ 
             	position:absolute;
             	background:#1f1f1f;
             	left:25%;
             	right: 0;
             	top:130px;
             	bottom:0;
             	}
        		
        		
        		
        </style>
        
    </body>
</html>
