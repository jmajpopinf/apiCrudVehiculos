<?php
    require_once "clases/conexion/conexion.php";

    $conexion = new conexion;

    $query = "SELECT * FROM vehiculo";

    //$query = "INSERT INTO pacientes (DNI)value('1')";

    print_r($conexion->obtenerDatos($query));

?>