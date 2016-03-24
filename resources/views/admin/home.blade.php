@extends('layouts.main')
@section('head')
@stop
@section('content')
<div ng-app="wo">
<div class="container" ng-controller="AdminController as vm" ng-init="vm.loggedUser == {{ Auth::user()->id}}">
<div class="row">
  <h2 class="col s12">Admin @{{ vm.loggedUser }}</h3>
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;" ng-if="vm.selection.length > 0">
      <span>  @{{ vm.selection.length }} items </span>
      <a class="btn-floating btn-large red">
        <i class="large material-icons">mode_edit</i>

      </a>
      <br>

      <ul>
        <li><a class="btn-floating red" title="Löschen"  ng-click="vm.deleteItems()"><i class="material-icons">delete</i></a></li>
        <li><a class="btn-floating green" title="öffentlich " ng-click="vm.bulkPublic(true)"><i class="material-icons">lock_open</i></a></li>
        <li><a class="btn-floating yellow darken-1 " title="Nicht öffentlich"  ng-click="vm.bulkPublic(false)"><i class="material-icons">lock_outline</i></a></li>
      </ul>
    </div>
</div>
<div class="row">
   <div class="col s12">
     <ul class="tabs">
       <li class="tab col s3"><a class="active"href="#solidarisch">Solidarisch</a></li>
       <li class="tab col s3"><a href="#events">Veranstaltungen</a></li>
       <li class="tab col s3"><a href="#partners">Partner</a></li>
       <li class="tab col s3"><a href="#users">User</a></li>
     </ul>
   </div>
   <div id="solidarisch" class="col s12">


     <table class="striped display">
        <thead>
          <tr>
              <th><span><input ng-change="vm.selectAll(1)" ng-model="vm.selectedAllPersons" type="checkbox" id="select_all_persons" class="filled-in" />
                   <label for="select_all_persons"></label></span></th>
              <th data-field="data">Hinzügefügt</th>
              <th data-field="title">Anzeige</th>
              <th data-field="name">Name</th>
              <th data-field="email">Email</th>
              <th data-field="public">Öffentlich</th>
              <th data-field="ip">IP</th>
          </tr>
        </thead>
        <tbody>

           <tr ng-repeat="person in vm.pois | filter:{type_id: 1} | orderBy: vm.order">
             <td><span><input type="checkbox" id="check_@{{ person.id}}" ng-model="person.selected" ng-change="vm.toggleSelected(person)" class="filled-in" ng-checked="vm.isSelected(person)"/>
                  <label for="check_@{{ person.id}}"></label></span></td>
             <td am-time-ago="person.created_at"></td>
             <td>@{{ person.title }}</td>
             <td>@{{ person.first_name + " " + person.last_name }}</td>
             <td>@{{ person.email}}</td>
             <td><div class="switch">
                <label>
                  <input type="checkbox" ng-change="vm.updatePoi(person)" ng-true-value="1" ng-false-value="0" ng-model="person.is_public">
                  <span class="lever"></span>
                </label>
              </div></td>
             <td>@{{ person.ip_address }}</td>
           </tr>

       </tbody>
     </table>
   </div>
   <div id="events" class="col s12">
     <table class="striped display" >
        <thead>
          <tr>
            <th><span><input ng-change="vm.selectAll(2)" ng-model="vm.selectedAllEvents" type="checkbox" id="select_all_events" class="filled-in" />
                 <label for="select_all_events"></label></span></th>
              <th data-field="id">Erstellt</th>
              <th></th>
              <th data-field="data">Title</th>
              <th data-field="public">Public</th>
              <th data-field="ip">IP</th>
          </tr>
        </thead>
        <tbody>

          <tr ng-repeat="event in vm.pois | filter:{type_id: 2}">

            <td><span><input type="checkbox" id="check_@{{ event.id}}" ng-model="event.selected" ng-change="vm.toggleSelected(event)" class="filled-in" ng-checked="vm.isSelected(event)"/>
                 <label for="check_@{{ event.id}}"></label></span></td>
            <td am-time-ago="event.created_at"></td>
            <td><img style="max-height:50px; max-width:50px" ng-src="@{{ event.image.path}}" /></td>
            <td>@{{ event.title }}</td>
            <td><div class="switch">
               <label>
                <input type="checkbox" ng-change="vm.updatePoi(event)" ng-true-value="1" ng-false-value="0" ng-model="event.is_public">
                 <span class="lever"></span>
               </label>
             </div></td>
            <td>@{{ event.ip_address }}</td>
          </tr>
       </tbody>
     </table>
   </div>
   <div id="partners" class="col s12">Test 3</div>
   <div id="users" class="col s12">
     <table class="striped display">
        <thead>
          <tr>
            <th><span><input type="checkbox" id="select_all_events" class="filled-in" ng-checked="" />
                 <label for="select_all_events"></label></span></th>
              <th data-field="id">Erstellt</th>
              <th></th>
              <th data-field="data">Name</th>
              <th data-field="user">Rolle</th>

          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="user in vm.users">
              <td>
                <span><input type="checkbox" id="checkuser_@{{ user.id}}" ng-model="user.selected"  class="filled-in" />
                     <label for="checkuser_@{{ user.id}}"></label></span>
              </td>
              <td am-time-ago="user.created_at"></td>
              <td>@{{ user.first_name+" "+user.last_name}}</td>
              <td>@{{ user.email}}</td>
              <td>
                <p ng-repeat="role in vm.roles">
                    <input name="user_@{{user.id}}" type="radio" ng-click="vm.setUserRole(role.id, user)" ng-checked="vm.hasRole(role.id, user)" id="user_@{{user.id}}_role@{{role.id}}" />
                    <label for="user_@{{user.id}}_role@{{role.id}}">@{{ role.name}}</label>
                  </p>
              </td>
          </tr>
   </div>
 </div>
</div>
</div>
@stop

@section('scripts')
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-moment/0.10.3/angular-moment.js"></script>

 </script>
  {!! Html::script('/js/admin.js') !!}
@stop
