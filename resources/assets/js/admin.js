(function() {
  angular.module('wo', ['angularMoment'])
    .run(function(amMoment) {
      amMoment.changeLocale('de-at');
    })
    .filter('as', function($parse){
      return function(value, context, path){
        return $parse(path).assign(context, value);
      }
    })
    .directive('materialboxed', function($timeout){
      return {
        restrict:'A',
        link: function(scope, elem){
          $timeout(function(){
              elem.materialbox();
          })

        }
      }
    })
    .controller('AdminController', function($http) {
      var vm = this;

      vm.pois = [], vm.users = [], vm.roles = [], vm.selection = [], vm.partners = [];
      vm.sortType     = 'created_at'; // set the default sort type
      vm.sortReverse  = true;  // set the default sort order
      vm.searchLimit = "25";
      vm.updatePoi = updatePoi;
      vm.selectAll = selectAll;
      vm.isSelected = isSelected;
      vm.toggleSelected = toggleSelected;
      vm.bulkPublic = bulkPublic;
      vm.deleteItems = deleteItems;
      vm.hasRole = hasRole;
      vm.setUserRole = setUserRole;
      vm.updatePartner = updatePartner;

      activate();

      function activate() {
        $http.get('/api/admin/pois').then(function success(response) {
          vm.pois = response.data;
        }, function error(response) {

        });
        $http.get('/api/admin/users').then(function success(response) {
          vm.users = response.data;
        }, function error(response) {

        });
        $http.get('/api/admin/roles').then(function success(response) {
          vm.roles = response.data;
        }, function error(response) {

        });
        $http.get('/api/admin/partners').then(function success(response) {
          vm.partners = response.data;
        }, function error(response) {

        });
      }

      function updatePoi(item) {
        $http.put('/api/admin/pois/' + item.id, item).then(function(response) {
          Materialize.toast(item.title + " gespeichert!", 2000);
        }, function(response) {

        });
      }

      function updatePartner(partner) {
        $http.put('/api/admin/partners/' + partner.id, partner).then(function(response) {
          Materialize.toast(partner.name + " gespeichert!", 2000);
        }, function(response) {

        });
      }

      function isSelected(item) {
        if (vm.selection.indexOf(item) != -1) {
          return true;
        }
        return false;
      }

      function toggleSelected(item) {
        if (isSelected(item)) {
          vm.selection.splice(vm.selection.indexOf(item), 1);
        } else {
          vm.selection.push(item);
        }
      }

      function selectAll(items) {
        angular.forEach(items, function(item) {
          //if (item.type_id == type_id) {
            toggleSelected(item);
          //}

        });
      }

      function bulkPublic(isPublic) {
        var ids = [];
        angular.forEach(vm.selection, function(item) {
          ids.push(item.id);
        });
        $http.put('/api/admin/pois/public', {
          is_public: isPublic,
          ids: ids
        }).then(function(response) {
          Materialize.toast(ids.length + " Einträge gespeichert!", 2000);
          angular.forEach(vm.selection, function(item) {
            item.is_public = isPublic ? 1 : 0;
          })
        });
      }

      function deleteItems() {
        var ids = [];
        angular.forEach(vm.selection, function(item) {
          ids.push(item.id);
        });
        $http.patch('/api/admin/pois', {
          ids: ids
        }).then(function(response) {
          Materialize.toast(ids.length + " Einträge gelöscht!", 2000);
          angular.forEach(vm.selection, function(item, key) {
            //vm.selection.splice(key,1 );
            vm.pois.splice(vm.pois.indexOf(item), 1);
          })
        });
      }

      function hasRole(id, user) {
        var found = false;
        angular.forEach(user.roles, function(role) {
          if (role.id == id) {
            found = true;
          }
        });
        return found;
      }

      function setUserRole(id, user) {
        $http.put('/api/admin/users/' + user.id + '/role', {
          roleId: id
        }).then(function(response) {
          Materialize.toast(user.first_name + " " + user.last_name + " ist nun " + response.data.name, 2000);
        });
      }

    })
})();
