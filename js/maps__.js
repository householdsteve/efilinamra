function HomeControl(controlDiv, map) {


    var dati =   [{
        label: 't',
        img: '/img/t.png',
        x:0,
        y:-100
    }, {
        label: 'r',
        img: '/img/r.png',
        x:-100,
        y:0
    }, {
        label: 'b',
        img:'/img/b.png',
        x:0,
        y:100
    }, {
        label: 'l',
        img: '/img/l.png',
        x:100,
        y:0
    }];

    var controlUIREL = document.createElement('a');
    controlUIREL.id='rel_ctrl';
    controlDiv.id='abs_ctrl';
    
    
     controlUIREL.href="http://maps.google.com/maps?t=h&q=loc:"+document.getElementById('latitude').value +"," +document.getElementById('longitude').value+"&z=18 ";
   
    controlUIREL.target='_blank';
    controlUIREL.innerHTML='View in Google Map';
    controlUIREL.style.background = '#FFFFFF';
    controlDiv.appendChild(controlUIREL);

    //console.log(dd2dms())




}




function dd2dms() {
	
	
	var ddLong= document.getElementById('longitude');
	var ddLat=document.getElementById('latitude');
	
		// got dashes?
		
		if (ddLat.value.substr(0,1) == "-") {
			//dmsLatHem.options.selectedIndex = 1;
			var ddLatVal = ddLat.value.substr(1,ddLat.value.length-1);
		} else {
			//dmsLatHem.options.selectedIndex = 0;
			var ddLatVal = ddLat.value;
		}
		
		if (ddLong.value.substr(0,1) == "-") {
			//dmsLongHem.options.selectedIndex = 1;
			var ddLongVal = ddLong.value.substr(1,ddLong.value.length-1);
		} else {
			//dmsLongHem.options.selectedIndex = 0;
			var ddLongVal = ddLong.value;
		}
		
		// degrees = degrees
		var ddLatVals = ddLatVal.split(".");
		var dmsLatDeg = ddLatVals[0];
		
		var ddLongVals = ddLongVal.split(".");
		var dmsLongDeg = ddLongVals[0];
		
		// * 60 = mins
		var ddLatRemainder  = ("0." + ddLatVals[1]) * 60;
		var dmsLatMinVals   = ddLatRemainder.toString().split(".");
		var dmsLatMin = dmsLatMinVals[0];
		
		var ddLongRemainder  = ("0." + ddLongVals[1]) * 60;
		var dmsLongMinVals   = ddLongRemainder.toString().split(".");
		var dmsLongMin = dmsLongMinVals[0];
		
		// * 60 again = secs
		var ddLatMinRemainder = ("0." + dmsLatMinVals[1]) * 60;
		var dmsLatSec   = Math.round(ddLatMinRemainder);
		
		var ddLongMinRemainder = ("0." + dmsLongMinVals[1]) * 60;
		var dmsLongSec  = Math.round(ddLongMinRemainder);
		
		
		//return  ( 'q='+ encodeURI ( dmsLatDeg + '%C2%B0 ' + dmsLatMin + "' " +   dmsLatSec  +  "%22 ,"+  dmsLongDeg + '%C2%B0 ' + dmsLongMin + "' " +   dmsLongSec) +"%22" +'&ie=UTF-8')
		
		
		
		
	}


function round100000(v) {
		return Math.round(v * 100000) / 100000;
	}




function wheel() {

    var r = true;

    if (checkScrollBar()) {

        r = false
    }
    //  //console.log()
    return r

}




function initialize() {

    var lat = document.getElementById('latitude').value;
    var lon = document.getElementById('longitude').value;




    google.maps.Map.prototype.panToWithOffset = function (latlng, offsetX, offsetY) {
        var map = this;
        var ov = new google.maps.OverlayView();
        ov.onAdd = function () {
            var proj = this.getProjection();
            var aPoint = proj.fromLatLngToContainerPixel(latlng);
            aPoint.x = aPoint.x + offsetX;
            aPoint.y = aPoint.y + offsetY;
            map.panTo(proj.fromContainerPixelToLatLng(aPoint));
        };
        ov.draw = function () {};
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

    google.maps.event.addDomListener(window, 'resize', function () {



        // map.setCenter(center);
        var center = new google.maps.LatLng(lat, lon);

        document.getElementById('expand-map').className == 'active' ? map.setCenter(center) : map.panToWithOffset(center, 0, 100);



        map.setOptions({
            scrollwheel: wheel()
        });


    });



    google.maps.event.addDomListener(document.getElementById('expand-map'), 'click', function (e) {

        var mapOptions;
        if (e.target.className != 'active') {

            //console.log('chiuso');




            map.panToWithOffset(map.getCenter(), 0, 100);


            mapOptions = {
                // draggable: !$('html').hasClass('touch'),
                scrollwheel: false,

                zoomControl: false,
                scaleControl: false,
                panControl: false,
                scrollwheel: wheel()
            };




        } else {

            map.panToWithOffset(map.getCenter(), 0, -100);




            mapOptions = {
                /*draggable:  true,
				            scrollwheel:  true,
				            disableDoubleClickZoom: false,*/
                // draggable: !$('html').hasClass('touch'),
                zoomControl: true,
                scaleControl: true,
                panControl: true,
                scrollwheel: wheel()
            };

            //console.log('aperto' ,mapOptions.draggable) 


        }


        $('html').hasClass('touch') ? mapOptions.panControl = false : '';
        
         $('html').hasClass('touch') ? mapOptions.zoomControl = true : '';
       

        //  //console.log('aperto' ,mapOptions.draggable) 

        map.setOptions(mapOptions);


           

        // mapOptions.draggable==false ? 	binder(true) :'';




    });




    google.maps.event.addListenerOnce(map, 'tilesloaded', function () {

        //console.log('load' )

        if ($('html').hasClass('touch')) {



            //console.log('touch');
            map.setOptions({ zoomControl: true ,
                draggable: false
            });
            //binder(true);


           
           /* var homeControlDiv = document.createElement('div');
            var homeControl = new HomeControl(homeControlDiv, map);

            homeControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
         */


        }




    });




}




function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
    document.body.appendChild(script);
}


function binder(active) {

    if (active) {

        //console.log('bind')




    } else {

        //console.log('unbind')
    }



}





window.onload = loadScript;