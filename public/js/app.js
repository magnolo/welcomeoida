$(function() {

  //define mapbox api
  mapboxgl.accessToken = 'pk.eyJ1IjoibWFnbm9sbyIsImEiOiJuSFdUYkg4In0.5HOykKk0pNP1N3isfPQGTQ';
  var newHuman = {
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
    zoom: 3,
  });

  //setup GeoJSONSource from local API
  var url = '/api/pois/humans';
  var source = new mapboxgl.GeoJSONSource({
    data: url
  });

  //setup marker data for humans from lokal api
  map.on('style.load', function() {
    map.addSource('peoples', source);
    map.addLayer({
      "id": "humans",
      "interactive": true,
      "type": "circle",
      "paint": {
        "circle-color": '#EB5B27',
        "circle-radius": 3
      },
      "source": "peoples",
    })
  });

  //open popup for click on human marker
  map.on('click', function(e) {
    map.featuresAt(e.point, {
      radius: 7.5,
      includeGeometry: true,
      layer: 'humans'
    }, function(err, features) {
      if (err || !features.length) {
        popup.remove();
        return;
      }
      var feature = features[0];
      popup.setLngLat(feature.geometry.coordinates)
        .setHTML(feature.properties.name)
        .addTo(map);
    })
  });

  //validate and submit solidarisch form
  $('#solidarisch').validate({
    submitHandler: function(form) {
      $(form).submit(function(e) {
        $('#solidarisch .btn').attr('disabled', true);
        newHuman.name = $('#name').val();
        newHuman.email = $('#email').val();
        newHuman.lat = newHuman.address.geometry.coordinates[0];
        newHuman.lng = newHuman.address.geometry.coordinates[1];
        $.post('/api/pois/humans', newHuman, function(response) {
          resetMarker();
          source.setData(url);
          $('#solidarisch .btn').removeAttr('disabled');
          $('#solidarisch')[0].reset();
        })
      })
    }
  });

  //autocomplete address input with mapzen remote
  $('#location').autocomplete({
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
      newHuman.address = suggestion.data;
      addMarker(suggestion.data);
      fly(suggestion.data.geometry.coordinates)
    }
  });

  //Map Fly to lat,lng
  var dynamicMarkerSrc = null;
  var dynamicMarkerLayer = null;

  function resetMarker() {
    var lSource = map.getSource('newMarker');
    if (typeof lSource != "undefined") {
      map.removeLayer('newEntry');
      map.removeSource('newMarker')
    }
  }

  function addMarker(data) {
    resetMarker();
    map.addSource('newMarker', {
      type: 'geojson',
      data: data
    });
    map.addLayer({
      "id": "newEntry",
      "interactive": true,
      "type": "circle",
      "paint": {
        "circle-color": '#00ff00',
        "circle-radius": 5
      },
      "source": "newMarker",
    })
  }

  function fly(coordinates) {
    map.flyTo({
      center: coordinates,
      zoom: 11
    });
  }

});
//# sourceMappingURL=app.js.map
