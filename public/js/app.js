$.extend($.validator.messages, {
  required: "Dieses Feld ist ein Pflichtfeld.",
  maxlength: $.validator.format("Geben Sie bitte maximal {0} Zeichen ein."),
  minlength: $.validator.format("Geben Sie bitte mindestens {0} Zeichen ein."),
  rangelength: $.validator.format("Geben Sie bitte mindestens {0} und maximal {1} Zeichen ein."),
  email: "Geben Sie bitte eine gültige E-Mail Adresse ein.",
  url: "Geben Sie bitte eine gültige URL ein.",
  date: "Bitte geben Sie ein gültiges Datum ein.",
  number: "Geben Sie bitte eine Nummer ein.",
  digits: "Geben Sie bitte nur Ziffern ein.",
  equalTo: "Bitte denselben Wert wiederholen.",
  range: $.validator.format("Geben Sie bitte einen Wert zwischen {0} und {1} ein."),
  max: $.validator.format("Geben Sie bitte einen Wert kleiner oder gleich {0} ein."),
  min: $.validator.format("Geben Sie bitte einen Wert größer oder gleich {0} ein."),
  creditcard: "Geben Sie bitte eine gültige Kreditkarten-Nummer ein."
});
$(function() {
	//define variables
	$.datas = {
		map : null,
		icons:{
			base: L.divIcon({
				className: 'baseIcon'
			}),
			event:L.icon({
			    iconUrl: '/images/markers/bubble.png',
			    iconSize: [40, 33],
			    iconAnchor: [20, 33],
			    popupAnchor: [0, -20],
			    shadowUrl: '/images/markers/bubble_shadow.png',
			    //shadowRetinaUrl: 'my-icon-shadow@2x.png',
			    shadowSize: [40, 33],
			  	shadowAnchor: [20, 33]
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


  //Sidenav
  $(".button-collapse").sideNav();

  //Text Rotator
  $(".rotateText").textrotator({
    animation: "flipCube", // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
    separator: ",", // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
    speed: 2000 // How many milliseconds until the next word show.
  });

  //Modal opener
  $('.modal-trigger').leanModal();

  //Init Tabs
  $('ul.tabs').tabs();

  //RemoveLoader
  $('body').removeClass('overflow-none');
  $('#loader').fadeOut();

  //Init DataTables
  $('.dataTable').DataTable();

  //Form Validator
  $('.validate-me').validate({
    errorElement: 'div',
    errorPlacement: function(error, element) {
      error.appendTo(element.parent(".input-field"));
    }
  });

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
				//resetMarker();
			//	source.setData(url);
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
		// success:function(file){
		// 	console.log(JSON.parse(file.xhr.response));
		// }
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
			console.log(e.target._latlng);
		});
		$.datas.map.flyTo([coordinates[1], coordinates[0]], 13);
	}
});

$.fn.extend({
  animateCss: function(animationName, doneClass, element) {
    var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    $(this).removeClass('hidden');
    $(this).addClass('animated ' + animationName).one(animationEnd, function() {
      $(this).removeClass('animated ' + animationName);
      $(this).addClass(doneClass);
      /*$('html, body').animate({
						 scrollTop: $(element).offset().top
					 }, 1000);*/
    });
  }
});

//# sourceMappingURL=app.js.map
