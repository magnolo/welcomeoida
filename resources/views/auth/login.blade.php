@extends('layouts.main')
@section('content')
        @include('includes.status')
          <div class="row form">
            <div class="col s12 m6 l4 offset-l4 offset-m3">
              @include('includes.forms.login')
            </div>
          </div>
@stop
