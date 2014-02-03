<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/database.php';

require_once 'class/cafe.php';
require_once 'class/cafeimage.php';
require_once 'class/menu.php';

$cafeObject 			= new class_cafe();
$cafeimageObject	= new class_cafeimage();
$menuObject			= new class_menu();



$featured=$cafeObject->getRnd();

$featured=$featured[0];

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
	<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Armani Lifestyle | Home</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link href="css/ui-darkness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/vendor/modernizr-2.6.2.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="/js/vendor/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="http://cdn2.yoox.biz/Os/armanigroup/common/armani.ico">

	</head>
	<body class="home">

		<div id="upnav" class="row-fluid visible-phone">
			 <?php require_once 'includes/mobile-menu.php'; ?>
			 <div class="clear-fix"></div>
		</div>

		<div id="content-body" class="container-fluid">
			 <?php require_once 'includes/header_html.php'; ?>
			 
			<div class="row-fluid">
				<div class="span3 hidden-phone"  >
					<div class="lifestyle" data-spy="affix" data-offset-top="0">
						<a href="index.php"><img src="img/armani-lifestyle_loho.png" alt="Armani Lifestyle"></a>
					</div>

			<?php require_once 'includes/location-menu.php'; ?>
			<?php require_once 'mobile-detect-master/Mobile_Detect.php';
			
			$detect= new Mobile_Detect;

			$device = ($detect->isMobile()) ? 'mobile_' : '';
			?>

				</div><!--/span-->
				<div class="span9 web-copy">
					<div class="hero-unit">

						<div id="homeSlider">

							<!-- add span message out of LI   -->
							<span class="message"><img src="img/welcome-logo.png" /> <a id='res_now' class='blk'  style='display: none'  href="/locations/reservation.php">RESERVE NOW</a></span>
							
						
							      
									<span class="img-overlay"></span>
							
							

							<ul class="slider">
								<li><img src="img/<?php echo($device) ?>home-1.jpg" />

								</li>
								<li><img src="img/<?php echo($device) ?>home-2.jpg" />

									
								</li>
								<li><img src="img/<?php echo($device) ?>home-3.jpg" />

									
								</li>
							</ul>
						</div>
						<!-- End Carousel -->

					</div>

					<!-- add new row visible only by phone  -->
					<div class="row-fluid visible-phone">

						<div id="near-by-phone" class="span12">
							<div class="content">

								<div class='lf'>

								<span>FEATURED LOCATION</span>

									<img src="/media/cafe/6K6FZMAY/logo_6K6FZMAY.png" alt="Emporio Armani - Cafe" />
									
								<a href="mailto:eacafe_aoyama@giorgioarmani.co.jp">RESERVE A TABLE</a> 
								</div>

								<div  class='rg'>
<span class="city">Ayoama</span>

									<span class="address">Tokyo
									<br />
									3-6-1 KITA-AOYAMA, MINATO-KU

									<br />
									Japan
									<br />
									<br />
									
                                    +81-03-5778-1637
								
									</span>
								</div>

								<div class="clearfix">
									&nbsp;
								</div>

							</div>

							<img class='clearfix' style='clear:both' src="img/aoyama_1.jpg">
						</div><!--/span-->

					</div><!--/row-->

					<div class="row-fluid">
						<div id="focus-on" class="span6 overlay-area" style='width:50%;cursor:pointer'>
							<img src="img/Cannes_1.jpg">
							<span class="focus-descriptions">
								<div class="content">
									<p>
										Focus On
									</p>
									<span class="focus-cafe">Cannes
										<br />
										ARMANI CAFFE</span>
								</div> <div style="clear: both;"></div> <a style="display: none;" class="hidden-read-more blockspot" href="features.php"><span>Read Article</span></a> </span>

							<span class="img-overlay"></span>
						</div><!--/span-->

						<div id="the-story" class="span6 overlay-area" style='width:50%'>
							
				
								<span class="story-descriptions">
								<div class="content"> 
								  <p>
									Read
								</p>
								 </div>
								 </span>
								
								
								
								

						
							<span class="story-intro"><span class="story-title">The story</span><span class='cnt_st'>The delight of a warm welcome; the careful sourcing of quality ingredients;
								the radiance of a fantastic setting; work inspired by passion and a love of food</span></span>
							<a  href="stories.php"></a>
							<img src="img/the-story_bg.jpg">
							<span class="img-overlay"></span>
						</div><!--/span-->
					</div><!--/row-->

					<!-- add visibility only desktop  -->
					<div class="row-fluid   hidden-phone">
						<div id="near-by" class="span12">
							<div class="content">
								<p>
									FEATURED LOCATION
								</p>
								 <img src="<?php echo $featured["cafe_image_logo"]  ?>" alt="<?php echo $featured["cafe_name"]  ?> - <?php echo $featured["city_name"] ?> - <?php echo $featured["country_name"] ?> " />
								<span class="city"><?php echo $featured["city_name"] ?></span>
								<span class="address"><?php echo strip_tags( $featured["cafe_address"],'<div> <br>') ?>
									<br />
									<br />
                                    <?php echo $featured["cafe_telephone"] ?>
									<br />	
									
									<?php  if ($featured["cafe_bookinglink"]!='' && $featured["cafe_bookinglink"]!=NULL   ) {?>
									<a target="_blank"  href="<?php echo $featured["cafe_bookinglink"] ?>">RESERVE A TABLE</a> 
									<?php  } ?>
									</span>

							</div>
							<div class="near-by-overlay"></div>
							<img src="<?  echo $featured["cafeimage_path"]."/".$featured["cafeimage_filename"]?>">
						</div><!--/span-->

					</div><!--/row-->
				</div><!--/span-->
			</div><!--/row-->
