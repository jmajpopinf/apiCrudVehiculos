<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/vehiculo.class.php';

$_respuestas = new respuestas;
$_vehiculo = new vehiculo;

if($_SERVER['REQUEST_METHOD'] == "GET"){
    //$action = $_GET['action'];
    /*
    if(isset($_GET["page"])){
        $pagina = $_GET["page"];
        $listaPacientes = $_vehiculo->listaPacientes($pagina);
        header("Content-Type: application/json");
        echo json_encode($listaPacientes);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $pacienteid = $_GET['id'];
        $datosPaciente = $_vehiculo->obtenerPaciente($pacienteid);
        header("Content-Type: application/json");
        echo json_encode($datosPaciente);
        http_response_code(200);
    }
    */
    if(isset($_GET['id'])){
        $idVehiculo = $_GET['id'];
        $datosVehiculo = $_vehiculo->obtenerVehiculo($idVehiculo);
        $datosMarca = $_vehiculo->listarMarca();
        $devoler = array('marcas'=>$datosMarca, 'vehiculos'=>$datosVehiculo);
       //delvovemos una respuesta 
       header('Content-Type: application/json');
       if(isset($datosVehiculo["result"]["error_id"])){
           $responseCode = $datosVehiculo["result"]["error_id"];
           http_response_code($responseCode);
       }else{
           http_response_code(200);
       }
       echo json_encode($devoler);
    }else{
        $postBody = file_get_contents("php://input");
        $datosArray = $_vehiculo->listarVehiculo($postBody);
        $datosMarca = $_vehiculo->listarMarca();
        $devoler = array('marcas'=>$datosMarca, 'vehiculos'=>$datosArray);
        //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($devoler);
    }
    

}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_vehiculo->post($postBody);
    //delvovemos una respuesta 
     header('Content-Type: application/json');
     if(isset($datosArray["result"]["error_id"])){
         $responseCode = $datosArray["result"]["error_id"];
         http_response_code($responseCode);
     }else{
         http_response_code(200);
     }
     echo json_encode($datosArray);
     

}else if($_SERVER['REQUEST_METHOD'] == "PUT"){
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos datos al manejador
    $datosArray = $_vehiculo->put($postBody);
    //delvovemos una respuesta 
    header('Content-Type: application/json');
    if(isset($datosArray["result"]["error_id"])){
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    }else{
        http_response_code(200);
    }
    echo json_encode($datosArray);

}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){

    if(isset($_GET['id'])){
        $idVehiculo = $_GET['id'];
        $datosVehiculo = $_vehiculo->eliminarVehiculo2($idVehiculo);
        header("Content-Type: application/json");
        echo json_encode($datosVehiculo);
        http_response_code(200);
    }else{
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos datos al manejador
        $datosArray = $_vehiculo->delete($postBody);
    //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);

    }

    
    
}else{
    header('Content-Type: application/json');
    $datosArray = $_respuesta->error_405();
    echo json_encode($datosArray);
}

?>