<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/pacientes.class.php';

$_respuestas = new respuestas;
$_pacientes = new pacientes;

if($_SERVER['REQUEST_METHOD'] == "GET"){
    
    /*
    if(isset($_GET["page"])){
        $pagina = $_GET["page"];
        $listaPacientes = $_pacientes->listaPacientes($pagina);
        header("Content-Type: application/json");
        echo json_encode($listaPacientes);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $pacienteid = $_GET['id'];
        $datosPaciente = $_pacientes->obtenerPaciente($pacienteid);
        header("Content-Type: application/json");
        echo json_encode($datosPaciente);
        http_response_code(200);
    }
    */
    if(isset($_GET['id'])){
        $pacienteid = $_GET['id'];
        $datosPaciente = $_pacientes->obtenerPaciente($pacienteid);
        header("Content-Type: application/json");
        echo json_encode($datosPaciente);
        http_response_code(200);
    }else{
        $postBody = file_get_contents("php://input");
        $datosArray = $_pacientes->listarPacientes($postBody);
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
    
   



}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_pacientes->post($postBody);
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
    $datosArray = $_pacientes->put($postBody);
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
        $pacienteid = $_GET['id'];
        $datosPaciente = $_pacientes->eliminarPaciente2($pacienteid);
        header("Content-Type: application/json");
        echo json_encode($datosPaciente);
        http_response_code(200);
    }else{
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos datos al manejador
        $datosArray = $_pacientes->delete($postBody);
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