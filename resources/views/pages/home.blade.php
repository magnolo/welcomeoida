@extends('layouts.main')
@section('head')
    <!--<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.css' rel='stylesheet' />-->
@stop
@section('content')
<div class="row center-align block">
  <div class="col s12">
  <h2>20. Juni</h2>
  <h2 class="green-text text-lighten-3">Weltflüchtlingstag</h2>
  <h1><span class="green-text text-lighten-3">#</span>welcome<span class="green-text text-lighten-3">oida</span></h1>
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
<div id="wo_map"></div>
</div>
@stop
@section('scripts')
<!--<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.js'></script>-->
 {!! Html::script('/js/map.js') !!}
@stop
