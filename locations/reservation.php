<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/database.php';

require_once 'class/cafe.php';

$cafeObject 	= new class_cafe();


$cafeData = $cafeObject->getByReservation($search);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Armani/Ristorante | Reservation </title>
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
		
		 <?php require_once 'includes/header_html.php'; ?>
      <div class="row-fluid">
        <div class="span3 hidden-phone">
       <div class="lifestyle"  data-spy="affix" data-offset-top="0">
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
			<h3>Reservation</h3>
		
			
			
			<ul id="search-results">
			<?php 

			if($cafeData) {
				foreach($cafeData as $cafe) {
			?>
			  <li>
			  	<div class=" overlay-area">
			 
			  	<div class="overlay-content">
			  		
			  		 	<a  class= 'hidden-read-more' style="display: none;" href="<?php echo $cafe['cafe_bookinglink'] ?>">Reserve a table</a>
			  		<img src="<?php if($cafe['cafe_image_logo'] == '') { echo '/img/default-logo.png'; } else { echo trim($cafe['cafe_image_logo']); } ?>" alt="Armani Cafe Location" /><br />
			  		<span class="city"><?php echo   str_replace ('_',' ', strtoupper($cafe['city_link']) ); ?></span>
			  	</div>
			  	<span style="display: none;" class="img-overlay"></span>
			  	
			  	<img src="<?php if($cafe['cafe_image_search'] == '') { echo '/img/default-search.jpg'; } else { echo trim($cafe['cafe_image_search']); } ?>" />
			  	</div>
			  <span class="cafe-address" >
			  	    <?php echo  ($cafe['cafe_name']); ?>	
					<?php echo ($cafe['cafe_address']); ?>
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
      
      			<div class="row-fluid footer-wrap">
	<?php require_once 'includes/footer-menu.php'; ?>
		</div>

    </div><!--/.fluid-container-->
		<!-- Boilerplate  -->
		
		
		<style>
		
		
		html.touch  #search-results li 	.hidden-read-more{
			
			display:block;
	
			
		}
		
		
		html.touch  #search-results li 	.img-overlay{
			
			background:none;
	
			
		}
		
		
	
		
		
			
			.cafe-address{
				
				text-transform:uppercase;
			}
			.cafe-address p{
				
				margin:0;
			}
			
			
			@media (max-width: 900px){
				.cafe-address
				{
					
					
					font-size: 80%;
					line-height:14px;
				}
			}
			
			
			@media (max-width: 570px){
				
				#search-results {
					
					display:block
				}
				
				#search-results li 
				{
					float:none;
					display:block;
					width: 100% !important;
				
					
				}
				
				
				.cafe-address
				{
					
					
						font-size: 100%;
					line-height:20px;
				}
				
				
				
				
			}
			
			
		</style>
		
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/jquery.bxslider.min.js"></script>
        <!-- Bootstrap -->
	    <script src="/js/bootstrap.min.js"></script>

        
        <script>
  		$(document).ready(function(){

			
		
	   		$('.overlay-area').mouseenter(function() {
		               $(this).find('.img-overlay').fadeIn('fast');
		               $(this).find('a').fadeIn('fast');
		                $(this).css('cursor','pointer');
		    });
		    $(".overlay-area").mouseleave(function() {
		               $(this).find(".img-overlay").fadeOut('fast');
		               $(this).find('a').fadeOut('fast');
		   	});
		   	
		   	 $(".overlay-area").click(function() {
		               
		             	window.location.href =  $(this).find('a').attr('href');
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
 		<script type="text/javascript"> 

		  var _gaq = _gaq || []; 
		  _gaq.push(['_setAccount', 'UA-44248958-1']); 
		  _gaq.push(['_trackPageview']); 
		
		  (function() { 
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; 
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; 
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); 
		  })(); 


				
				
		</script>
    </body>
</html>
