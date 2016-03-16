<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <title>#welcomeoida</title>
    <link href='https://fonts.googleapis.com/css?family=Sarala:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
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
          <li>share this</li>
          <li><a href="sass.html"><i class="material-icons">facebook</i></a></li>
          <li><a href="badges.html"><i class="material-icons">menu</i></a></li>
          <li><a href="collapsible.html"><i class="material-icons">menu</i></a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="sass.html">Sass</a></li>
          <li><a href="badges.html">Components</a></li>
          <li><a href="collapsible.html">Javascript</a></li>
          <li><a href="mobile.html">Mobile</a></li>
        </ul>
      </div>
    </nav>
    <div class="row">
        <ul>
          @if(!Auth::check())
               <li><a href="{{ route('auth.login') }}">Login</a></li>
               <li><a href="{{ route('social.redirect', ['provider' => 'facebook']) }}">FB</a></li>
          @else
               <li><a href="#">{{ Auth::user()->first_name }}</a></li>
               <li><a href="{{ route('authenticated.logout') }}">Logout</a></li>
          @endif
        </ul>
    </div>
    <div id="loader">
      <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-red-only">
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
    @yield('content')
    @yield('scripts')
    <script src="{!! asset('js/vendor.js') !!}"></script>
    <script src="{!! asset('js/app.js') !!}"></script>

    {{--livereload--}}
    @if ( env('APP_ENV') === 'local' )
    <script type="text/javascript">
        document.write('<script src="'+ location.protocol + '//' + (location.host.split(':')[0] || 'localhost') +':35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
    </script>
    @endif
  </body>
</html>
