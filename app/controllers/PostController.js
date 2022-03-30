var URL = "http://localhost:8080/angularJsCrud";
app.controller('PostController', function($scope,$http){

  //$scope.nombre = null;
  //$scope.dni = null;
  //$scope.correo = null;
  
    
  $scope.data = [];

  $scope.mod = [];
 
  getResultsPage();
 
  function getResultsPage() {
    $http({
      url: URL + '/api/pacientes',
      method: 'GET'
    }).then(function(res){
      $scope.data = res.data;
    });
  }


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
          locationreload();

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
 
  $scope.edit = function(id,nombre,dni,correo){
    var data = {
      id : id,
      nombre: nombre,
      dni: dni,
      correo: correo
    }

    $scope.IdE = data.id;
    $scope.NombreE = data.nombre;
    $scope.DNIE = data.dni;
    $scope.CorreoE = data.correo;

    saveData($scope.IdeE, $scope.NombreE, $scope.DNIE, $scope.CorreoE);
  }

  $scope.saveData = function(id,nombre,dni,correo){
    var dataE = {
      pacienteId: id,
      nombre: nombre,
      dni: dni,
      correo: correo
    }
    $http.put("http://localhost:8080/angularJsCrud/api/pacientes", JSON.stringify(dataE))
      .then(function(response){
        console.log(response);
        
        if(response.data){
          $scope.msgE = "Datos enviados";
          locationreload();

          
        }else{
          $scope.msg = "Error al enviar datos";
        }
      }, function(error){
          console.log(error);
      })
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
        locationreload();
      });
    }
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

  function locationreload() {
    // To reload the entire page from the server
    location.reload();      
    }

});