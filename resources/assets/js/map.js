$(function() {
  //define variables
  $.datas = {
    map: null,
    layer: null,
    layers: {
      heat: null,
      base: null,
      markers: null
    },
    icons: {
      base: L.divIcon({
        className: 'baseIcon'
      }),
      event: L.icon({
        iconUrl: '/images/markers/bubble.png',
        iconSize: [40, 33],
        iconAnchor: [20, 33],
        popupAnchor: [0, -20],
        //shadowUrl: '/images/markers/bubble_shadow.png',
        //shadowRetinaUrl: 'my-icon-shadow@2x.png',
        //shadowSize: [40, 33],
        //shadowAnchor: [20, 33]
      }),
      human: L.icon({
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
    newPoint: {
      address: null,
      marker: null
    },
    newImage: null,
    partnerImage:null
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
  var newPartner = {
    name:'',
    email:'',
    phone:'',
    address: '',
    url: '',
    image_id: '',
    organisation:'',
    message:''
  };


  $.datas.layers.base = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
    attribution: 'Tiles &copy; CartoDB'
  });

  $.datas.map = L.map('wo_map', {
    layers: [$.datas.layers.base],
    center: [48.209272, 16.372801],
    zoom: 12,
    zoomControl: false,
    touchZoom: false
  });

  //Zoom Controls to right
  new L.Control.Zoom({
    position: 'topright'
  }).addTo($.datas.map);

  //fullscreen button
  L.control.fullscreen({
    position: 'topright',
    title: {
      'false': 'Vollbildanzeige',
      'true': 'Vollbild verlassen'
    }
  }).addTo($.datas.map);


  $.datas.layer = L.Util.ajax("/api/pois/all").then(function(data) {
    $.datas.layers.markers = L.geoJson.css(data);
    $.datas.layers.markers.addTo($.datas.map);
  });

  //
  $('.map_overlay').on('click', function(e) {
    $(this).fadeOut(function() {
      $(this).remove()
    });
  });


  //FROM STUFF
  //switch forms
  $('#showEventsForm').on('click', function() {
    if ($('#eventForm').hasClass('hidden')) {
      $('#eventForm').animateCss('fadeInDown', '', '#eventForm');
      $('#solidarischForm').animateCss('zoomOutLeft', 'hidden');
    } else {
      $('#solidarischForm').animateCss('fadeInDown', '', '#solidarischForm');
      $('#eventForm').animateCss('zoomOutLeft', 'hidden');
    }
  });

  //validate and submit solidarisch form
  $('#solidarisch').validate({
    errorElement: 'div',
    errorPlacement: function(error, element) {
      error.appendTo(element.parent(".input-field"));
    },
    submitHandler: function(form) {
      newHuman.firstname = $('#firstname').val();
      newHuman.lastname = $('#lastname').val();
      newHuman.email = $('#email').val();
      newHuman.newsletter = $('#newsletter').is(":checked");
      newHuman.lat = $.datas.newPoint.address.geometry.coordinates[0];
      newHuman.lng = $.datas.newPoint.address.geometry.coordinates[1];
      $('#solidarisch .btn').attr('disabled', true);
      $.post('/api/pois/humans', newHuman, function(response) {
        swal({
          title: "Danke für dein WELCOMEoida!",
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
      }).error(function(response) {
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
    errorElement: 'div',
    errorPlacement: function(error, element) {
      error.appendTo(element.parent(".input-field"));
    },
    submitHandler: function(form) {

      newEvent.title = $('#event_title').val();
      newEvent.address = $.datas.newPoint.address;
      newEvent.from_date = $('#event_from').val();
      newEvent.to_date = $('#event_to').val();
      newEvent.phone = $('#event_phone').val();
      newEvent.url = $('#event_url').val();
      newEvent.description = $('#event_description').val();
      newEvent.lat = $.datas.newPoint.address.geometry.coordinates[0];
      newEvent.lng = $.datas.newPoint.address.geometry.coordinates[1];
      if ($.datas.newImage) {
        newEvent.image_id = $.datas.newImage.id;
      }

      $('#event .btn').attr('disabled', true);
      $.post('/api/pois/events', newEvent, function(response) {
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
        //$("#image-upload").removeAllFiles();
      }).error(function(response) {
        if (response.status == 401) {
          swal({
            title: "Nicht erlaubt!",
            text: "Bitte logge dich ein um ein Event zu erstellen!",
            type: "error",
            confirmButtonText: "Ok!",
            confirmButtonColor: "#EB5B27"
          });
        } else {
          swal({
            title: "Ouch!",
            text: "Da ist etwas schiefgelaufen!",
            type: "error",
            confirmButtonText: "Ok!",
            confirmButtonColor: "#EB5B27"
          });
        }

        $('#event .btn').removeAttr('disabled');
      });
    }
  });

  //validate and submit solidarisch form
  $('#partner').validate({
    errorElement: 'div',
    errorPlacement: function(error, element) {
      error.appendTo(element.parent(".input-field"));
    },
    submitHandler: function(form) {

      newPartner.name = $('#partner_name').val();
      newPartner.email = $('#partner_email').val();
      newPartner.address = $('#partner_location').val();
      newPartner.phone = $('#partner_phone').val();
      newPartner.url = $('#partner_url').val();
      newPartner.organisation = $('#partner_organisation').val();
      newPartner.message = $('#partner_message').val();
      newPartner.image_id = 0;
      if ($.datas.partnerImage) {
        newPartner.image_id = $.datas.partnerImage.id;
      }
      else{
        swal({
          title: "Kein Logo?",
          text: "Wir benötigen dein Logo für unsere Website!",
          type: "error",
          confirmButtonText: "Ok!",
          confirmButtonColor: "#EB5B27"
        });
        return false;
      }

      $('#partner .btn').attr('disabled', true);
      $.post('/api/partners', newPartner, function(response) {
        $('#modalPartner').closeModal();
        swal({
          title: "Baam!",
          text: "Deine Partneranfrage wurde erfolgreich gesendet!",
          type: "success",
          confirmButtonText: "Ok!",
          confirmButtonColor: "#EB5B27"
        });

        $('#partner')[0].reset();
        $('#partner label').removeClass('active');
        $('#partner .btn').removeAttr('disabled');
        $('#modalPartner').closeModal();
        //$("#image-upload").removeAllFiles();
      }).error(function(response) {
        if (response.status == 401) {
          swal({
            title: "Nicht erlaubt!",
            text: "Bitte logge dich ein um ein Event zu erstellen!",
            type: "error",
            confirmButtonText: "Ok!",
            confirmButtonColor: "#EB5B27"
          });
        } else {
          swal({
            title: "Ouch!",
            text: "Da ist etwas schiefgelaufen!",
            type: "error",
            confirmButtonText: "Ok!",
            confirmButtonColor: "#EB5B27"
          });
        }

        $('#partner .btn').removeAttr('disabled');
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
    transformResult: function(response) {
      return {
        suggestions: $.map(response.features, function(item) {
          return {
            value: item.properties.label,
            data: item
          }
        })
      }
    },
    onSelect: function(suggestion) {
      $.datas.newPoint.address = suggestion.data;
      var coordinates = suggestion.data.geometry.coordinates;
      //TODO: When rest of form is valid
      $('#solidarisch .btn').removeAttr('disabled');

      drawMarker('base', coordinates);

    }
  });


  //define image uploader
  var uploader = $("#image-upload").dropzone({
    init: function() {
      this.on("success", function(file) {
        $.datas.newImage = JSON.parse(file.xhr.response);
      });
    },
    paramName: 'image',
    maxFilesize: 4,
    multiple: false,
    maxFiles: 1,
    addRemoveLinks: true,
    acceptedFiles: 'image/*',
    url: "/api/images",
    thumbnailWidth: 336,
    thumbnailHeight: 150,
    dictRemoveFile: 'Bild löschen',
    dictInvalidFileType: 'Bilddatei?',
    dictFileTooBig: 'Die Datei ist zu groß!',

  });
  var uploader = $("#logo-uploader").dropzone({
    init: function() {
      this.on("success", function(file) {
        $.datas.partnerImage = JSON.parse(file.xhr.response);
      });
    },
    paramName: 'image',
    maxFilesize: 4,
    multiple: false,
    maxFiles: 1,
    addRemoveLinks: true,
    acceptedFiles: 'image/*',
    url: "/api/images/public",
    thumbnailWidth: 336,
    thumbnailHeight: 150,
    dictRemoveFile: 'Bild löschen',
    dictInvalidFileType: 'Bilddatei?',
    dictFileTooBig: 'Die Datei ist zu groß!',

  });

  $('.timeinput').timepicker({
    timeFormat: 'H:i'
  });

  var HeatSwitch = L.Control.extend({
    options: {
      position: 'topright'
    },

    onAdd: function(map) {
      var container = L.DomUtil.create('div', 'layer-toogler leaflet-bar');
      this._link = L.DomUtil.create('a', 'leaflet-bar-part', container);
      this._link.href = '#';
      this._link.title = "Marker/Heatmap";
      this._icon = L.DomUtil.create('span', 'fa fa-bullseye', this._link);
      L.DomEvent
        .on(this._link, 'click', L.DomEvent.stopPropagation)
        .on(this._link, 'click', L.DomEvent.preventDefault)
        .on(this._link, 'click', function() {
          if ($.datas.map.hasLayer($.datas.layers.heat)) {
            L.DomUtil.removeClasses(this._icon, 'fa fa-circle');
            L.DomUtil.addClasses(this._icon, 'fa fa-bullseye');
            $.datas.map.removeLayer($.datas.layers.heat);
            $.datas.map.addLayer($.datas.layers.markers);
          } else {

            L.DomUtil.removeClasses(this._icon, 'fa fa-bullseye');
            L.DomUtil.addClasses(this._icon, 'fa fa-circle');
            $.datas.map.removeLayer($.datas.layers.markers);
            $.datas.map.addLayer($.datas.layers.heat);
          }
        }, this)
        .on(this._link, 'dblclick', L.DomEvent.stopPropagation);

      return container;
    }
  });

  $.datas.map.addControl(new HeatSwitch());

  $.get('/api/pois/raw/all', function(data) {
    $.datas.layers.heat = L.heatLayer(data, {
      radius: 15,
      gradient: {
        0.4: '#11A0D2',
        0.5: '#B8DAB7',
        1: '#EB5B27'
      }
    });
  })

  function drawMarker(type, coordinates) {
    if ($.datas.newPoint.marker) {
      $.datas.newPoint.marker.remove();
    };
    $.datas.newPoint.marker = L.marker([coordinates[1], coordinates[0]], {
      icon: $.datas.icons[type],
      draggable: true,
      riseOnHover: true,
    });
    $.datas.newPoint.marker.addTo($.datas.map);
    $.datas.newPoint.marker.on('dragend', function(e) {
      $.datas.newPoint.address.geometry.coordinates[1] = e.target._latlng.lat;
      $.datas.newPoint.address.geometry.coordinates[0] = e.target._latlng.lng;
    });
    $.datas.map.flyTo([coordinates[1], coordinates[0]], 13);
  }

});
