@extends('layouts.main')
@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" media="screen" title="no title" charset="utf-8">
@stop
@section('content')
<div class="container">
<div class="row">
  <h2 class="col s12">Admin</h3>
</div>
<div class="row">
   <div class="col s12">
     <ul class="tabs">
       <li class="tab col s4"><a class="active"href="#solidarisch">Solidarisch</a></li>
       <li class="tab col s4"><a href="#events">Veranstaltungen</a></li>
       <li class="tab col s4"><a href="#partners">Public</a></li>
     </ul>
   </div>
   <div id="solidarisch" class="col s12">
     <table class="dataTable striped display">
        <thead>
          <tr>
              <th data-field="id">Name</th>
              <th data-field="data">Date</th>
              <th data-field="public">Public</th>
              <th data-field="ip">IP</th>
          </tr>
        </thead>
        <tbody>
         @foreach($people as $person)
           <tr>
             <td>{{ $person->title}} </td>
             <td>{{ $person->created_at}} </td>
             <td><p><input type="checkbox" id="solid_{{$person->id}}" checked="checked" /></p></td>
             <td>{{ $person->ip_address}}</td>
           </tr>
         @endforeach
       </tbody>
     </table>
   </div>
   <div id="events" class="col s12">Test 2</div>
   <div id="partners" class="col s12">Test 3</div>
 </div>
</div>
@stop

@section('scripts')
  {!! Html::script('/js/admin.js') !!}
@stop
