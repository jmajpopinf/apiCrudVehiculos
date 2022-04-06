app.controller('loginController', function ($scope, $http, $location, $rootScope) {

   $scope.home = function(username, password){
       $http.get('http://localhost:8080/angularJsCrud/api/usuarios?usuario='+username+'&contrasena='+password+'&action='+ '1').then(data =>{
           if(data.data.datos.length > 0){
               localStorage.setItem('usuario', data.data.datos[0].usuario);
               localStorage.setItem('idUsuario', data.data.datos[0].idUsuario);
                $location.path('/home');
                //console.log(data)
               
           }else{
               alert('Datos incorrectos');

           }
       })
   }
});