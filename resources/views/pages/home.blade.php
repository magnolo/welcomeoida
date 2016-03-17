@extends('layouts.main')
@section('head')
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.css' rel='stylesheet' />
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
<div class="row relative">
<div id="wo_map"></div>
<div class="row form z-depth-1" id="solidarischForm">
    <div class="row">
    <p class="col s12 center-align">Zeig uns, dass du dabei bist!</p>
  </div>
    <form id="solidarisch" >
      <div class="col s12">
      <div class="row">
      <div class="input-field col s12">
        <input type="text" minlength="3" required name="firstname" id="firstname" />
        <label>Vorname</label>
      </div>
    </div>
      <div class="row">
      <div class="input-field col s12">
        <input type="text" minlength="3" name="name" id="name" />
        <label>Nachname</label>
      </div>
    </div>
      <div class="row">
      <div class="input-field col s12">
        <input type="email" name="email" id="email" />
        <label>Email</label>
      </div>
    </div>
      <div class="row">
      <div class="input-field col s12">
        <input type="text" required name="location" minlength="3" class="location" id="location" />
        <label>Adresse</label>
      </div>
    </div>
  </div>
    <button class="waves-effect waves-light btn full" type="submit" >Ich bin solidarisch</button>
    </form>
</div>
<!--<div class="form styled" id="eventForm">
    <h3>Was planst du?</h3>
    <small>Erstelle dir einen Account um Events anzulegen</small>
    <div class="social-login">
        <small>Anmelden mit</small>
        <ul>
          <li>f</li>
          <li>t</li>
          <li>g+</li>
        </ul>
    </div>
    <form id="user">
      <div class="input-container">
        <label>Wer</label>
        <input type="text" placeholder="Wer*" minlength="3" required name="name" id="user_name" />
      </div>
      <div class="input-container">
        <label>Email</label>
        <input type="text" placeholder="Email*" minlength="3" required name="email" id="user_email" />
      </div>
      <div class="input-container">
        <label>Passwort</label>
        <input type="password" placeholder="Passwort*" minlength="3" required name="password" id="user_password" />
      </div>
    </form>
    <form id="event">
      <div class="input-container">
        <label>Name des Events</label>
        <input type="text" placeholder="Name des Events*" minlength="3" required name="eventname" id="event_name" />
      </div>
      <div class="input-container">
        <label>Adresse</label>
        <input type="text" placeholder="Adresse*" minlength="3" required class="location" name="eventlocation" id="event_location" />
      </div>
      <div class="input-container">
        <label>Uhrzeit</label>
        <input type="text" placeholder="Uhrzeit*" minlength="3" required  name="eventlocation" id="event_location" />
      </div>
      <div class="input-container">
        <label>Beschreibung</label>
        <textarea placeholder="Beschreibung*" minlength="3" required name="eventlocation" id="event_location"></textarea>
      </div>
       <div class="g-recaptcha" data-sitekey="your_site_key"></div>
    </form>
  </div>-->
</div>
@stop
@section('scripts')
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.js'></script>
 {!! Html::script('/js/map.js') !!}
@stop
