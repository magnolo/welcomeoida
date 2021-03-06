<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <title>#welcomeoida</title>
    <meta property="og:title" content="welcomeoida">
    <meta property="og:site_name" content="#welcomeoida">
    <meta property="og:url" content="http://www.welcomeoida.at/">
    <meta property="og:description" content="Wir sind New Here. und sagen WELCOMEoida. Seit dem vergangenen Sommer trägt die Zivilgesellschaft in Wien entscheidend zur Versorgung und Betreuung von geflüchteten Menschen bei. Damit hat sie wesentlichen Anteil daran, dass Schutzsuchende eine menschenwürdige Aufnahme in unserer Stadt finden.">
    <meta property="fb:app_id" content="1698074447072192">
    <meta property="og:type" content="website">
    <meta property="og:image" content="http://www.welcomeoida.at/images/welcomeOidaLogoBig.png"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Sarala:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/layout.css') !!}">
    @yield('head')
  </head>
  <body class="overflow-none {{ Route::current()->getName() == 'admin.home' ? ' admin' : '' }}">
    @include('layouts.nav')

    @yield('content')
    <div id="modalLogin" class="modal">
      <div class="modal-content">
        @include('includes.forms.login')
      </div>
      <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Schließen</a>
      </div>
    </div>
    <div id="loader">
      <div class="preloader-wrapper big active">
    <div class="spinner-layer spinner-blue-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>
    </div>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-27873180-9', 'auto');
      ga('send', 'pageview');

    </script>
    @yield('scriptPluginsPre')
    <script src="http://cdn.leafletjs.com/leaflet/v1.0.0-beta.2/leaflet.js"></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src="{!! asset('js/vendor.js') !!}"></script>
    <script src="/js/locale/de-at.js"></script>
    @yield('scriptPlugins')
    <script src="{!! asset('js/app.js') !!}"></script>
    @yield('scripts')
    @yield('scriptsPost')
    {{--livereload--}}
    @if ( env('APP_ENV') === 'local' )
    <script type="text/javascript">
        document.write('<script src="'+ location.protocol + '//' + (location.host.split(':')[0] || 'localhost') +':35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
    </script>
    @endif
  </body>
</html>
