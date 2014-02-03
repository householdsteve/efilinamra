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
		<title>Armani/Ristorante | Features</title>
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
					<div class="lifestyle"  data-spy="affix" data-offset-top="0">
						<a href="/"><img src="img/armani-lifestyle_loho.png" alt="Armani Lifestyle"></a>
					</div>

					<?php
						$is_features=true;require_once 'includes/location-menu.php';
					?>

				</div><!--/span-->
				<div class="span9 web-copy">

					<div id="featured-area">
						<div class="span4">
							<h1 class="title_siz">FEATURES</h1>
						</div>
						<div class="span5 feature-tag-line">
							A COLLECTION OF ARTICLES ON ARMANI 
							<br/>
							LIFESTYLE ESTABLISHMENTS WORLD WIDE
						</div>

					</div>
					<div class="slider-wrap">
						<ul class="cafe-slider">

							<li><img src="/img/giorgioarmani-boutique-cannes.jpg" />
							</li>

						</ul>
					</div>
					<div class="row-fluid">
						<div class="content-body">

							<div class="features-title">
								<span>Focus On</span>
								<h2>CANNES</h2>
							</div>

							<div class="social-links hidden-phone" >

								<span style='font-size:75%;color:#ccc'>SHARE </span>
								<a class="facebook" onclick="return fbs_click()"  style='cursor:pointer'  >Facebook</a>
								<a class="twitter" href="http://twitter.com/share?url=<?php echo(rawurlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"))?>&text=<?php echo(rawurlencode('The Armani group is pleased to announce the opening of its first Giorgio Armani boutique in Cannes, during the Cannes Film Festival, and its new Armani/Caffè concept.'))?>">Twitter</a>
								<a class="plus" href="https://plus.google.com/share?url=<?php echo("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")?>">Plus</a><a class="pintrest" href="http://pinterest.com/pin/create/button/?url=<?php echo("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")?>&media=<?php echo("http://$_SERVER[HTTP_HOST]/img/giorgioarmani-boutique-cannes.jpg")?>&description=The Armani group is pleased to announce the opening of its first Giorgio Armani boutique in Cannes, during the Cannes Film Festival, and its new Armani/Caffè concept.">Pintrest</a>
							</div>

							<div class="clearfix"></div>
							<div class="col1">
								<p>

									<span class="prima">T</span>he Armani group is pleased to announce the opening of its first Giorgio Armani boutique in Cannes, during the Cannes Film Festival, and its new Armani/Caffè concept.
									<br/>
									<br/>
									To celebrate the opening, over 300 guests attended the cocktail party, hosted by Roberta Armani.
									<br/>
									<br/>
									Amongst others, the following attended: Milla Jovovich, Rosie Hungtington Whiteley, Lea Seydoux, Alyson Le Borges,
									Eugenia Silva, Paolo and Daniela Sorrentino, Ornella Muti, Kat Graham, Will Forte, Micheal Cera, Colin Egglesfield,
									Stacy Keibler, Paul Wisley, Jasmine Warsame, Juno Temple, Petra Nemcova, Moran Atias, Serena Dandini, Laura Dern, Jon Kortajarena.

								</p>

							</div>
							<div class="col2">
								<p>

									During the day, a new Armani Tweet Talks took place on the terrace of the Armani/Caffè.
									The discussion, moderated by  Peter Howarth (CEO of London creative agency Show Media), was focused on fashion and film
									and featured as panellists: Zachary Quinto (actor and film producer), Derek Blasberg (Harper’s Bazaar Editor-at-large and V Magazine editor),
									Kevin Maher (writer and Journalist at The Times), Greg Williams (photographer and film director) and Hilary Shor (producer).

								</p>
							</div>
							<div class="clearfix"></div>

							<hr />
							<!-- <h2>MORE FEATURED STORIES</h2>-->

							<div class="clearfix"></div>
								<div class="social-links hidden-desktop" >

								<span style='font-size:75%;color:#ccc'>SHARE </span>
								<a class="facebook"  onclick="return fbs_click()"  style='cursor:pointer'>Facebook</a>
								<a class="twitter" href="http://twitter.com/share?url=<?php echo(rawurlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"))?>&text=<?php echo(rawurlencode('The Armani group is pleased to announce the opening of its first Giorgio Armani boutique in Cannes, during the Cannes Film Festival, and its new Armani/Caffè concept.'))?>">Twitter</a>
								<a class="plus" href="https://plus.google.com/share?url=<?php echo("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")?>">Plus</a><a class="pintrest" href="http://pinterest.com/pin/create/button/?url=<?php echo("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")?>&media=<?php echo("http://$_SERVER[HTTP_HOST]/img/giorgioarmani-boutique-cannes.jpg")?>&description=The Armani group is pleased to announce the opening of its first Giorgio Armani boutique in Cannes, during the Cannes Film Festival, and its new Armani/Caffè concept.">Pintrest</a>
							</div>
							<div class="clearfix"></div>

						</div>

						<!--<div class="row" id="more-features-slider">
						<div class="slider-wrap">
						<ul class="more-slider">
						<li><img src="/img/more-featured-01.jpg" />
						<br />
						<span>Focus On</span>
						<br />
						MILANO MANZONI
						<br />
						COMPLEX
						<div class="clearfix"></div>
						</li>
						<li><img src="/img/more-featured-02.jpg" />
						<br />
						<span>Focus On</span>
						<br />
						MILANO MANZONI
						<br />
						COMPLEX
						<div class="clearfix"></div>
						</li>
						<li><img src="/img/more-featured-03.jpg" />
						<br />
						<span>Focus On</span>
						<br />
						MILANO MANZONI
						<br />
						COMPLEX
						<div class="clearfix"></div>
						</li>

						</ul>
						</div>
						</div>

						-->

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
				$('.accordion-toggle').click(function() {
					$('.accordion-toggle.active').not(this).removeClass('active');
					$(this).toggleClass('active');
				})

				$('.left-nav-item.active').click(function() {
					$('.accordion-group').slideToggle();
				})
				/*$('.cafe-slider').bxSlider({
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
				 });*/

				$('.overlay-area').mouseenter(function() {
					$(this).find('.img-overlay').fadeIn('fast');
					$(this).find('a').fadeIn('fast');
				});
				$(".overlay-area").mouseleave(function() {
					$(this).find(".img-overlay").fadeOut('fast');
					$(this).find('a').fadeOut('fast');
				});
				
				
				
				
				
				

			});
			
			
			function fbs_click(){
				
				
				window.open('http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")?>&p[images][0]=<?php echo("http://$_SERVER[HTTP_HOST]/img/giorgioarmani-boutique-cannes.jpg")?>&p[title]=FOCUS ON: The first Giorgio Armani boutique in Cannes&p[summary]=The Armani group is pleased to announce the opening of its first Giorgio Armani boutique in Cannes, during the Cannes Film Festival, and its new Armani/Caffè concept',
'sharer','toolbar=0,status=0,width=320,height=200');return false;
				
				
			}
			
		</script>

		<style>
			@media (max-width: 600px) {
				#content-body .col2, #content-body .col1 {
					width: 100%
				}

				#featured-area .feature-tag-line {

					font-size: 70%;
					margin: 5px 0 0 0;
				}

				#featured-area	.title_siz {
					font-size: 80%;
					margin: 20px 0 0 0;
				}

			}

			@media (max-width: 767px) {

				#featured-area .feature-tag-line {

					font-size: 70%;
					margin: 5px 0 0 0;
					float: none
				}

				#featured-area	.title_siz {
					font-size: 80%;
					margin: 20px 0 0 0;
				}

			}

			@media (min-width: 768px) and (max-width: 979px) {

				#featured-area .feature-tag-line {

					font-size: 70%;
					margin: 58px 0 0 40px;
				}

				#content-body .col2, #content-body .col1 {
					width: 100%
				}

			}

			@media (max-width: 480px) {

				#featured-area .feature-tag-line {

					font-size: 70%;
					margin: 5px 0 0 0;
				}

				#featured-area	.title_siz {
					font-size: 80%;
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
