$(function(){

  var baseLayer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',{attribution: 'Tiles &copy; CartoDB'});

  $.datas.map = L.map('wo_map', {
    layers:[baseLayer],
    center: [ 48.209272, 16.372801],
    zoom:12,
    zoomControl: false,
  });

  new L.Control.Zoom({ position: 'topright' }).addTo($.datas.map);
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

  L.Util.ajax("/api/pois/all").then(function(data){
    L.geoJson.css(data).addTo($.datas.map);
  });

});
