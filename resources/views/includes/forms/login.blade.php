


{!! Form::open(array('route' => 'auth.login-post', 'class' => 'validate-me')) !!}

<div class="row">
  <div class="row">

<h2 class="col s12">LogIn</h2>
</div>
<div class="row">
<div class="input-field col s12 ">

{!! Form::email('email', null, [
    'required',
    'id'                            => 'inputEmail',
]) !!}
  <label for="inputEmail" >Email</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">

{!! Form::password('password', [
    'required',
    'id'                            => 'inputPassword',
]) !!}
<label for="inputPassword" >Passwort</label>
</div>
</div>
<div class="row">
<div class="col s12">
<button class="btn" type="submit">Anmelden</button>
</div>
</div>
<div class="row">
<div class="col s12 mt1"><a href="{{ route('auth.password') }}">Passwort vergessen?</a></div>

</div>
@include('includes.forms.socials')
<div class="row ">
<p class="col s12 ">
        {!! Form::checkbox('remember', true) !!}
           <label for="remember">Angemeldet bleiben</label>
</p>
</div>


<div class="row">
<div class="col s12"><a href="{{ route('auth.register') }}">Noch nicht registriert?</a></div>
</div>
<div class="row">
<div class="col s12"><a class="btn" href="{{ route('auth.register') }}">registrieren</a></div>
</div>


</div>
{!! Form::close() !!}
