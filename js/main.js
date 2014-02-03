Modernizr.addTest('csscalc', function() {
	var prop = 'width:';
	var value = 'calc(10px);';
	var el = document.createElement('div');

	el.style.cssText = prop + Modernizr._prefixes.join(value + prop);

	return !!el.style.length;
});



$(function() {
 if (!Modernizr.csscalc) {


	$('.span9').css({ 'float' : 'right', 'width': ($(document).width() - 206) + 'px'});
	$('.span3').css({'width': ( 206) + 'px' , 'overflow':'hidden'});
	$('div.lifestyle').css('margin-right', '13px'  )
	
	
	
	setInterval(function(){
	
		$('.span9').css({ 'float' : 'right', 'width': ($(document).width() - 206) + 'px'});
	
	},1000);
	
	
	
	
	$(window).resize(function() {
       
		$('.span9').css({  'width': ($(document).width() - 206) + 'px'});
		$('.span3').css('width', ( 206) + 'px');
		  // $('div.lifestyle').css('width', $('.span3').width() +'px'  )

	})
	
	//$(window).trigger('resize')
}

});






	function checkScrollBar() {
				
				var r=false;	
			    var hContent = $("body").height(); 
			    var hWindow = $(window).height();  
			
			    
			    if(hContent>hWindow) { 
			       r=  true;    
			    }
	
	           return r;
}