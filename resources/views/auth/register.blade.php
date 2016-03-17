@extends('layouts.main')
@section('content')
@include('includes.errors')

<div class="row form">
  <div class="col s12 m6 offset-m3">
        @include('includes.forms.register')
      </div>
    </div>
@stop
@section('scriptPlugins')

@stop
