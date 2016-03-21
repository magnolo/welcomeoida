$(function(){
  //define mapbox api
	mapboxgl.accessToken = 'pk.eyJ1IjoibWFnbm9sbyIsImEiOiJuSFdUYkg4In0.5HOykKk0pNP1N3isfPQGTQ';

	//bin solidarisch form/submit oject
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


	//setup popup
	var popup = new mapboxgl.Popup({
		closeButton: false
	});

	//setup mapbox gl map
	var map = new mapboxgl.Map({
		container: 'wo_map',
		style: 'mapbox://styles/mapbox/light-v8',
		center: [16.372801, 48.209272],
		zoom: 10,
	});

	//Add zoom and rotation controls to the map.
	map.addControl(new mapboxgl.Navigation());

	//setup GeoJSONSource from local API
	var url = '/api/pois/all';
	var source = new mapboxgl.GeoJSONSource({
		data: url
	});


	//setup marker data for humans from lokal api
	map.on('style.load', function () {
		map.addSource('pois', source);
		map.addLayer({
			"id": "humans",
			"interactive": true,
			"type": "circle",
			"paint": {
				"circle-color": '#EB5B27',
				"circle-radius": 5,
        "circle-radius-transition": {
					duration: 250,
          delay:0
				},
			},
			"source": "pois",
			"filter": ["==", "type_id",1]
			// "layout": {
			// 		 "icon-image": "{marker-symbol}-15",
			// 		 "text-offset": [0, 0.6],
			// 		 "text-anchor": "top"
			//  }
		});
		map.addLayer({
			"id": "events",
			"interactive": true,
			"type": "symbol",
			// "paint": {
			// 	"circle-color": '#00ff00',
			// 	"circle-radius": 5,
      //   "circle-radius-transition": {
			// 		duration: 250,
      //     delay:0
			// 	},
			// },
			"source": "pois",
			"filter": ["==", "type_id",2],
		 "layout": {
		 		 "icon-image": "marker-15",
		 		 "text-offset": [0, 0.6],
		 		 "text-anchor": "top"
		  }
		});

	});

	//open popup for click on human marker
	map.on('click', function (e) {
		map.featuresAt(e.point, {
			radius: 15,
			includeGeometry: true,
			layer: ['humans','events'],
		}, function (err, features) {
			if (err || !features.length) {
				popup.remove();
				return;
			}
			var feature = features[0];
			var data = feature.properties;
			var html = '';
			if(data.type_id == 1){
				html = data.title;
			}
			else{
				if(data.image.id){
					html += "<img class='title-image' src='"+data.image.path+"' />";
				}
				html += "<h5>"+data.title+"</h5>";
			}
			popup.setLngLat(feature.geometry.coordinates)
				.setHTML(html)
				.addTo(map);
		})
	});

	// Use the same approach as above to indicate that the symbols are clickable
	// by changing the cursor style to 'pointer'.
	map.on('mousemove', function (e) {
	    map.featuresAt(e.point, {
	        radius:15, // Half the marker size (15px).
	        layer: 'humans'
	    }, function (err, features) {
	        map.getCanvas().style.cursor = (!err && features.length) ? 'pointer' : '';
	    });
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
  			newHuman.lat = newHuman.address.geometry.coordinates[0];
  			newHuman.lng = newHuman.address.geometry.coordinates[1];
  			$('#solidarisch .btn').attr('disabled', true);
  			$.post('/api/pois/humans', newHuman, function (response) {
  				swal({
  					title: "Baam!",
  					text: "Dein Pin wurde auf die Karte gesetzt!",
  					type: "success",
  					confirmButtonText: "Ok!",
  					confirmButtonColor: "#EB5B27"
  				});
  				resetMarker();
  				source.setData(url);
  				$('#solidarisch')[0].reset();
          $('#solidarisch label').removeClass('active');
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

				newEvent.title =$('#event_title').val();
				newEvent.address = newHuman.address;
  			newEvent.from_date = $('#event_from').val();
  			newEvent.phone = $('#event_phone').val();
  			newEvent.url = $('#event_url').val();
				newEvent.description = $('#event_description').val();
  			newEvent.lat = newHuman.address.geometry.coordinates[0];
  			newEvent.lng = newHuman.address.geometry.coordinates[1];
				newEvent.image_id = newImage.id;
  			$('#event .btn').attr('disabled', true);
  			$.post('/api/pois/events', newEvent, function (response) {
  				swal({
  					title: "Baam!",
  					text: "Deine Veranstaltung wurde erfolgreich gespeichert!",
  					type: "success",
  					confirmButtonText: "Ok!",
  					confirmButtonColor: "#EB5B27"
  				});
  				resetMarker();
  				source.setData(url);
  				$('#event')[0].reset();
          $('#event label').removeClass('active');
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
  			newHuman.address = suggestion.data;

  			//TODO: When rest of form is valid
  			$('#solidarisch .btn').removeAttr('disabled');

  			addMarker(suggestion.data);
  			fly(suggestion.data.geometry.coordinates)
  		}
  	});

    var anim = null;
  	//remove the user marker if present
  	function resetMarker() {
  		var lSource = map.getSource('newMarker');
  		if (typeof lSource != "undefined") {
        if(anim){
          window.cancelAnimationFrame(anim);
        }
  			map.removeLayer('newEntry');
  			map.removeLayer('newEntry1');
  			map.removeSource('newMarker');
  		}
  	}

  	//add a marker from geo feature
  	function addMarker(data) {
  		resetMarker();
    	var framesPerSecond = 15;
    	var initialOpacity = 1;
    	var opacity = initialOpacity;
    	var initialRadius = 5;
    	var radius = initialRadius;
    	var maxRadius = 12;


  		map.addSource('newMarker', {
  			type: 'geojson',
  			data: data
  		});
  		map.addLayer({
  			"id": "newEntry",
  			"interactive": true,
  			"type": "circle",
  			"paint": {
  				"circle-radius": 10,
  				"circle-color": "#EB5B27",
          "circle-opacity": 0.5
  			},
  			"source": "newMarker",
  		});

  		map.addLayer({
  			"id": "newEntry1",
  			"source": "newMarker",
  			"type": "circle",
  			"paint": {
  				"circle-radius": 5,
  				"circle-color": "#EB5B27"
  			}
  		});

  		// function animateMarker(timestamp) {
  		// 	setTimeout(function () {
      //
    	// 			anim = window.requestAnimationFrame(animateMarker);
    	// 			radius += (maxRadius - radius) / framesPerSecond;
    	// 			opacity -= (.9 / framesPerSecond);
      //
    	// 			if (opacity > 0) {
      //
    	// 				map.setPaintProperty('newEntry', 'circle-radius', radius);
    	// 				map.setPaintProperty('newEntry', 'circle-opacity', opacity);
    	// 			} else {
      //
    	// 				radius = initialRadius;
    	// 				opacity = initialOpacity;
    	// 			}
      //
  		// 	}, 1000 / framesPerSecond);
      //
  		// }
  		// // Start the animation.
  		// animateMarker(0);
  	}

  	//fly the map to [lat, lng] position
  	function fly(coordinates) {
  		map.flyTo({
  			center: coordinates,
  			zoom: 11
  		});
  	}

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
	 	var newImage = null;
	 	$("#image-upload").dropzone({
	 		init:function(){
	 			 this.on("success", function(file) {
	 					newImage = JSON.parse(file.xhr.response);
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
	 		// success:function(file){
	 		// 	console.log(JSON.parse(file.xhr.response));
	 		// }
	 	});
})
