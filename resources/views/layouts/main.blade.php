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
    @include('layouts.nav')
    <div class="row" id="usermenu">
        <div class="col s12 ">
        @if(!Auth::check())
        <ul class="pull-right">

               <li><a href="#modalLogin" class="modal-trigger">Login</a></li>


        </ul>
        @else

        <a class='dropdown-button btn-flat pull-right' href='#' data-activates='dropdown1'>Account</a>

        <!-- Dropdown Structure -->
        <ul id='dropdown1' class='dropdown-content'>
          <!--<li><a href="#">Profil</a></li>-->
          <li><a href="{{ route('user.events') }}">Events</a></li>
          @if(Auth::user()->hasRole("administrator"))
            <li><a href="{{ route('admin.home') }}">Admin</a></li>
         @endif

          <li class="divider"></li>
          <li><a href="{{ route('authenticated.logout') }}">Logout</a></li>
        </ul>
        @endif
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
