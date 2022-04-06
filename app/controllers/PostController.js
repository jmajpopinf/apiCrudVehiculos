var URL = "http://localhost:8080/angularJsCrud";
app.controller('PostController', function ($scope, $http, $location) {

  //$scope.usuario = null;
  //$scope.dni = null;
  //$scope.correo = null;


  $scope.data = [];
  $scope.dataMarca = [];

  var userLocal = localStorage.getItem('usuario')
	console.log(userLocal);
   if(!userLocal) {
		localStorage.removeItem('usuario');
		$location.path('/login');
   	}

  //getMarca();
  getResultsPage();

  

  function getResultsPage() {
    $http({
      url: URL + '/api/vehiculo',
      method: 'GET'
    }).then(function (res) {
      $scope.data = res.data.vehiculos;
      $scope.dataMarca = res.data.marcas;
      console.log(res);
    });
  }

  $scope.postdata = function () {
    var data = {
      idUsuario: this.idUsuario,
      idMarca: this.marca,
      modelo: this.modelo,
      color: this.color,
      costo: this.costo
    }

    console.log(data);

    

    $http.post("http://localhost:8080/angularJsCrud/api/vehiculo", JSON.stringify(data))
      .then(function (response) {
        console.log(response);

        if (response.data) {
          $scope.msg = "Datos enviados";

          getResultsPage();

          //locationreload();
          //variables extras para comprobar el resultado
          //$scope.Marca = data.marca;
          //$scope.Modelo = data.modelo;
          //$scope.Color = data.color;
          //$scope.Precio = data.precio;
        } else {
          $scope.msg = "Error al enviar datos";
        }
      }, function (error) {
        console.log(error);
      })
      

  }

  /*
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
  */

  $scope.edit = function (id_Vehiculo, id_Usuario, id_Marca, modelo, color, precio, fecha) {

    /*
    var data = {
      id_vehiculo: id_Vehiculo,
      id_usuario: id_Usuario,
      id_marca : id_Marca,
      modelo: modelo,
      color: color,
      precio: precio,
      fecha: fecha
    }
    */

    $scope.idVehiculoE = id_Vehiculo;
    $scope.idUsuarioE = id_Usuario;
    $scope.idMarcaE = id_Marca; 
    $scope.modeloE = modelo;
    $scope.colorE = color;
    $scope.costoE = precio;
    $scope.fechaE = fecha;

    //saveData($scope.idVehiculoE, $scope.idUsuarioE, $scope.idMarcaE, $scope.modeloE, $scope.colorE, $scope.costoE, $scope.fechaE);
  }

  function getMarca(){
    $http.get('http://localhost:8080/angularJsCrud/api/vehiculo?action='+'1').then(dataMarca =>{
      console.log(dataMarca)
       })
  }

  $scope.saveData = function (idVehiculo, idUsuario, idMarca, modelo, color, costo, fecha) {
    var dataE = {
      idVehiculo: idVehiculo,
      idUsuario: idUsuario,
      idMarca: idMarca,
      modelo: modelo,
      color: color,
      costo: costo,
      fechaPrecio: fecha
    }

    $http.put("http://localhost:8080/angularJsCrud/api/vehiculo", JSON.stringify(dataE))
      .then(function (response) {
        console.log(response);

        if (response.data) {
          $scope.msgE = "Datos enviados";
          //locationreload();
          getResultsPage();

        } else {
          $scope.msg = "Error al enviar datos";
        }
      }, function (error) {
        console.log();
      })
  }


  /*
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
   */

  $scope.remove = function (id) {
    var result = confirm("Are you sure delete this post?");
    if (result) {
      $http({
        url: URL + '/api/vehiculo?id=' + id,
        method: 'DELETE'
      }).then(function (data) {
        getResultsPage();
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


  $scope.getUsuatio = function(){
    var usuario = localStorage.getItem('usuario');
    return usuario;
  }


  $scope.removeUsuario = function(){
    localStorage.removeItem('usuario');
  }

});