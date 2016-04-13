<header>
<nav>
  <div class="nav-wrapper green lighten-3">
    <!--<a href="#!" class="left brand-logo">Logo</a>-->
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="left hide-on-med-and-down">
      <li><a href="/" class="orange-text text-darken-4">Home</a></li>
      <li><a href="{{ route('page',['page' => 'ueberuns']) }}" class="orange-text text-darken-4">Über uns</a></li>
      <li><a href="{{ route('page',['page' => 'newhere']) }}" class="orange-text text-darken-4">New Here.</a></li>    
      <li><a href="{{ route('page',['page' => 'team']) }}" class="orange-text text-darken-4">Team</a></li>
      <li><a href="{{ route('page',['page' => 'partnerinnen']) }}" class="orange-text text-darken-4">PartnerInnen</a></li>      
      <li><a href="{{ route('page',['page' => 'aktiv-werden']) }}" class="orange-text text-darken-4">Aktiv werden</a></li>      
      <!-- li><a href="{{ route('page',['page' => 'presse']) }}" class="orange-text text-darken-4">Presse</a></li -->
      <li><a href="{{ route('page',['page' => 'downloads']) }}" class="orange-text text-darken-4">Downloads</a></li>
      <!-- li><a href="{{ route('page',['page' => 'unterstuetzerInnen']) }}" class="orange-text text-darken-4">UnterstützerInnen</a></li -->
    </ul>
    <ul class="right hide-on-med-and-down">
      <li></li>
      <li><a href="https://www.facebook.com/events/1140455429322099/" target="_blank" class="icon"><i class="fa fa-facebook"></i></a></li>
      <li><a href="badges.html" class="icon"><i class="fa fa-twitter"></i></a></li>
      <li><a href="collapsible.html" class="icon"><i class="fa fa-google"></i></a></li>
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <li><a href="/" class="orange-text text-darken-4">Home</a></li>
      <li><a href="{{ route('page',['page' => 'ueberuns']) }}" class="orange-text text-darken-4">Über uns</a></li>
      <li><a href="{{ route('page',['page' => 'newhere']) }}" class="orange-text text-darken-4">New Here.</a></li>       
      <li><a href="{{ route('page',['page' => 'team']) }}" class="orange-text text-darken-4">Team</a></li>
      <li><a href="{{ route('page',['page' => 'partnerinnen']) }}" class="orange-text text-darken-4">PartnerInnen</a></li>
      <li><a href="{{ route('page',['page' => 'aktiv-werden']) }}" class="orange-text text-darken-4">Aktiv werden</a></li>  
      <!-- li><a href="{{ route('page',['page' => 'presse']) }}" class="orange-text text-darken-4">Presse</a></li-->
      <li><a href="{{ route('page',['page' => 'downloads']) }}" class="orange-text text-darken-4">Downloads</a></li>
      <!--li><a href="{{ route('page',['page' => 'unterstuetzerInnen']) }}" class="orange-text text-darken-4">UnterstützerInnen</a></li -->
    </ul>
  </div>
</nav>
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
</header>
<div class="container">

  <div class="row">
  <div class="center-align logo">
    <a href="http://test.welcomeoida.at/"><img src="http://www.craftandvalue.com/_welcomeOida/welcomeOidaLogo.png" /></a>
  </div>

    <!--<div class="col s12 center-align navtwo">
  <a href="https://www.facebook.com/New-Here-1671751599752159/?fref=ts" class="button">Join us on Facebook</a>
  <a href="https://twitter.com/welcomeoida_at" class="button">Follow us on Twitter</a>
  <a href="mailto:hallo@welcomeoida.at" class="button">E-Mail us!</a>
  <a href="http://test.welcomeoida.at/aktiv-werden" class="button">Get involved!</a>
</div>-->
  </div>
</div>
