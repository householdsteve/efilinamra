<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

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


    
    <body class="locations">
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
				
				$continentObject = new class_continent();
				$cafeObject		 = new class_cafe();

				$continentData = $continentObject->getFrontAll();
				
				
				$maincount=0;
				
				
			
			
			
				foreach($continentData as $item) {
							
						
					 			
			?>
			
			<div class="location-continent-group"> 
			<h3><?php echo $item['continent_name']; ?></h3>				
			<?php 
				$cafe = $cafeObject->getFeatureByContinent($item['continent_code']);
				if($cafe) {
					
					echo($maincount%2 != 0); 
				?> 
				<h4 class="hidden-phone">FEATURED LOCATIONS</h4>	
				
				
				
				
				<div class="slider hidden-phone" >
				<?php 
				
				    
				 
				   
				//   $pair=false;
				    
					for($a = 0; $a < count($cafe); $a++) {
									
						$tag=''		;
					if ($a== count($cafe) -1){
						
						 $tag='</div>';
					}		
						
					$odd = 'odd';
					if($a%2 != 0) $odd ='even'; 
					
					
					
					
					
					
					
					
               
				?>
				
				
				  
				   	
				   	
				   	  
				   <?php  
				  
				      
				      $img_odd="../media/cafe/".($cafe[$a]['cafe_code'])."/search_".($cafe[$a]['cafe_code']).".jpg"  ;
				      $img_even=$cafe[$a]['ftrpath']."/".($cafe[$a]['ftrcode'].$cafe[$a]['ftrext']);
					 
					   $css_=$odd;
					   
					   
					   if ( $maincount%2 != 0  ) {
						
						  $css_.='_rev';
						  
						   if ($a%2 != 0) $odd ='odd';
						   if ($a%2 == 0) $odd ='even';
						  
						
					   }        
					   
					   
					  
					    $_render="<div class='_sub_".$css_."'><div class='logobox'>";
					   
					   
					   	  $_render=$_render.'<a  href="/locations/"'.$cafe[$a]['city_link'].'/'.$cafe[$a]['cafe_link'].">Discover</a>";
					   
					     $_render=$_render."<img src='".$cafe[$a]['ftrlpath'].'/'.$cafe[$a]['ftrlcode'].$cafe[$a]['ftrlext']."' alt='Armani Cafe Location' />";
					     
					     $_render=$_render."<span class='city'>".$cafe[$a]['city_name']."</span>";
						 $_render=$_render."</div><img style='width:100%;' src='".${"img_".$odd}. "'  /> </div>";
				      
		
				       
					 
					 

					 	
					 if (($a%2 == 0))   echo ("<div class='_elm'>");
					 
					 
					 echo($_render);
					 
					 
					 if (($a%2 != 0))echo ("</div>");
				  
				    
                     echo( $tag);
						
						
						
				
					 
					
				     
					
					 
				   } 
					
					
					$last_elm=$odd;
					
					$maincount++;
					
					
				
					
					?>
					
			
				</div>
				
				
				
			
								
	
				
				
				
			<?php } ?>
			
			<?php 
				$cafeData = $cafeObject->getFrontByContinent($item['continent_code']); 
				
				if($cafeData) {
			?>
			<h5>ALL LOCATIONS</h5>
				<ul>
				<?php 
					foreach ($cafeData as $cafe) { 
				?>									
					<li><span><?php echo $cafe['city_name']; ?></span> - <a href="/locations/<?php echo $cafe['city_link'].'/'.$cafe['cafe_link']; ?>"><?php echo $cafe['cafe_name']; ?></a></li>
				<?php 
					} 
				?>
				</ul>			
			<?php } ?>
			</div>
			<?php } ?>

            </div><!--/span-->

          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->
    
        <style>
        
    	._elm{
    		
    		background: white;
position:relative;
    		
    	}
    	
    	
    	.logobox a{
    		
		
			display: block;
			background:red;
			position: absolute;
		    left:0;
		    right:0;
		    bottom:120%;
		
		    
    		
    	}
    	
    	.logobox img{
    		
    		width:100%;
    		height: auto;
    
    	}
    	
    	.logobox{
    		
			position: absolute;
		
			display: block;
			background: #000;
			bottom: 4%;
			left: 4%;
			right:30%;
			
			padding:10px;
			z-index: 115;

    		
    	}
    	
    	
    	._sub_odd_rev .logobox{
    		
    	
    		
    		right:70%;
    	}
    	
    	
    	._sub_even .logobox{
    		
    		right:70%;
    		
    	}
    	
    	/*
    	._sub_odd{
    		
    		background: purple;
    		width:27%;
    		
    	}
    	
    	
    	._sub_even{
    		
    		background: orange;
    		position:absolute;
    		left: 32%;
    		bottom: 0;
    		right:0;
    		top:0;
    		
    	}
    	
    	
    		._sub_odd_rev{
    		
    		background: purple;
    		width:53%;
    		
    		  
    		  
    		  
    		
    	}
    	
    	
    	._sub_even_rev{
    		
    		background: orange;
    		position:absolute;
    		left: 88%;
    		bottom: 0;
    		right:0;
    		top:0;
    		
    	}
    	
    	
    	*/
    	
    	
    	._sub_odd{
    		
    	
    		width:27%;
    		float:left;
    		
    		
    		position: relative;
    		
    	}
    	
    	
    	._sub_even{
    		
    		width:68%;
    		float:right;
    			position: relative;
    		
    		
    	}
    	
    	
    	._sub_odd_rev{
    		
    		
    		width:68%;
    		float:left;
   position: relative;
    		
    	}
    	
    	
    	._sub_even_rev{
    		
    		width:27%;
    		float:right;
    	position: relative;
    		
    		
    	}
    	
    
    	#locations-body{
    	/*padding : 	20px 10% 0 5%*/
    		
    	}
    	
    </style>
    
       
		<!-- Boilerplate  -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/jquery.bxslider.min.js"></script>
        <!-- Bootstrap -->
	    <script src="/js/bootstrap.min.js"></script>

        
        <script type="text/javascript">
		
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
			  infiniteLoop:false,
			  
			
	
			  nextText: '',
			  prevText: ''
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
			if($('#searchcity').val() != '') {
				window.location.href = '/locations/'+$('#searchcity').val();
			}
		}
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
