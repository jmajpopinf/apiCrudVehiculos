app.controller('reportController', function ($scope, $http, $location) {

    $scope.data = [];

    var userLocal = localStorage.getItem('usuario');
    $scope.user = localStorage.getItem('usuario');
    console.log($scope.userIdLocal);
	//console.log(userLocal);
    if(!userLocal) {
		//localStorage.removeItem('usuario');
		$location.path('/login');
   	}else{
        $location.path('/reporteVendidos');
    }

    getVendidos();



    function getVendidos() {
        $http({
        url: URL + '/api/vehiculo',
        method: 'GET'
        }).then(function (res) {
        $scope.data = res.data.vendidos;
        console.log(res);
        });
    }

 });