<div class="row-fluid footer-wrap">
	<?php require_once 'includes/footer-menu.php'; ?>
</div>
		</div><!--/.fluid-container-->

		<!-- Boilerplate  -->
		  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
		<script src="js/plugins.js"></script>
		<script src="js/main.js"></script>
		<script src="js/jquery.bxslider.min.js"></script>

		<!-- Bootstrap -->
		<script src="js/bootstrap.min.js"></script>
		

		<script>
			$(document).ready(function() {
				//$('#mobile-accordion').hide();
				
				
		
				
				
				
				
				
				
				
				
				$('.img-overlay').hide();
				$('.accordion-toggle').click(function() {
					$('.accordion-toggle.active').not(this).removeClass('active');
					$(this).toggleClass('active');
				});
				var mouseState = false;
				var pusher = $("#homeSlider");
				
				var slider = $('.slider').bxSlider({
					/*  useCSS: false,
					  pager:true,*/
					auto : true,
					autoHover : true,
					nextText : '',
					prevText : '',
					pagerSelector:'',
					
					slideMargin : 0
					
					
				});




			
               if(!$('html').hasClass('touch')){
               		$('.overlay-area').mouseenter(function() {
					$(this).find('.img-overlay').fadeIn('fast');
					$(this).find('span.cnt_st').fadeTo(0,.2)
					
					
				});
				$(".overlay-area").mouseleave(function() {
					$(this).find(".img-overlay").fadeOut('fast');
					$(this).find('span.cnt_st').fadeTo(0,1)
					
				});
				
				$(".overlay-area").click(function() {
					
					window.location=$(this).find("a.blockspot").attr('href');
					
					
				});
				

				$('#focus-on').mouseenter(function() {
					$(this).find('.hidden-read-more').fadeIn('fast');
				});
				$("#focus-on").mouseleave(function() {
					$(this).find(".hidden-read-more").hide();
				});

              
          

			 pusher.on({
					
					mouseenter : function(e) {
						
				
						
						mouseState = true;
						 $('.img-overlay').fadeIn('fast',function(){
						 	
						 	return  $('#res_now').fadeIn('slow');
						 });
						
					},
					mouseleave : function(e) {
						
						mouseState = false;
						$('.img-overlay,#res_now').fadeOut('fast');
					}
				});
				
				 }
			});

		</script>
		<style>
		
		
		
		
		
		
		
		html.touch .img-overlay {
			background:none;
			
			
		}
		
		
	
		
		#res_now{
			text-decoration:none;
			color:#000000;
			background:white;
			text-align :center;
		
			padding:3px 8px 3px 8px;
			margin:auto;
			width:120px;
			font-size:10px;
			text-transform: uppercase;
			margin-top:20px;
			display: block;
			
		}
		
		
		
			@media (max-width: 520px) {
		#near-by-phone .lf span{
					
					
					font-size:12px;
					text-align:justify;
					
				}
		
		}
		
		
		@media (max-width: 480px) {
				#res_now {
					
					font-size:9px;
					width:100px;
					
					
				}
				
				
				#near-by-phone .content a {
					
					font-size:9px;
				}
				
				
				
				
				
				
			}
		
		
		
			html.touch .blk {
			display:block!important;
			
			
		}
		
		#homeSlider .bx-controls{
			
			z-index:150;
		}
		
		.blockspot{
			width:100%!important;
			display:block;
			border-top:1px solid #222222;
		    padding:0px !important;
		     background-position: 90% 15px!important;
		   
		 
			
			
		}
		
		.blockspot span{
	
		    padding:15px !important;
		    display:block;
		    
		   
		 
			
			
		}
			
			@media (max-width: 1100px) {
				#focus-on a.hidden-read-more {
					
					width:60%
					
					
				}
				
			}
			
		</style>


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
