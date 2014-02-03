<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'] . '/' . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . '/library/classes/');

require_once 'config/database.php';
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
		<title>Armani/Ristorante | Stories</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/vendor/modernizr-2.6.2.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="http://cdn2.yoox.biz/Os/armanigroup/common/armani.ico">

	</head>

	<body class="features">

		<div id="upnav" class="row-fluid visible-phone">
			<?php
			require_once 'includes/mobile-menu.php';
			?>
		</div>

		<div id="content-body" class="container-fluid">
			
			<?php require_once 'includes/header_html.php'; ?>
			<div class="row-fluid">
				<div class="span3 hidden-phone" >
					<div class="lifestyle"  data-spy="affix" data-offset-top="0" >
						<a href="/"><img src="img/armani-lifestyle_loho.png" alt="Armani Lifestyle"></a>
					</div>
					<?php
					$is_story=true; require_once 'includes/location-menu.php';
					?>

				</div><!--/span-->
				<div class="span9 web-copy">

					<div id="featured-area">
						<div class="span4">
							<h1 class="title_siz">The Story</h1>
						</div>

					</div>

					<div id="story-area">

						<!--	<div id='bg_zone'> </div>
						<div class="span4">
						<h1>The Story</h1>
						</div>

						-->

						<div class="clearfix"></div>

						<span class="story-intro">The delight of a warm welcome; the careful sourcing of quality ingredients; the radiance of a fantastic setting; work inspired by passion and a love of food.</span>
						<div class="clearfix"></div>
						<span class="story-copy">
							Flavours complement the elegance of the surroundings, contributing to a harmonious, subtle aesthetic that conveys a sense of wellbeing. This is an individual approach to dining based on a philosophy that values simple, good food above all else.
							<br>
							<br>
							The philosophy is that of Giorgio Armani, a man who is deeply inspired by the ethos of non-formal hospitality. His approach is based on honest Italian cuisine, founded on quality, the excellent selection of seasonal raw materials, and simplicity. A highly varied gastronomic offer that is derived from authentic Italian menus, yet interprets them using local ingredients according to their integrity and quality. What distinguishes Armani's approach to dining is that Giorgio Armani has designed a unique concept for those who seek to combine the delights of a sophisticated and elegant atmosphere with polite and responsive service, and, of course, excellent, fresh cuisine.
								<br>
							<br>
							
							The range of Armani dining experiences comprises: Emporio Armani/Caffè, with its modern and relaxed atmosphere; Armani/Ristorante, for more formal occasions; and finally, the unique experience of Armani/Nobu Milano. An original fusion of Japanese cuisine with South American and Peruvian influences, based on rare and high quality ingredients, and Italian taste, the partnership of the great Nobuyuki Matsuhisa, considered one of the world's leading chefs, and Giorgio Armani, makes cuisine at Armani/Nobu Milano, with its excellent flavours, a constant source of delight and surprise.

							 </span>
					</div>

					<div class="row-fluid">

					</div><!--/row-->
				</div><!--/span-->
			</div><!--/row-->
				  
				  <div class="row-fluid footer-wrap">
					<?php require_once 'includes/footer-menu.php'; ?>
				</div>
		</div><!--/.fluid-container-->

		<!-- Boilerplate  -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')
		</script>

		<script src="js/plugins.js"></script>
		<script src="js/main.js"></script>
		<script src="js/jquery.bxslider.min.js"></script>
		<!-- Bootstrap -->
		<script src="js/bootstrap.min.js"></script>

		<script>
			$(document).ready(function() {

				$(window).on('resize', function() {

					var body = document.body, html = document.documentElement;

					var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);

					$("#story-area").css('height', $(window).height() + 'px');

				})

				$(window).trigger('resize')

				$('.accordion-toggle').click(function() {
					$('.accordion-toggle.active').not(this).removeClass('active');
					$(this).toggleClass('active');
				})

				$('.left-nav-item.active').click(function() {
					$('.accordion-group').slideToggle();
				})

				$('.cafe-slider').bxSlider({
					auto : true,
					controls : false,
					slideMargin : 10
				});

				$('.more-slider').bxSlider({
					pager : false,
					minSlides : 3,
					maxSlides : 3,
					nextText : '',
					prevText : ''
					//slideWidth: 0,
					//slideMargin: 10
				});

				$('.overlay-area').mouseenter(function() {
					$(this).find('.img-overlay').fadeIn('fast');
					$(this).find('a').fadeIn('fast');
				});
				$(".overlay-area").mouseleave(function() {
					$(this).find(".img-overlay").fadeOut('fast');
					$(this).find('a').fadeOut('fast');
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

		<style>
			/*#story-area{

			 background:none;
			 }*/

			<style>
			
			
			

			@media (max-width: 600px) {

				#featured-area	.title_siz {
					font-size: 80%;
					margin: 20px 0 0 0;
				}

			}

			@media (max-width: 767px) {

				#featured-area	.title_siz {
					font-size: 80%;
					margin: 20px 0 0 0;
				}

			}

			@media (min-width: 768px) and (max-width: 979px) {

				#content-body .col2, #content-body .col1 {
					width: 100%
				}

			}

			@media (max-width: 480px) {

				#featured-area	.title_siz {
					font-size: 80%;
				}

			}



		</style>

	</body>
</html>
