@extends('layouts.main')
@section('content')
@include('includes.status')
  <div class="row">
      <div class="col s12 m6 l4 offset-m3 offset-l4">
        {!! Form::open(['url' => route('auth.password-post'), 'class' => 'validate-me' ] ) !!}
        <h2 class="form-signin-heading">Passwort zurücksetzen</h2>
        <div class="input-field col s12">
        {!! Form::email('email', null, ['required', 'autofocus', 'id' => 'inputEmail' ]) !!}
        <label for="inputEmail" class="sr-only">Email address</label>
      </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sende mir einen Link</button>

        {!! Form::close() !!}
      </div>
@stop
