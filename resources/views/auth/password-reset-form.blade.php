@extends('layouts.main')
@section('content')

        {!! Form::open(['url' => route('auth.reset-post', ['token' => $token ]), 'class' => 'validate-me' ] ) !!}

        @include('includes.errors')

        <h2 class="form-signin-heading">Erstelle ein neues Passwort</h2>
        <div class="input-field col s12">
        {!! Form::password('password', ['class' => 'form-control', 'required',  'id' => 'inputPassword', 'autofocus' ]) !!}
        <label for="inputPassword" class="sr-only">Passwort</label>
      </div>
        <div class="input-field  col s12">
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'required',  'id' => 'inputPasswordConfirmation' ]) !!}
          <label for="inputPasswordConfirmation" class="sr-only">Passwort wiederholen</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Change</button>

        {!! Form::close() !!}

@stop
