<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AngularJS Application</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<!-- Angular JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>
	<!-- My App -->
	<script src="app/routes.js"></script>
	<script src="app/helper/myHelper.js"></script>
	<script src="aPp/loginService.js"></script>

	<!-- App Controller -->
	<script src="app/controllers/PostController.js"></script>
	<script src="app/controllers/loginController.js"></script>
	<script src="app/controllers/registerController.js"></script>
	<script src="app/controllers/reportController.js"></script>
	

</head>
<body ng-app="main-App">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#/home">CARRITO VELOZ S.A.</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#/home">Home</a></li>
      <li><a href="#/reporte">Informe 1</a></li>
      <li><a href="">Informe 2</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/action_page.php">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" name="search">
      </div>
      <button type="submit" class="btn btn-default">Buscar</button>
    </form>
    <ul class="nav navbar-nav pull-right">
      <li><a href="#/login" ng-click="removeUsuario()">Cerrar Sesión</a></li>
    </ul>
  </div>
</nav>
	<div class="container">
		<ng-view></ng-view>
	</div>
</body>
</html>