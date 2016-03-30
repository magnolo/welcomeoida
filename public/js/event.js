$(function() {
  //define variables
  var eventId = $('#event').data('id');
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
    newImage: null
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

  $.datas.layer = L.Util.ajax("/api/pois/"+eventId).then(function(data) {
    $.datas.layers.markers = L.geoJson.css(data);
    $.datas.layers.markers.addTo($.datas.map);
    $.datas.map.setView([
      data.features[0].geometry.coordinates[1],
      data.features[0].geometry.coordinates[0],
    ]);
  });

  //
  $('.map_overlay').on('click', function(e) {
    $(this).fadeOut(function() {
      $(this).remove()
    });
  });


  //FROM STUFF


  //validate and submit solidarisch form
  $('#event_update').validate({
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
      $('#lat').val(coordinates[0]);
      $('#lng').val(coordinates[1]);
      $('#location').val(JSON.stringify($.datas.newPoint.address));
      moveMarker('event', coordinates);

    }
  });


  //define image uploader
  var uploader = $("#image-upload").dropzone({
    init: function() {
      this.on("success", function(file) {
        $.datas.newImage = JSON.parse(file.xhr.response);
        $('#image_id').val($.datas.newImage.id);
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

  $('.timeinput').timepicker({
    timeFormat: 'H:i'
  });


  function moveMarker(type, coordinates) {
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

//# sourceMappingURL=event.js.map
