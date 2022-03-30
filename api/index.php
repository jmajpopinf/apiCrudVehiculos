<?php
    require_once "clases/conexion/conexion.php";

    $conexion = new conexion;

    $query = "SELECT * FROM pacientes";

    //$query = "INSERT INTO pacientes (DNI)value('1')";

    print_r($conexion->obtenerDatos($query));

?>