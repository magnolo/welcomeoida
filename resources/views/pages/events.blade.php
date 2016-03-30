@extends('layouts.main')
@section('content')
<div class="container">
<div class="row">
  <h3 class="col s12">Meine Events</h3>
</div>

<div class="row">
  @each('partials.event', $events, 'event', 'partials.events-none')
</div>
<div class="row center-align">
{!! $events->links() !!}
</div>
</div>
@stop
