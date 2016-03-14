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
      <div id="wo_map"></div>
      <div class="form styled">
          <h3>Zeig uns, dass du dabei bist!</h3>
          <form id="solidarisch" >
              <div class="input-container">
              <label>Name</label>
              <input type="text" placeholder="Name" name="name" id="name" />
            </div>
              <div class="input-container">
              <label>Email</label>
              <input type="email" placeholder="Email" name="email" id="email" />
            </div>
            <div class="input-container">
              <label>Adresse</label>
              <input type="text" placeholder="Adresse" name="address" id="address" />
            </div>
            <button class="btn" type="submit">Ich bin solidarisch</button>
          </form>
      </div>
      <script src="{!! asset('js/vendor.js') !!}"></script>
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
