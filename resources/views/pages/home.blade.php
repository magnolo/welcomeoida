@extends('layouts.main')
@section('head')
    <!--<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.css' rel='stylesheet' />-->
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v1.0.0-beta.2/leaflet.css" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
@stop
@section('content')
<div class="row center-align block">
  <div class="col s12">
  <h2>20. Juni</h2>
  <h2 class="green-text text-lighten-3">Weltflüchtlingstag</h2>
  <!--<h1><span class="green-text text-lighten-3">#</span>welcome<span class="green-text text-lighten-3">oida</span></h1>-->
  <h4 class="blued rotateText">Konzert,Parties,Performances,Soli-Feste,Kinovorführungen,Theaterstücke,Lesungen,Wasserschlachten</h4>
</div>
</div>
<div class="row form" style="margin-bottom:3rem">
  <div class="col s12 center-align">
      <button class="btn waves-effect waves-light" id="showEventsForm">Planst du eine Aktion?</button>
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
  <div class="col s12 m5">
      @include('includes.banner')
      @include('pages.public.partials.was-wir-tun')
  </div>
  <div class="col s12 m7">
    <a href="#modalPartner" class="modal-trigger btn big waves-effect waves-light">Partner*in werden</a>
    <br> <br>
  <div class="row">
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
@stop

@section('scriptPluginsPre')

@stop
@section('scripts')
<!--<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.js'></script>-->

 {!! Html::script('/js/map.js') !!}
@stop
