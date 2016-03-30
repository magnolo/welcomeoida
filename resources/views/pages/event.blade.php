@extends('layouts.main')
@section('head')
    <!--<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.css' rel='stylesheet' />-->
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v1.0.0-beta.2/leaflet.css" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
@stop

@section('content')
<div class="container" id="event" data-id="{{ $event->id }}">
  <div class="row">
    <h3 class="col s12"><a href="{{ route('user.events')}}">Meine Events</a> | {{ $event['title']}}</h3>
  </div>
  <div class="row form">
{!! Form::model($event, array('route' => ['user.event-update', $event['id']], 'method' => 'PUT', 'class' => 'validate-me')) !!}
        <div class="col s12 m4">

          <div class="dropzone needsclick dz-clickable" id="image-upload" style="background-image:url({{ $event->image->path}})">
            <div class="dz-message needsclick">
              <i class="fa fa-picture-o"></i><br />
              Eventfoto hochladen
            </div>
          </div>
          <div id="wo_map" class="map" style="height:350px"></div>
        </div>
        <div class="col s12 m8">

          <div class="row">
            <div class="input-field  col s12">
                  {!! Form::text('title', null) !!}
                  {!! Form::label('title', 'Titel') !!}
            </div>
          </div>
          <div class="row">
            <div class="input-field  col s12">

              {!! Form::textarea('description', null,  [
                  'required',
                  'class'                            => 'materialize-textarea',
                  'minlength' => 3
              ]) !!}
              {!! Form::label('description', 'Bechreibung') !!}
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              {!! Form::text('address', null,[
                  'required',
                  'class'                            => 'location',
                  'minlength' => 3
              ]) !!}
              {!! Form::label('address', 'Adresse') !!}
            </div>
          </div>
          <div class="row">
              <p class="col s12">Uhrzeit</p>
          </div>
          <div class="row">
            <div class="input-field  col s6">
              {!! Form::text('from_time', null,[
                  'required',
                  'class' => 'timeinput',
                  'minlength' => 3
              ]) !!}
              {!! Form::label('from_time', 'Von') !!}
            </div>
            <div class="input-field  col s6">
              {!! Form::text('to_time', null,[
                  'required',
                  'class' => 'timeinput',
                  'minlength' => 3
              ]) !!}
              {!! Form::label('to_time', 'Bis') !!}
            </div>
          </div>
          <div class="row">
              <p class="col s12">Kontaktangaben <small>(optional)</small></p>
          </div>
          <div class="row">
            <div class="input-field  col s12">
              {!! Form::text('phone', null,[
                  'minlength' => 3
              ]) !!}
              {!! Form::label('phone', 'Telefon') !!}
            </div>
          </div>
          <div class="row">
            <div class="input-field  col s12">
              {!! Form::text('url', null,[
                  'minlength' => 3
              ]) !!}
              {!! Form::label('url', 'Website') !!}
            </div>
          </div>
          <button class="waves-effect waves-light btn full" type="submit" >Speichern</button>
          {!! Form::hidden('location', null, [
            'id' => 'location'
          ]) !!}
          {!! Form::hidden('lat', null,[
            'id' => 'lat'
          ]) !!}
          {!! Form::hidden('lng', null,[
            'id' => 'lng'
          ]) !!}
          {!! Form::hidden('image_id', null,[
            'id' => 'image_id'
          ]) !!}
        </div>

  {!! Form::close() !!}
  </div>
</div>
@include('includes.status')
@include('includes.errors')
@stop
@section('scripts')
 {!! Html::script('/js/event.js') !!}
@stop
@section('scriptsPost')

@stop
