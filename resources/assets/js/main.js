$(function () {
	//   //defining Varibles
	//   var mapBoxApi = '';
	//
	//
	//   //Create Human Icon
	//   var humanIcon = L.icon({
	//     iconUrl: 'icon-human.png',
	//     shadowUrl: 'icon-human-shadow.png',
	//     iconSize:     [38, 95], // size of the icon
	//     shadowSize:   [50, 64], // size of the shadow
	//     iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
	//     shadowAnchor: [4, 62],  // the same for the shadow
	//     popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
	//   });
	//
	//   //Init LeafletMap
	//   var map = L.map('wo_map');
	//
	//   //Set TileLayer
	//   L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={mapBoxApi}', {
	//     attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
	//     maxZoom: 18,
	//     id: 'your.mapbox.project.id',
	//     accessToken: 'pk.eyJ1IjoibWFnbm9sbyIsImEiOiJuSFdUYkg4In0.5HOykKk0pNP1N3isfPQGTQ'
	// }).addTo(mymap);
	//
	//   //Add Markers to LeafletMap


  //define mapbox api
  mapboxgl.accessToken = 'pk.eyJ1IjoibWFnbm9sbyIsImEiOiJuSFdUYkg4In0.5HOykKk0pNP1N3isfPQGTQ';
  var newHuman = {
    name:'',
    email:'',
    address:null
  };

  //setup popup
  var popup = new mapboxgl.Popup({
    closeButton:false
  });

  //setup mapbox gl map
	var map = new mapboxgl.Map({
		container: 'wo_map',
		style: 'mapbox://styles/mapbox/light-v8',
		center: [16.372801, 48.209272],
		zoom: 3,
	});

  //setup marker data for humans from lokal api
	map.on('style.load', function () {
		map.addSource('peoples', {
			type: 'geojson',
			data: '/api/pois/humans'
		});
		map.addLayer({
			"id": "humans",
      "interactive" : true,
			"type": "circle",
      "paint":{
        "circle-color":'#EB5B27',
        "circle-radius":3
      },
			"source": "peoples",
		})
	});

  //open popup for click on human marker
  map.on('click', function(e){
    map.featuresAt(e.point, {
      radius: 7.5,
      includeGeometry: true,
      layer:'humans'
    }, function(err, features){
      if(err || !features.length){
        popup.remove();
        return;
      }
      var feature = features[0];
      popup.setLngLat(feature.geometry.coordinates)
        .setHTML(feature.properties.name)
        .addTo(map);
    })
  });

  //submit solidarisch form
  $('#solidarisch').submit(function(e){
    e.preventDefault();
    newHuman.name = $('#name').val();
    newHuman.email = $('#email').val();
    console.log(newHuman);
    newHuman.lat = newHuman.address.geometry.coordinates[0];
    newHuman.lng = newHuman.address.geometry.coordinates[1];
    $.post('/api/pois/humans', newHuman, function(response){
      console.log(response);
    })
  })

  //autocomplete address input with mapzen remote
  $('#address').autocomplete({
    serviceUrl: 'https://search.mapzen.com/v1/search',
    dataType:'json',
    paramName: 'text',
    params:{
      "api_key": "search-Jssufg0"
    },
    minChars:3,
    transformResult:function(response){
      return {
        suggestions: $.map(response.features, function(item){
          return { value: item.properties.label, data: item}
        })
      }
    },
    onSelect:function(suggestion){
      newHuman.address = suggestion.data;
      addMarker(suggestion.data);
      fly(suggestion.data.geometry.coordinates)
    }
  });

  //Map Fly to lat,lng
  function addMarker(data){
    map.addSource('newMarker', {
			type: 'geojson',
			data: data
		});
    map.addLayer({
      "id": "newEntry",
      "interactive" : true,
      "type": "circle",
      "paint":{
        "circle-color":'#00ff00',
        "circle-radius":5
      },
      "source": "newMarker",
    })
  }
  function fly(coordinates) {
    map.flyTo({
        center: coordinates, zoom:10
    });
  }

});
