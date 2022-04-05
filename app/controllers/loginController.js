app.controller('loginController', function ($scope, $http, $location) {

   $scope.home = function(username, password){
       $http.get('http://localhost:8080/angularJsCrud/api/usuarios?usuario='+username+'&contrasena='+password+'&action='+ '1').then(data =>{
           if(data.data.datos.length > 0){
               $location.path('/home');
               $rootScope.userName=$scope.username;
           }else{
               alert('Datos incorrectos');

           }
       })
   }
});