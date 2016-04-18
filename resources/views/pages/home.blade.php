@extends('layouts.main')
@section('head')
    <!--<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.css' rel='stylesheet' />-->
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v1.0.0-beta.2/leaflet.css" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
	<link type="text/css" rel="stylesheet" href="http://www.craftandvalue.com/_welcomeOida/layout.css" />    
@stop
@section('content')
<div class="row center-align block sandy" style="padding-bottom: 3rem;">
  <div class="col s12">
	  <h3 class="inunsererstadt" >In unserer Stadt sind Flüchtlinge willkommen - Wien bleibt solidarisch!</h3>	  
	  <h2 class="juni">20. Juni - Weltflüchtlingstag</h2>
   </div>
  <div class="col s12 center-align">
      <button class="btn waves-effect waves-light" id="showEventsForm">Tragt euer <span style="text-transform: none;">WELCOMEoida</span>-Event ein!</button>
	  <h4 class="blued rotateText"  style="font-size: 1.7em; margin-top: 20px;">Feste, Filme, Kochen, Treffen, Konzerte, Sportveranstaltungen, Diskussionen, Parties, Lesungen, Performances, Theater</h4>      
  </div>
</div>
<div class="row relative">
@include('includes.forms.solidarisch')
@include('includes.forms.events')
</div>
<div class="map_wrapper">
  <div id="wo_map" class="map"></div>
  <div class="map_overlay">
    <div class="info">
      Klick auf die Karte zum aktivieren
    </div>
  </div>
</div>
<div class="container mt1">
<div class="row">
  <div class="col s12 m12">
      <!-- @include('includes.banner') -->
      @include('pages.public.partials.was-wir-tun')
  </div>
  <div class="col s12 m12">
    <!-- a href="#modalPartner" class="modal-trigger btn big waves-effect waves-light">Partnerin werden</a -->
    <br> <br>
  <!-- div class="row">
    <div class="col s6 m3">
	    <h2>Netzwerk</h2>
	     <br>
	    <img src="http://www.fokuskind.com/files/design/FOKUSKINDMedien-Logo.png" />
    </div -->
    @foreach($partners as $partner)
      <div class="col s6 m3">	      
        <a href="http://{{ $partner->url}}" target="_blank">
          <img src="{{ $partner->image->path}}" />
        </a>
      </div>
    @endforeach
  </div>
    </div>
</div>
</div>
<div id="modalPartner" class="modal">
  <div class="modal-content">
    @include('includes.forms.partner')
  </div>
  <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Schließen</a>
  </div>
</div>

    <!-- Hier ist der Footer --> 
      <div class="row">        
	      <div class="col m12 s12">
		      <div class="copyright">
			      &copy;2016 - NewHere.
		      </div>
	      </div>
      </div>	

@stop

@section('scriptPluginsPre')

@stop
@section('scripts')
<!--<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.js'></script>-->

 {!! Html::script('/js/map.js') !!}
@stop
