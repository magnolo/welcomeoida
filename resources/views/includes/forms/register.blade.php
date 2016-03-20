{!! Form::open(['url' => route('auth.register-post') , 'class' => 'validate-me'] ) !!}

<div class="row">
<h2 class="col s1">Registrierung</h2>
</div>
<div class="row">
<div class="input-field col s12">
  {!! Form::email('email', null, [
      'required',
      'id'                            => 'inputEmail',
  ]) !!}
  <label for="inputEmail">Email</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">
  {!! Form::text('first_name', null, [
      'required',
      'id'                            => 'inputFirstName',
  ]) !!}
  <label for="inputFirstName">Vorname</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">
    {!! Form::text('last_name', null, [
        'required',
        'id'                            => 'inputLastName',
    ]) !!}
    <label for="inputLastName">Nachname</label>
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
<div class="input-field col s12">
  {!! Form::password('password_confirmation', [
      'required',
      'id'                            => 'inputPasswordConfirm',
  ]) !!}
  <label for="inputPasswordConfirm" class="sr-only has-warning">Passwort wiederholen</label>
</div>
</div>
<div class="row">
  <div class="col s12">
{!! app('captcha')->display(); !!}
</div>
</div>
<div class="row">
  <div class=" col s12 right-align">
<button class="btn btn-lg btn-primary btn-block register-btn" type="submit">Registrieren</button>
</div>
</div>
{!! Form::close() !!}
@include('includes.forms.socials')
