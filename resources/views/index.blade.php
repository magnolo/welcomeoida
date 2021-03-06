<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <title>#welcomeoida</title>
    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}">
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
  </head>
  <body>

      
      <div >
        <a href="https://www.facebook.com/events/1140455429322099/">FB</a>
        <a href="https://twitter.com/welcomeoida_at">Twitter</a>
      </div>
      <ul>
      @if(!Auth::check())

                @else
                logout
                @endif
      </ul>
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

      <script src="{!! asset('js/vendor.js') !!}"></script>
         <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.15.0/mapbox-gl.js'></script>
      <script src="{!! asset('js/app.js') !!}"></script>

    {{--livereload--}}
    @if ( env('APP_ENV') === 'local' )
    <script type="text/javascript">
        document.write('<script src="'+ location.protocol + '//' + (location.host.split(':')[0] || 'localhost') +':35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
    </script>
    @endif
  </body>
</html>
