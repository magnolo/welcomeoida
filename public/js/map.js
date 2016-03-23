$(function(){
  //define variables
	$.datas = {
		map : null,
		layer: null,
		icons:{
			base: L.divIcon({
				className: 'baseIcon'
			}),
			event:L.icon({
			    iconUrl: '/images/markers/bubble.png',
			    iconSize: [40, 33],
			    iconAnchor: [20, 33],
			    popupAnchor: [0, -20],
			    //shadowUrl: '/images/markers/bubble_shadow.png',
			    //shadowRetinaUrl: 'my-icon-shadow@2x.png',
			    //shadowSize: [40, 33],
			  	//shadowAnchor: [20, 33]
			}),
			human:L.icon({
			    iconUrl: '/images/markers/ball.png',
			    iconSize: [12, 12],
			    iconAnchor: [6, 6],
			    //popupAnchor: [0, -20],
			    //shadowUrl: 'my-icon-shadow.png',
			    //shadowRetinaUrl: 'my-icon-shadow@2x.png',
			    //shadowSize: [68, 95],
			    //shadowAnchor: [22, 94]
			})
		},
		newPoint : {
			address: null,
	    marker: null
		},
		newImage : null
	}
	var newHuman = {
		name: '',
		email: '',
		address: null
	};
	var newEvent = {
		name: '',
		email: '',
		address: null
	};


  var baseLayer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',{attribution: 'Tiles &copy; CartoDB'});

  $.datas.map = L.map('wo_map', {
    layers:[baseLayer],
    center: [ 48.209272, 16.372801],
    zoom:12,
    zoomControl: false,
    touchZoom: false
  });

  //Zoom Controls to right
  new L.Control.Zoom({ position: 'topright' }).addTo($.datas.map);

    //fullscreen button
  L.control.fullscreen({
    position:'topright',
    title:{
      'false': 'Vollbildanzeige',
      'true': 'Vollbild verlassen'
    }
  }).addTo($.datas.map);

  // DRAW ICON BY DRAGGING ON MAP
  // var drawnItems = new L.FeatureGroup();
  // //$.datas.map.addLayer(drawnItems);
  //
  // // Initialise the draw control and pass it the FeatureGroup of editable layers
  // var drawControl = new L.Control.Draw({
  //     position:'topright',
  //     edit: {
  //         featureGroup: drawnItems,
  //     },
  //     draw:{
  //       polyline:false,
  //       polygon:false,
  //       rectangle:false,
  //       circle:false
  //     }
  // });
  // drawControl.addTo($.datas.map);
  // $.datas.map.on('draw:created', function (e) {
  //   var type = e.layerType,
  //       layer = e.layer;
  //
  //   if (type === 'marker') {
  //       // Do marker specific actions
  //       console.log('markt')
  //   }
  //
  //   // Do whatever else you need to. (save to db, add to map etc)
  //   $.datas.map.addLayer(layer);
  // });


  // LOCATE ME
  L.control.locate({
      position: 'topright',  // set the location of the control
      layer: undefined,  // use your own layer for the location marker, creates a new layer by default
      drawCircle: true,  // controls whether a circle is drawn that shows the uncertainty about the location
      follow: true,  // follow the user's location
      setView: true, // automatically sets the map view to the user's location, enabled if `follow` is true
      keepCurrentZoomLevel: false, // keep the current map zoom level when displaying the user's location. (if `false`, use maxZoom)
      stopFollowingOnDrag: false, // stop following when the map is dragged if `follow` is true (deprecated, see below)
      remainActive: false, // if true locate control remains active on click even if the user's location is in view.
      markerClass: L.circleMarker, // L.circleMarker or L.marker
      circleStyle: {
        color:'#EB5B27',
        opacity:0.2,
        fillColor:'#EB5B27'
      },  // change the style of the circle around the user's location
      markerStyle: {
        color:'#EB5B27',
        opacity:1,
        fillColor:'#EB5B27'
      },
      followCircleStyle: {},  // set difference for the style of the circle around the user's location while following
      followMarkerStyle: {},
      icon: 'fa fa-map-marker',  // class for icon, fa-location-arrow or fa-map-marker
      iconLoading: 'fa fa-spinner fa-spin',  // class for loading icon
      iconElementTag: 'span',  // tag for the icon element, span or i
      circlePadding: [0, 0], // padding around accuracy circle, value is passed to setBounds
      metric: true,  // use metric or imperial units
      onLocationError: function(err) {alert(err.message)},  // define an error callback function
      onLocationOutsideMapBounds:  function(context) { // called when outside map boundaries
              alert(context.options.strings.outsideMapBoundsMsg);
      },
      showPopup: true, // display a popup when the user click on the inner marker
      strings: {
          title: "Zeige mir wo ich bin",  // title of the locate control
          metersUnit: "metern", // string for metric units
          feetUnit: "feet", // string for imperial units
          popup: "Du befindest dich im Umkreis von {distance} {unit} zu diesem Punkt",  // text to appear if user clicks on circle
          outsideMapBoundsMsg: "Du befindest dich außerhalb der Grenzen dieser Karte!?" // default message for onLocationOutsideMapBounds
      },
      locateOptions: {}  // define location options e.g enableHighAccuracy: true or maxZoom: 10
  }).addTo($.datas.map);

  $.datas.layer = L.Util.ajax("/api/pois/all").then(function(data){
    L.geoJson.css(data).addTo($.datas.map);
  });



  //FROM STUFF
  //switch forms
	$('#showEventsForm').on('click', function(){
		if( $('#eventForm').hasClass('hidden')){
			$('#eventForm').animateCss('fadeInDown','', '#event');
			$('#solidarischForm').animateCss('zoomOutLeft', 'hidden');
		}
		else{
			$('#solidarischForm').animateCss('fadeInDown');
				$('#eventForm').animateCss('zoomOutLeft', 'hidden');
			}
	});

	//validate and submit solidarisch form
	$('#solidarisch').validate({
		errorElement:'div',
		errorPlacement: function(error, element) {
		 error.appendTo( element.parent(".input-field"));
	 },
		submitHandler: function (form) {
			newHuman.firstname = $('#firstname').val();
			newHuman.lastname = $('#lastname').val();
			newHuman.email = $('#email').val();
			newHuman.lat = $.datas.newPoint.address.geometry.coordinates[0];
			newHuman.lng = $.datas.newPoint.address.geometry.coordinates[1];
			$('#solidarisch .btn').attr('disabled', true);
			$.post('/api/pois/humans', newHuman, function (response) {
				swal({
					title: "Baam!",
					text: "Dein Pin wurde auf die Karte gesetzt!",
					type: "success",
					confirmButtonText: "Ok!",
					confirmButtonColor: "#EB5B27"
				});
				//resetMarker();
				//source.setData(url);
				drawMarker('human', [newHuman.lat, newHuman.lng]);

				$('#solidarisch')[0].reset();
				$('#solidarisch label').removeClass('active');
				$('#solidarisch .btn').removeAttr('disabled');
			}).error(function(response){
				swal({
					title: "Ouch!",
					text: "Da ist etwas schiefgelaufen!",
					type: "error",
					confirmButtonText: "Ok!",
					confirmButtonColor: "#EB5B27"
				});
				$('#solidarisch .btn').removeAttr('disabled');
			});
		}
	});

	//validate and submit solidarisch form
	$('#event').validate({
		errorElement:'div',
		errorPlacement: function(error, element) {
		 error.appendTo( element.parent(".input-field"));
	 },
		submitHandler: function (form) {

			newEvent.title = $('#event_title').val();
			newEvent.address = $.datas.newPoint.address;
			newEvent.from_date = $('#event_from').val();
			newEvent.to_date = $('#event_to').val();
			newEvent.phone = $('#event_phone').val();
			newEvent.url = $('#event_url').val();
			newEvent.description = $('#event_description').val();
			newEvent.lat = $.datas.newPoint.address.geometry.coordinates[0];
			newEvent.lng = $.datas.newPoint.address.geometry.coordinates[1];
      if($.datas.newImage.id){
        newEvent.image_id = $.datas.newImage.id;
      }

			$('#event .btn').attr('disabled', true);
			$.post('/api/pois/events', newEvent, function (response) {
				swal({
					title: "Baam!",
					text: "Deine Veranstaltung wurde erfolgreich gespeichert!",
					type: "success",
					confirmButtonText: "Ok!",
					confirmButtonColor: "#EB5B27"
				});
        drawMarker('event', [newEvent.lat, newEvent.lng]);
				$('#event')[0].reset();
				$('#event label').removeClass('active');
        $('#event .btn').removeAttr('disabled');
			}).error(function(response){
				swal({
					title: "Ouch!",
					text: "Da ist etwas schiefgelaufen!",
					type: "error",
					confirmButtonText: "Ok!",
					confirmButtonColor: "#EB5B27"
				});
				$('#event .btn').removeAttr('disabled');
			});
		}
	});


	//autocomplete address input with mapzen remote
	$('.location').autocomplete({
		serviceUrl: 'https://search.mapzen.com/v1/search',
		dataType: 'json',
		paramName: 'text',
		params: {
			"api_key": "search-Jssufg0"
		},
		minChars: 3,
		transformResult: function (response) {
			return {
				suggestions: $.map(response.features, function (item) {
					return {
						value: item.properties.label,
						data: item
					}
				})
			}
		},
		onSelect: function (suggestion) {
    	$.datas.newPoint.address = suggestion.data;
			var coordinates = suggestion.data.geometry.coordinates;
			//TODO: When rest of form is valid
			$('#solidarisch .btn').removeAttr('disabled');

			drawMarker('base', coordinates);

		}
	});


	//define image uploader
	$("#image-upload").dropzone({
		init:function(){
			 this.on("success", function(file) {
					$.datas.newImage = JSON.parse(file.xhr.response);
			 });
		},
		paramName:'image',
		maxFilesize: 4,
		multiple:false,
		maxFiles:1,
		addRemoveLinks:true,
		acceptedFiles:'image/*',
		url: "/api/images",
		thumbnailWidth:336,
		thumbnailHeight:150,
		dictRemoveFile:'Bild löschen',
		dictInvalidFileType:'Bilddatei?',
		dictFileTooBig:'Die Datei ist zu groß!',

	});

  $('.timeinput').timepicker({
    timeFormat: 'H:i'
  });

	function drawMarker(type, coordinates){
		if($.datas.newPoint.marker){
			$.datas.newPoint.marker.remove();
		};
		$.datas.newPoint.marker = L.marker([coordinates[1], coordinates[0]],{
			icon: $.datas.icons[type],
			draggable:true,
			riseOnHover:true,
		});
		$.datas.newPoint.marker.addTo($.datas.map);
		$.datas.newPoint.marker.on('dragend', function(e){
			$.datas.newPoint.address.geometry.coordinates[1] = e.target._latlng.lat;
			$.datas.newPoint.address.geometry.coordinates[0] = e.target._latlng.lng;
		});
		$.datas.map.flyTo([coordinates[1], coordinates[0]], 13);
	}

});

//# sourceMappingURL=map.js.map
