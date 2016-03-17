@extends('layouts.main')
@section('content')

      <div class="row">
          <div class="col s12 m6 offset-m3">

        {!! Form::open(array('route' => 'auth.login-post')) !!}

        @include('includes.status')

        <h2 class="form-signin-heading">Please sign in</h2>
        <div class="input-field">

        {!! Form::email('email', null, [
            'required',
            'id'                            => 'inputEmail',
        ]) !!}
          <label for="inputEmail" class="sr-only">Email address</label>
        </div>
        <div class="input-field">

        {!! Form::password('password', [
            'required',
            'id'                            => 'inputPassword',
        ]) !!}
        <label for="inputPassword" class="sr-only">Password</label>
      </div>
        <div class="checkbox">
            <label>
                {!! Form::checkbox('remember', 1) !!} Angemeldet bleiben

            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block login-btn" type="submit">Sign in</button>
        <p><a href="{{ route('auth.password') }}">Forgot password?</a></p>

        <p class="or-social">Or Use Social Login</p>

        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-lg btn-primary btn-block facebook" type="submit">Facebook</a>
        <a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn btn-lg btn-primary btn-block twitter" type="submit">Twitter</a>
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg btn-primary btn-block google" type="submit">Google</a>

        {!! Form::close() !!}
      </div>
    </div>
@stop
