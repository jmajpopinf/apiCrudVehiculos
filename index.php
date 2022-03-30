<html lang="en">

<head>
	<title>AngularJS Simple CRUD Application - W3Adda</title>

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

	<!-- App Controller -->
	<script src="app/controllers/PostController.js"></script>

</head>

<body ng-app="main-App">

	<div class="container">
		<ng-view></ng-view>
	</div>
</body>
</html>