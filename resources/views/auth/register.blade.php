@extends('layouts.main')
@section('content')
<div class="row">
  <div class="col s12 m6 offset-m3">
        {!! Form::open(['url' => route('auth.register-post'), 'class' => 'form-signin', 'data-parsley-validate' ] ) !!}

        @include('includes.errors')

        <h2 class="form-signin-heading">Please register</h2>

        <div class="input-field">
          {!! Form::email('email', null, [
              'class'                         => 'form-control',
              'required',
              'id'                            => 'inputEmail',
          ]) !!}
          <label for="inputEmail">Email address</label>
        </div>
        <div class="input-field">
        {!! Form::text('first_name', null, [
            'class'                         => 'form-control',
            'required',
            'id'                            => 'inputFirstName',
        ]) !!}
        <label for="inputFirstName" class="sr-only">First name</label>
      </div>
      <div class="input-field">
        {!! Form::text('last_name', null, [
            'class'                         => 'form-control',
            'required',
            'id'                            => 'inputLastName',
        ]) !!}
        <label for="inputLastName" class="sr-only">Last name</label>

      </div>
      <div class="input-field">
        {!! Form::password('password', [
            'class'                         => 'form-control',
            'required',
            'id'                            => 'inputPassword',
        ]) !!}
        <label for="inputPassword" class="sr-only">Password</label>

      </div>
      <div class="input-field">
        {!! Form::password('password_confirmation', [
            'class'                         => 'form-control',

            'required',
            'id'                            => 'inputPasswordConfirm',
        ]) !!}
        <label for="inputPasswordConfirm" class="sr-only has-warning">Confirm Password</label>
      </div>
        {!! app('captcha')->display(); !!}

        <button class="btn btn-lg btn-primary btn-block register-btn" type="submit">Register</button>

        <p class="or-social">Or Use Social Login</p>

        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-lg btn-primary btn-block facebook" type="submit">Facebook</a>
        <a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn btn-lg btn-primary btn-block twitter" type="submit">Twitter</a>
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg btn-primary btn-block google" type="submit">Google</a>

        {!! Form::close() !!}
      </div>
    </div>
@stop
@section('scriptPlugins')

@stop
