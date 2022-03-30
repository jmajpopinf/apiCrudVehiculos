var URL = "http://localhost:8080/angularJsCrud";
app.controller('PostController', function($scope,$http){

  //$scope.nombre = null;
  //$scope.dni = null;
  //$scope.correo = null;
  
    
    $scope.data = [];
 
  getResultsPage();
 
  function getResultsPage() {
    $http({
      url: URL + '/api/pacientes',
      method: 'GET'
    }).then(function(res){
      $scope.data = res.data;
    });
  }

  /* METODO ALTERNATIVO DELETE
  $scope.delete = function(id){
    console.log(id);
    $http.delete("http://localhost:8080/angularJsCrud/api/pacientes?id=" + id)
      .then(function(response){
        console.log(response);
        if(response.data){
          $scope.msgD = "Datos eliminados";
        }else{
          $scope.msgD = "Error al enviar los datos";
        }
      })
  }
  */

  $scope.postdata = function(nombre,dni,correo){
    var data = {
      nombre: nombre,
      dni: dni,
      correo: correo
    }

    $http.post("http://localhost:8080/angularJsCrud/api/pacientes", JSON.stringify(data))
      .then(function(response){
        console.log(response);
        
        if(response.data){
          $scope.msg = "Datos enviados";

          $scope.Nombre = data.nombre;
          $scope.DNI = data.dni;
          $scope.Correo = data.correo;
        }else{
          $scope.msg = "Error al enviar datos";
        }
      }, function(error){
          console.log(error);
      })
  }
 
  $scope.saveAdd = function(){
    $http({
      url: URL + '/api/pacientes',
      method: 'POST',
      data: $scope.form
    }).then(function(data){
      $scope.data.push(data);
      $(".modal").modal("hide");
    });
  }
 
  $scope.edit = function(id){
    $http({
      url: URL + '/api/pacientes?id='+id,
      method: 'GET'
    }).then(function(data){
      $scope.form = data;
    });
  }
 
  $scope.saveEdit = function(){
    $http({
      url: URL + '/api/pacientes?id='+$scope.form.id,
      method: 'POST',
      data: $scope.form
    }).then(function(data){
      $(".modal").modal("hide");
        $scope.data = apiModifyTable($scope.data,data.PacienteId,data);
    });
  }
 
  $scope.remove = function(post){
    var result = confirm("Are you sure delete this post?");
   if (result) {
      $http({
        url: URL + '/api/pacientes?id='+post,
        method: 'DELETE'
      }).then(function(data){
        $scope.data.splice(index,1);
      });
    }
  }

});