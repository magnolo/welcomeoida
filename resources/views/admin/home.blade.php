@extends('layouts.main')
@section('head')
@stop
@section('content')
<div ng-app="wo">
<div class="container ng-cloak" ng-controller="AdminController as vm" ng-init="vm.loggedUser == {{ Auth::user()->id}}">
<div class="row">
  <h3 class="col s12">Admin</h3>
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;" ng-if="vm.selection.length > 0">
      <span> @{{ vm.selection.length }} items </span>
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
     <div class="row ">
       <div class="input-field col s12 m6 l4 ">
         <i class="material-icons prefix">search</i>
         <input id="icon_prefix" type="text" ng-model="vm.peopleSearch" class="validate">
         <label for="icon_prefix">Suchen</label>
       </div>
       <div class="col s12 m6 l4">
         &nbsp;
       </div>
       <div class="col s12 m6 l4">
         <label>Anzeige</label>
          <select class="browser-default" ng-model="vm.searchLimit">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="">Alle</option>
          </select>
       </div>
     </div>
     <div class="row">
       <div class="col s12">
          @{{ (vm.pois | filter:{type_id: 1}).length }} Einträge |
          @{{ vm.personFilter.length }} durch Filter |
          @{{ vm.selection.length}} ausgewählt
        </div>
     </div>
     <table class="striped display ">
        <thead>
          <tr>
              <th><span><input ng-click="vm.selectAll(vm.personFilter)" ng-model="vm.selectedAllPersons" type="checkbox" id="select_all_persons" class="filled-in" />
                   <label for="select_all_persons"></label></span></th>
              <th class="added">
                <a href="#" ng-click="vm.sortType = 'created_at'; vm.sortReverse = !vm.sortReverse">
                  Hinzugefügt
                  <span ng-show="vm.sortType == 'created_at' && !vm.sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="vm.sortType == 'created_at' && vm.sortReverse" class="fa fa-caret-up"></span>
                </a>
              </th>
              <th ><a href="#" ng-click="vm.sortType = 'title'; vm.sortReverse = !vm.sortReverse">
                Anzeige
                <span ng-show="vm.sortType == 'title' && !vm.sortReverse" class="fa fa-caret-down"></span>
                <span ng-show="vm.sortType == 'title' && vm.sortReverse" class="fa fa-caret-up"></span>
              </a></th>
              <th>Name</th>
              <th><a href="#" ng-click="vm.sortType = 'email'; vm.sortReverse = !vm.sortReverse">
                Email
                <span ng-show="vm.sortType == 'email' && !vm.sortReverse" class="fa fa-caret-down"></span>
                <span ng-show="vm.sortType == 'email' && vm.sortReverse" class="fa fa-caret-up"></span>
              </a></th>
              <th><a href="#" ng-click="vm.sortType = 'is_public'; vm.sortReverse = !vm.sortReverse">
                Öffentlich
                <span ng-show="vm.sortType == 'is_public' && !vm.sortReverse" class="fa fa-caret-down"></span>
                <span ng-show="vm.sortType == 'is_public' && vm.sortReverse" class="fa fa-caret-up"></span>
              </a></th>
              <th data-field="ip">IP</th>
          </tr>
        </thead>
        <tbody>

           <tr ng-repeat="person in (vm.personFilter = (vm.pois | filter:{type_id: 1} | filter:vm.peopleSearch | orderBy:vm.sortType:vm.sortReverse | limitTo:vm.searchLimit))">
             <td><span><input type="checkbox" id="check_@{{ person.id}}" ng-model="person.selected" ng-click="vm.toggleSelected(person)" class="filled-in" ng-checked="vm.isSelected(person)"/>
                  <label for="check_@{{ person.id}}"></label></span></td>
             <td><small am-time-ago="person.created_at"></small></td>
             <td>@{{ person.title }}</td>
             <td>@{{ person.first_name + " " + person.last_name }}</td>
             <td>@{{ person.email}}</td>
             <td><div class="switch">
                <label>
                  <input type="checkbox" ng-change="vm.updatePoi(person)" ng-true-value="1" ng-false-value="0" ng-model="person.is_public">
                  <span class="lever"></span>
                </label>
              </div></td>
             <td ng-click="vm.peopleSearch = person.ip_address"><small>@{{ person.ip_address }}</small></td>
           </tr>

       </tbody>
     </table>
   </div>
   <div id="events" class="col s12">
     <div class="row ">
       <div class="input-field col s12 m6 l4 ">
         <i class="material-icons prefix">search</i>
         <input id="icon_prefix" type="text" ng-model="vm.eventSearch" class="validate">
         <label for="icon_prefix">Suchen</label>
       </div>
       <div class="col s12 m6 l4">
         &nbsp;
       </div>
       <div class="col s12 m6 l4">
         <label>Anzeige</label>
          <select class="browser-default" ng-model="vm.searchLimit">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="">Alle</option>
          </select>
       </div>
     </div>
     <div class="row">
       <div class="col s6">
          @{{ (vm.pois | filter:{type_id: 2}).length }} Einträge |
          @{{ vm.eventFilter.length }} durch Filter |
          @{{ vm.selection.length}} ausgewählt
        </div>
        <div class="col s6 right-align">
          <div class="switch">
             <label>
              <input type="checkbox"  ng-true-value="true" ng-false-value="false" ng-model="vm.showDescriptions">
               <span class="lever"></span>
               Beschreibungen
             </label>
           </div>
        </div>
     </div>
     <table class="striped display" >
        <thead>
          <tr>
            <th><span><input ng-change="vm.selectAll(vm.eventFilter)" ng-model="vm.selectedAllEvents" type="checkbox" id="select_all_events" class="filled-in" />
                 <label for="select_all_events"></label></span></th>
              <th class="added">
                <a href="#" ng-click="vm.sortType = 'created_at'; vm.sortReverse = !vm.sortReverse">
                  Hinzugefügt
                  <span ng-show="vm.sortType == 'created_at' && !vm.sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="vm.sortType == 'created_at' && vm.sortReverse" class="fa fa-caret-up"></span>
                </a>
              </th>
              <th>Bild</th>
              <th ><a href="#" ng-click="vm.sortType = 'title'; vm.sortReverse = !vm.sortReverse">
                Titel
                <span ng-show="vm.sortType == 'title' && !vm.sortReverse" class="fa fa-caret-down"></span>
                <span ng-show="vm.sortType == 'title' && vm.sortReverse" class="fa fa-caret-up"></span>
              </a></th>
              <th>
                <a href="#" ng-click="vm.sortType = 'from_date'; vm.sortReverse = !vm.sortReverse">
                  von
                  <span ng-show="vm.sortType == 'from_date' && !vm.sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="vm.sortType == 'from_date' && vm.sortReverse" class="fa fa-caret-up"></span>
                </a>
              </th>
              <th>
                <a href="#" ng-click="vm.sortType = 'to_date'; vm.sortReverse = !vm.sortReverse">
                  bis
                  <span ng-show="vm.sortType == 'to_date' && !vm.sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="vm.sortType == 'to_date' && vm.sortReverse" class="fa fa-caret-up"></span>
                </a>
              </th>
              <th><a href="#" ng-click="vm.sortType = 'is_public'; vm.sortReverse = !vm.sortReverse">
                Öffentlich
                <span ng-show="vm.sortType == 'is_public' && !vm.sortReverse" class="fa fa-caret-down"></span>
                <span ng-show="vm.sortType == 'is_public' && vm.sortReverse" class="fa fa-caret-up"></span>
              </a></th>
              <th><a href="#" ng-click="vm.sortType = 'user.last_name'; vm.sortReverse = !vm.sortReverse">
                Benutzer
                <span ng-show="vm.sortType == 'user.last_name' && !vm.sortReverse" class="fa fa-caret-down"></span>
                <span ng-show="vm.sortType == 'user.last_name' && vm.sortReverse" class="fa fa-caret-up"></span>
              </a></th>
              <th >IP</th>
          </tr>
        </thead>
        <tbody>

          <tr ng-repeat="event in vm.eventFilter = (vm.pois | filter:{type_id: 2}  | filter:vm.eventSearch | orderBy:vm.sortType:vm.sortReverse | limitTo: vm.searchLimit)">

            <td><span><input type="checkbox" id="check_@{{ event.id}}" ng-model="event.selected" ng-click="vm.toggleSelected(event)" class="filled-in" ng-checked="vm.isSelected(event)"/>
                 <label for="check_@{{ event.id}}"></label></span></td>
            <td ><small am-time-ago="event.created_at"></small></td>
            <td><img style="max-height:50px; max-width:50px" ng-src="@{{ event.image.path}}" /></td>
            <td>@{{ event.title }} <br /><small><strong>@{{ event.address }}</strong></small><div class="description" ng-if="event.description" ng-show="vm.showDescriptions">@{{ event.description}}</div></td>
            <td>@{{event.from_date | amDateFormat:'HH:mm'}}</td>
            <td>@{{event.to_date | amDateFormat:'HH:mm'}}</td>
            <td><div class="switch">
               <label>
                <input type="checkbox" ng-change="vm.updatePoi(event)" ng-true-value="1" ng-false-value="0" ng-model="event.is_public">
                 <span class="lever"></span>
               </label>
             </div></td>
             <td>@{{ event.user.first_name + " " + event.user.last_name}}</td>
            <td ng-click="vm.eventSearch = event.ip_address"><small>@{{ event.ip_address }}</small></td>
          </tr>
       </tbody>
     </table>
   </div>
   <div id="partners" class="col s12">
     <table class="striped display">
        <thead>
          <tr>
            <!--<th><span><input type="checkbox" id="select_all_partners" class="filled-in" ng-checked="" />
                 <label for="select_all_partners"></label></span></th>-->
              <th data-field="id">Erstellt</th>
              <th></th>
              <th data-field="data">Name</th>
              <th data-field="data">Email</th>
              <th data-field="data">Org.</th>
              <th data-field="user">Öffentlich</th>

          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="partner in vm.partners">
              <!--<td>
                <span><input type="checkbox" id="checkuser_@{{ partner.id}}" ng-model="partner.selected"  class="filled-in" />
                     <label for="checkuser_@{{ partner.id}}"></label></span>
              </td>-->
              <td am-time-ago="partner.created_at"></td>
                <td><img style="max-height:50px; max-width:50px" ng-src="@{{ partner.image.path}}" /></td>
              <td>@{{ partner.name }}</td>
              <td>@{{ partner.email }}</td>
              <td>@{{ partner.organisation }}</td>
              <td>
                <div class="switch">
                   <label>
                     <input type="checkbox" ng-change="vm.updatePartner(partner)" ng-true-value="1" ng-false-value="0" ng-model="partner.is_public">
                     <span class="lever"></span>
                   </label>
                 </div>
              </td>
          </tr>
        </tbody>
      </table>
   </div>
   <div id="users" class="col s12">
     <table class="striped display">
        <thead>
          <tr>
            <th><span><input type="checkbox" id="select_all_events" class="filled-in" ng-checked="" />
                 <label for="select_all_events"></label></span></th>
              <th data-field="id">Erstellt</th>
              <th></th>
              <th data-field="data">Name</th>
              <th data-field="user">Rechte</th>

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
        </tbody>
      </table>
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
