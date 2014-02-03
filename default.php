<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'] . '/' . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . '/library/classes/');

require_once 'config/database.php';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Armani Lifestyle | Locations</title>
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

    
    <body class="locations open-nav">
    		<div id="upnav" class="row-fluid visible-phone">
			 <?php
			require_once 'includes/mobile-menu.php';
 ?>
		</div>
    <div id="content-body" class="container-fluid">

    	<?php
		require_once 'includes/header_html.php';
 ?>
      <div class="row-fluid">
        <div class="span3 hidden-phone">
       <div class="lifestyle"  data-spy="affix" data-offset-top="0">
       	<a href="/"><img src="/img/armani-lifestyle_loho.png" alt="Armani Lifestyle"></a>
        </div>
			<?php $isopen = true;
			require_once 'includes/location-menu.php';
 ?>
        </div><!--/span-->
        <div class="span9 web-copy">

<div id="search-area">
<h2>Search for location</h2>
<div id="search-box" class="ui-widget">
	<input id="search" name="search" /> <a id="my-location" href="javascript: searchcity();">Search</a> 
	<input type="hidden" id="searchcity" name="searchcity" value="" />
</div>
</div>

          
               <div class="row-fluid">
            <div id="locations-body">
			 <?php 
			 
				require_once 'class/continent.php';
				require_once 'class/cafe.php';
				require_once 'mobile-detect-master/Mobile_Detect.php';
				
				$detect = new Mobile_Detect;

				
				$continentObject = new class_continent();
				$cafeObject		 = new class_cafe();

				$continentData = $continentObject->getFrontAll();
				
				
				$maincount=0;
				$todisplay=2;
				
				
			
			
			
			foreach($continentData as $item) {
							
						
					 			
			?>
			
			<div class="location-continent-group"> 
			<h3><?php echo $item['continent_name']; ?></h3>				
			<?php 
				$cafe = $cafeObject->getFeatureByContinent($item['continent_code']);
				if($cafe) {
					//print_r ($cafe);
					
				//	echo ( $detect->isTablet().'---' . $detect->isMobile() )
					
				?> 
				<h4 class="hidden-phone">FEATURED LOCATIONS</h4>	
				
				
				
				
				<div class="slider hidden-phone" >
				<?php 
				
			      if ( (($detect->isMobile()=='') && ($detect->isTablet()==''))|| $detect->isTablet()==1  )
			 
				    
					for($a = 0; $a < count($cafe); $a++) {
									
						$tag='';
					if ($a== count($cafe) -1  ){
						
						
						
						 $tag='<!--CLOSE --></div>';
					}		
						
					$odd = 'odd';
					if($a%2 != 0) $odd ='even'; 
					
					
				?>
				
				
				  
				   	
				   	
				   	  
				   <?php
				   
				 

				$img_odd = $cafe[$a]['cafe_image_search'];
				$img_even = $cafe[$a]['ftrpath'] . "/" . ($cafe[$a]['ftrcode'] . $cafe[$a]['ftrext']);
				$img_fullpage = $cafe[$a]['ftrxpath'] . "/" . ($cafe[$a]['ftrxcode'] . $cafe[$a]['ftrxext']);

				$load = $css_ = $odd;

				// row continent event start with sub element even ( this reverse val  of the counter)
				if ($maincount % 2 != 0) {

					$css_ .= '_rev';

					if ($a % 2 != 0)
						$load = $odd = 'odd';
					if ($a % 2 == 0)
						$load = $odd = 'even';

				}

				//if elemente is alone  use the  full col width
				if ( (($tag != '') && (count($cafe) % $todisplay != 0) /*||  count($cafe)< $todisplay*/  )  ) {

					$load = $css_ = $odd='fullpage';
					//$odd = 'even';

				}

				$_render = "<div class='is_sub _sub_". $css_ . "'>  <div class='ishover'> </div>  <div class='isloader'> </div>   <div class='logobox'>";

				$_render = $_render . '<a    href="/locations/' . $cafe[$a]['city_link'] . '/' . $cafe[$a]['cafe_link'] .'">Discover'.$cafe[$a]['cafeimage_type'].'</a>';
				$_render = $_render . "<img src='" . $cafe[$a]['ftrlpath'] . '/' . $cafe[$a]['ftrlcode'] . $cafe[$a]['ftrlext'] ."' alt='Armani Cafe Location' />";

				$_render = $_render . "<span class='city'>" . $cafe[$a]['city_name'] . "</span>";

				$toadd = "";
				if ($css_ == 'fullpage') {
					$toadd = "<img   style='width:100%'   src='../img/load_fullpage.gif' />";
				}

				$_render = $_render . "</div>" . $toadd . "<img data-rel='" . ${"img_" . $odd} . "'  class='isimg' src='" . "../img/load_" . $load . ".gif'  /> </div>";

				if (($a % $todisplay == 0))
					echo("<div class='_elm'>");

				echo($_render);

				if (($a % $todisplay != 0))
					echo("<!--000000--></div>");

				echo("<!--555-->".$tag);

				}

				$maincount++;
				 } ?>
			
			     <?php if($maincount >= $todisplay ){ ?>   	</div>  <?php   }?>  
			
			<?php 
				$cafeData = $cafeObject->getFrontByContinent($item['continent_code']); 
				
				if($cafeData) {
			?>
			<h5>ALL LOCATIONS</h5>
				<ul>
				<?php 
					foreach ($cafeData as $cafe) { 
				?>									
					<li><span><?php echo $cafe['city_name']; ?></span> - <a href="/locations/<?php echo $cafe['city_link'] . '/' . $cafe['cafe_link']; ?>"><?php echo $cafe['cafe_name']; ?></a></li>
				<?php
				}
				?>
				</ul>			
				
				
			<?php } ?>
			
			
			<!--111-->
			
			</div>
			
			
			<?php } ?>

            </div><!--/span-->

          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->
		<div class="row-fluid footer-wrap">
		<?php
		require_once 'includes/footer-menu.php';
 ?>
		</div>
    </div><!--/.fluid-container-->
       
       
               <style>
				html.touch .logobox a {
					display: block;
				}

				.ishover {

					position: absolute;
					top: 0;
					right: 0;
					bottom: 0;
					left: 0;
					background: black;
					display: none;
				}

				.isloader {

					position: absolute;
					top: 0;
					right: 0;
					bottom: 0;
					left: 0;
					background: url('../img/34.gif') no-repeat 50% 30%;
				}

				._elm {

					background: white;
					position: relative;
				}

				._elm .city {
					color: #CCCCCC;
					padding-top: 5px;
					display: block;
					font-size: 80%;
				}

				.logobox a {

					display: none;
					font-size: 80%;
					color: white;
					padding: 10px;
					position: absolute;
					bottom: 115%;
					left: 0;
					right: 0;
					background: url('../img/read-more-arrow2.png') right no-repeat #000;
				}

				.logobox img {

					width: 100%;
					height: auto;
					image-rendering: optimizeQuality;
					-ms-interpolation-mode: bicubic;
				}

				.logobox {

					position: absolute;
					display: block;
					background: #000;
					bottom: 4%;
					left: 10px;;
					right: 30%;
					top: 62%;
					z-index: 1000;
					padding: 10px;
				}

				._sub_odd_rev .logobox, ._sub_even .logobox {

					right: 70%;
					/*left:1,714285714285714;*/
				}

				._sub_odd {

					width: 27%;
					float: left;
					position: relative;
				}

				._sub_even {

					top: 0;
					bottom: 0;
					right: 0;
					left: 32%;
					overflow: hidden;
					position: absolute;
				}

				._sub_fullpage {
					overflow: hidden;
					position: relative;
				}

				._sub_fullpage .logobox {

					bottom: 4%;
					left: 10px;
					right: 80%;
					top: 65%;
					z-index: 1000;
				}

				._sub_fullpage   .ishover {

					z-index: 100;
				}

				._sub_fullpage .isimg {

					top: 0;
					bottom: 0;
					right: 0;
					left: 0;
					position: absolute;
					z-index: 10;
					height: 100%;
				}

				.isimg {

					width: 100%;
				}

				/*	._sub_even {

				 width: 68%;
				 float: right;
				 position: relative;
				 }

				 ._sub_odd_rev {

				 width: 68%;
				 float: left;
				 position: relative;
				 }
				 */

				._sub_odd_rev {

					top: 0;
					bottom: 0;
					right: 32%;
					left: 0;
					overflow: hidden;
					position: absolute;
				}

				._sub_even_rev {

					width: 27%;
					float: right;
					position: relative;
				}

				.bx-controls .disabled {
					cursor: default;
					/* IE 8 */
					-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
					/* IE 5-7 */
					filter: alpha(opacity=20);
					/* Netscape */
					-moz-opacity: 0.2;
					/* Safari 1.x */
					-khtml-opacity: 0.2;
					/* Good browsers */
					opacity: 0.2;
				}

				@media (max-width: 1100px) {

					.logobox a {

						font-size: 11px;
					}

					.location-continent-group ul li {

						font-size: 8px;
					}

					.location-continent-group h5 {
						margin-bottom: 5px;
					}

					._elm .city {

						font-size: 9px;
					}

					.location-continent-group ul li a {

						line-height: 12px;
						display: inline;
					}

					.logobox {

						position: absolute;
						display: block;
						background: #000;
						bottom: 4%;
						left: 10px;
						right: 10px;
						top: 42%;
						z-index: 1000;
						padding: 10px;
					}

					._sub_odd_rev .logobox, ._sub_even .logobox {

						right: 50%;
						/*left:1,714285714285714;*/
					}

					._sub_fullpage .logobox {

						bottom: 4%;
						left: 10px;
						right: 60%;
						top: 38%;
						z-index: 1000;
					}

				}
				
				
				.is_sub:hover{
					
					cursor:pointer;
				}

				/*.location-continent-group ul li*/

    </style>
       
		<!-- Boilerplate  -->
       
        
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/jquery.bxslider.min.js"></script>
        <!-- Bootstrap -->
	    <script src="/js/bootstrap.min.js"></script>

        
        <script type="text/javascript">
															$(document).ready(function() {

				
				
				$('#accordion').on('hide.bs.collapse', function (a,b,c) {
 
				  $(a.target).prev().find('a').removeClass('active')
				 
				})
				
				$('#accordion').on('show.bs.collapse', function (a,b,c) {
				 
			
				  $(a.target).prev().find('a').addClass('active')
				 
				})
					
				

				/*$('.left-nav-item.active').click(function() {
					//$('.accordion-group').slideToggle();
				})*/



               <?php     if ( (($detect->isMobile()=='') && ($detect->isTablet()==''))|| $detect->isTablet()==1  )  { ?>
				$('.slider').bxSlider({
					pager : false,
					infiniteLoop : false,
					
				

					slideMargin : 50,
					hideControlOnEnd : true,
					
					onSliderLoad : function(t) {
						   
                     	  
                     	
                     
						
					},
					onSlideBefore : function($slideElement, oldIndex, newIndex) {

						var cont = $slideElement.find('.isimg');

						if (!cont.hasClass("is-loaded")) {
							$($slideElement.find('.isimg')).each(function() {

								var im = new Image();

								var el = $(this);

								im.onload = function() {

									$slideElement.find('.isloader').remove();
									//console.log('IM loaded!');
									el.after(im).remove();
									im.className = ('is-loaded isimg');
								}

								im.src = el.attr('data-rel');

							});

						}

					},
					nextText : '',
					prevText : ''

				});

				$('.is_sub').mouseenter(function() {
					$(this).find('.ishover').fadeTo('fast', .8);
					$(this).find('.logobox a').fadeIn('fast');
				});
				$('.is_sub').mouseleave(function() {
					$(this).find(".ishover").fadeOut('fast');
					$(this).find('.logobox a').hide();

				});
				
				
				
				$('.is_sub').click(function() {
				 
				 alert('ok')
					window.location = $(this).find('.logobox a').attr('href');

				});
				
				
				

				$.each($('.slider'), function() {
                     
                  
                  
                     
                     
					$(this).find('._elm').first().find('.isloader').remove()

					$.each($(this).find('._elm').first().find('.isimg'), function() {

						$(this).attr('src', $(this).attr('data-rel')).addClass("is-loaded");

					})
				})

				   <?php  } ?>
					$("#search").autocomplete({
						source : "/feeds/locations.php",
						minLength : 2,
						select : function(event, ui) {

							//	console.log(ui.item.id)
							if (ui.item.id == '') {
								/* $('#participantcodename').html(''); */
								/* $('#participant_code').val('');					 */
							} else {
								/* $('#participantcodename').html('<b>' + ui.item.value + '</b>'); */
								// window.location.href = '/locations/'+ui.item.id;
								$('#searchcity').val(ui.item.id);
							}

							$('#search').val('');
						}
					});

					});

					function searchcity() {
						if ($('#searchcity').val() != '') {
							window.location.href = '/locations/' + $('#searchcity').val();
						}
					}
  		</script>  
        
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-44248958-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>
    </body>
</html>
