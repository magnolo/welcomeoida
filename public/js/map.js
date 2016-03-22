$(function(){
  var baseLayer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',{attribution: 'Tiles &copy; CartoDB'});
  var map = L.map('wo_map', {
    layers:[baseLayer],
    center: [ 48.209272, 16.372801],
    zoom:12
  });

  L.Util.ajax("/api/pois/all").then(function(data){
    L.geoJson.css(data).addTo(map);
  });

});

//# sourceMappingURL=map.js.map
