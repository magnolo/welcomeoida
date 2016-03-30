<nav>
  <div class="nav-wrapper green lighten-3">
    <!--<a href="#!" class="left brand-logo">Logo</a>-->
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="left hide-on-med-and-down">
      <li><a href="/" class="orange-text text-darken-4">Home</a></li>
      <li><a href="{{ route('page',['page' => 'ueberuns']) }}" class="orange-text text-darken-4">Über uns</a></li>
      <li><a href="{{ route('page',['page' => 'komitee']) }}" class="orange-text text-darken-4">Komitee</a></li>
      <li><a href="{{ route('page',['page' => 'presse']) }}" class="orange-text text-darken-4">Presse</a></li>
      <li><a href="{{ route('page',['page' => 'downloads']) }}" class="orange-text text-darken-4">Downloads</a></li>
      <li><a href="{{ route('page',['page' => 'unterstuetzerInnen']) }}" class="orange-text text-darken-4">Unterstützer*innen</a></li>
      <li><a href="{{ route('page',['page' => 'aktiv-werden']) }}" class="orange-text text-darken-4">Aktiv werden</a></li>
    </ul>
    <ul class="right hide-on-med-and-down">
      <li>share this&nbsp;</li>
      <li><a href="https://www.facebook.com/events/1140455429322099/" target="_blank" class="icon"><i class="fa fa-facebook"></i></a></li>
      <li><a href="badges.html" class="icon"><i class="fa fa-twitter"></i></a></li>
      <li><a href="collapsible.html" class="icon"><i class="fa fa-google"></i></a></li>
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <li><a href="/" class="orange-text text-darken-4">Home</a></li>
      <li><a href="{{ route('page',['page' => 'ueberuns']) }}" class="orange-text text-darken-4">Über uns</a></li>
      <li><a href="{{ route('page',['page' => 'komitee']) }}" class="orange-text text-darken-4">Komitee</a></li>
      <li><a href="{{ route('page',['page' => 'presse']) }}" class="orange-text text-darken-4">Presse</a></li>
      <li><a href="{{ route('page',['page' => 'downloads']) }}" class="orange-text text-darken-4">Downloads</a></li>
      <li><a href="{{ route('page',['page' => 'unterstuetzerInnen']) }}" class="orange-text text-darken-4">Unterstützer*innen</a></li>
      <li><a href="{{ route('page',['page' => 'aktiv-werden']) }}" class="orange-text text-darken-4">Aktiv werden</a></li>
    </ul>
  </div>
</nav>
