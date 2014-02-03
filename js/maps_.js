
			function initialize() {
			
				var lat = document.getElementById('latitude').value;
				var lon = document.getElementById('longitude').value;
				
				
				
				
				google.maps.Map.prototype.panToWithOffset = function(latlng, offsetX, offsetY) {
			    var map = this;
			    var ov = new google.maps.OverlayView();
			    ov.onAdd = function() {
			        var proj = this.getProjection();
			        var aPoint = proj.fromLatLngToContainerPixel(latlng);
			        aPoint.x = aPoint.x+offsetX;
			        aPoint.y = aPoint.y+offsetY;
			        map.panTo(proj.fromContainerPixelToLatLng(aPoint));
			    }; 
			    ov.draw = function() {}; 
			    ov.setMap(this); 
			    
				};
							
				
				
				
				//alert(lat +"----"+ lon)
				
			/*
#mainBody #map img { 
  max-width: none;
}

#mainBody #map label { 
  width: auto; display:inline; 
} */
			
				
			    var mapOptions = {
			        zoom: 18,
			        center: new google.maps.LatLng(lat, lon),
			        mapTypeId: google.maps.MapTypeId.ROADMAP,
			          
			       panControl: false,
					  zoomControl: false,
					  mapTypeControl: false,
					  scaleControl: false,
					  streetViewControl: false,
					  overviewMapControl: false,
					   scrollwheel: wheel(),
					   
					  /* draggable: $('html').hasClass('touch')?false:true,*/
					  
					  
					  panControlOptions: {
				        position: google.maps.ControlPosition.TOP_RIGHT
				        
				      },
				    
				      zoomControlOptions: {
				        position: google.maps.ControlPosition.TOP_RIGHT,
				          style: google.maps.ZoomControlStyle.LARGE,
				        
				      },
				    
				  
							    
			        
			        
			        styles: [
			            [{
			                opt_textColor: '#FFFFFF'
			            }]
			        ],
			        mapstyles: [{
			                stylers: [{
			                    saturation: -100
			                }, {
			                    lightness: 0
			                }, {
			                    hue: '#333333'
			                }]
			            }, {
			                featureType: 'landscape.man_made',
			                elementType: 'geometry',
			                stylers: [{
			                    hue: '#333333'
			                }, {
			                    saturation: -100
			                }, {
			                    invert_lightness: true
			                }, {
			                    gamma: 1.29
			                }, {
			                    lightness: 2
			                }, {
			                    visibility: 'on'
			                }]
			            },

			            {
			                featureType: 'road',
			                elementType: 'geometry.stroke',
			                stylers: [{
			                        color: '#666666'
			                    },

			                    {
			                        weight: 2
			                    }, {
			                        visibility: 'on'
			                    }
			                ]
			            }

			            , {
			                featureType: 'road',
			                elementType: 'geometry.fill',
			                stylers: [{
			                        color: '#000000'
			                    },

			                    {
			                        visibility: 'on'
			                    }
			                ]
			            },


			            {
			                featureType: 'landscape.natural',
			                elementType: 'geometry',
			                stylers: [{
			                        color: '#262626'
			                    },

			                    {
			                        lightness: -42
			                    }
			                ]
			            }, {
			                featureType: 'all',
			                elementType: 'labels.text.fill',
			                stylers: [{
			                    color: '#ffffff'
			                }]
			            }


			            , {
			                featureType: 'all',
			                elementType: 'labels.text.stroke',
			                stylers: [{
			                    color: '#000000'
			                }]
			            }

			            , {
			                featureType: 'all',
			                elementType: 'labels.icon',
			                stylers: [{
			                        hue: '#333333'
			                    },

			                    {
			                        invert_lightness: true
			                    },

			                ]
			            }

			        ]
			    };

			    var styledMap = new google.maps.StyledMapType(mapOptions.mapstyles, {
			        name: "Styled Map"
			    });
			    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                
                
               // alert(mapOptions.center)
               
               
             
                
                  
			    var marker = new google.maps.Marker({
			        position: mapOptions.center,
			        map: map,
			        icon: {
			            url: '/img/mark.png',
			            size: new google.maps.Size(50, 50)
			        }
			    });

			    map.mapTypes.set('map_style', styledMap);
			    map.setMapTypeId('map_style');
			    
			/*   var center = map.getCenter();
				function calculateCenter() {
				  center = map.getCenter();
				};*/
				
				
				
				
				 map.panToWithOffset(map.getCenter(), 0, 100);
				
			
		
			/*	google.maps.event.addDomListener(map, 'drag', function() {
				 
				 
				if( $('html').hasClass('touch')){
					
					
					
					//console.log('drag')
					return
				}
				
				
				});
				
				
				*/
		
			/*	$('#gmap-canvas div[title^="Panoramica a sinistra"]').click( function (e){
					
					 //console.log(e);
				})
				
				
				*/
				
				
				
				google.maps.event.addDomListener(window, 'resize', function() {
					
					
					
				 // map.setCenter(center);
				  var center=new google.maps.LatLng(lat, lon);
				  
				  document.getElementById('expand-map').className=='active' ?  map.setCenter(center): map.panToWithOffset(center, 0, 100); 
				
				  
				
				   map.setOptions({  scrollwheel:  wheel()});
				  
				  
				});
				
				
				/*google.maps.event.addListener(map, 'resize', function() {
				  //console.log('resized');
				});*/
				
				google.maps.event.addDomListener(document.getElementById('expand-map'), 'click', function(e) {
			   
			     var mapOptions;
			     if ( e.target.className!='active'){
			   	
			   	 //console.log('chiuso');
			   	  
			   	  
			   	   
			   	   
			   	    map.panToWithOffset(map.getCenter(), 0, 100); 
			   	   
			   	  
			   	    mapOptions = {
				           // draggable: !$('html').hasClass('touch'),
				            scrollwheel: false,
				           
				            zoomControl:false,
				            scaleControl: false,
				            panControl:false,
				             scrollwheel:wheel()
				        };
			   	       
			   	       
			   	      
			   	
			     }else{
			     		  
			     		  map.panToWithOffset(map.getCenter(), 0, -100); 
			     		 
			     		
			     		  
			     		  
			     		
			   	  
			     	  mapOptions = {
				            /*draggable:  true,
				            scrollwheel:  true,
				            disableDoubleClickZoom: false,*/
				           // draggable: !$('html').hasClass('touch'),
				            zoomControl: true,
				            scaleControl: true,
				            panControl:true,
				            scrollwheel:wheel()
				        };
				        
				       //console.log('aperto' ,mapOptions.draggable) 
			     	   
			     	  
			     }
			     
			     
			      $('html').hasClass('touch')?mapOptions.panControl=false:'';
			      
			      
			      //  //console.log('aperto' ,mapOptions.draggable) 
			     
			  	 map.setOptions( mapOptions);
			  	 
			  	 
			  	 
			  	 
			  	// mapOptions.draggable==false ? 	binder(true) :'';
			  	 
			  	 
			  	 
			  	 
			  	 
				});
				
				
				
				
				
				
				
				
				
				
				
				   
				    
				     
				     
				     
				  google.maps.event.addListenerOnce(map, 'tilesloaded', function(){
                       
                       	//console.log('load' )
                       	
                       			if( $('html').hasClass('touch')){
					
					
									
									//console.log('touch');
								    map.setOptions({ /*panControl: true ,*/ draggable:false});
									//binder(true);
									
									
									 var homeControlDiv = document.createElement('div');
									  var homeControl = new HomeControl(homeControlDiv, map);
									
									  homeControlDiv.index = 1;
									  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
									
									
									
								}
                       	
             
				     
                       
   					 });
				     
				     
				     
				
			}
			
			
			
			
			
			

			function loadScript() {
			    var script = document.createElement('script');
			    script.type = 'text/javascript';
			    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
			    document.body.appendChild(script);
			}
			
			
			function binder ( active){
				
				if(active){
					
					//console.log('bind')
					
					
					          	
                       	
                       	
                      
					
					
					
				}else{
					
						//console.log('unbind')
				}
				
				
				
			}
			
			
			
			
			
			
			
			
			
			function HomeControl(controlDiv, map) {

			
			  var dati= [{label:'t',img:''   } ,{label:'r',img:''  } ,{label:'b',img:''  } ,{label:'l', img:''  } ];
			  
			  var controlUIREL = document.createElement('div');
			  
			  controlDiv.style.padding = '5px';
			  controlUIREL.style.position = 'relative';
			
			   controlDiv.style.width='120px';
			   controlDiv.style.height='120px';
			
			      controlDiv.appendChild( controlUIREL);
			
			
			
			  
			  
			 for ( var i=0; i<dati.length;i++  ){
			 	
			 	
			 	  var controlUI = document.createElement('div');
			 	  controlUI.id=dati[i]['label']+'_ar'
		
				  controlUIREL.appendChild(controlUI);
				
			
				  var controlText = document.createElement('div');
				  controlText.style.fontFamily = 'Arial,sans-serif';
				  controlText.style.fontSize = '12px';
				  controlText.style.paddingLeft = '4px';
				  controlText.style.paddingRight = '4px';
				  controlText.innerHTML = dati[i]['label'];
				  controlUI.appendChild(controlText);
				
				  
				  google.maps.event.addDomListener(controlUI, 'click', function(e) {
				   
				   
				    /* map.panToWithOffset(map.getCenter(), 0, -100); */
			     		 
				  });
			 	
			 	
			 }
			
			
				  
			  
			  
			  
			  
			  
			  
			}
						
			
		  
		   function wheel(){
		   	      
		   	      var r= true ;
		   	      
		   	      if(checkScrollBar()){
				  	
				  	r= false
				  }
		   	     //  //console.log()
		   	      return r 
		   	       
		   }
				
		


			window.onload = loadScript;
