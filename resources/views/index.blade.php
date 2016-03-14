<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>Me</title>
    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
  </head>
  <body>
    <div class="map"></map>
      <script src="{!! asset('js/vendor.js') !!}"></script>
      <script src="{!! asset('js/partials.js') !!}"></script>
      <script src="{!! asset('js/app.js') !!}"></script>
      {{--livereload--}}
    @if ( env('APP_ENV') === 'local' )
    <script type="text/javascript">
        document.write('<script src="'+ location.protocol + '//' + (location.host.split(':')[0] || 'localhost') +':35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
    </script>
    @endif
  </body>
</html>
