<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <title>#welcomeoida</title>
    <link href='https://fonts.googleapis.com/css?family=Sarala:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    @yield('head')
  </head>
  <body class="overflow-none">
    <nav>
      <div class="nav-wrapper green lighten-3">
        <!--<a href="#!" class="left brand-logo">Logo</a>-->
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down">
          <li><a href="sass.html" class="orange-text text-darken-4">Über uns</a></li>
          <li><a href="badges.html" class="orange-text text-darken-4">Komitee</a></li>
          <li><a href="collapsible.html" class="orange-text text-darken-4">Presse</a></li>
          <li><a href="mobile.html" class="orange-text text-darken-4">Downloads</a></li>
          <li><a href="mobile.html" class="orange-text text-darken-4">Unterstützer*innen</a></li>
          <li><a href="mobile.html" class="orange-text text-darken-4">Aktiv werden</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li>share this&nbsp;</li>
          <li><a href="sass.html" class="icon"><i class="fa fa-facebook"></i></a></li>
          <li><a href="badges.html" class="icon"><i class="fa fa-twitter"></i></a></li>
          <li><a href="collapsible.html" class="icon"><i class="fa fa-google"></i></a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="sass.html">Sass</a></li>
          <li><a href="badges.html">Components</a></li>
          <li><a href="collapsible.html">Javascript</a></li>
          <li><a href="mobile.html">Mobile</a></li>
        </ul>
      </div>
    </nav>
    <div class="row" id="usermenu">
        <div class="col s12 ">

        <ul class="pull-right">

          @if(!Auth::check())
               <li><a href="#modalLogin" class="modal-trigger">Login</a></li>
          @else
               <li><a href="#">{{ Auth::user()->first_name }}</a></li>
               @if(Auth::user()->hasRole("administrator"))
                 <li><a href="{{ route('admin.home') }}">Admin</a></li>
              @endif
               <li><a href="{{ route('authenticated.logout') }}">Logout</a></li>
          @endif


        </ul>
      </div>
    </div>
    @yield('content')
    <div id="modalLogin" class="modal">
      <div class="modal-content">
        @include('includes.forms.login')
      </div>
      <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Schließen</a>
      </div>
    </div>

    @yield('scriptPluginsPre')
    <script src="http://cdn.leafletjs.com/leaflet/v1.0.0-beta.2/leaflet.js"></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src="{!! asset('js/vendor.js') !!}"></script>
  @yield('scriptPlugins')
    <script src="{!! asset('js/app.js') !!}"></script>
    @yield('scripts')
    {{--livereload--}}
    @if ( env('APP_ENV') === 'local' )
    <script type="text/javascript">
        document.write('<script src="'+ location.protocol + '//' + (location.host.split(':')[0] || 'localhost') +':35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
    </script>
    @endif
  </body>
</html>
