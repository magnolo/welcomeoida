<div class="row">
<div class="col s12 center-align">
<p class="or-social center-align">oder Anmeldung über</p>

<a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn icon facebook" type="submit"><i class="fa fa-facebook"></i></a>
<a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn icon twitter" type="submit"><i class="fa fa-twitter"></i></a>
<a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn icon google" type="submit"><i class="fa fa-google"></i></a>
</div>
</div>
