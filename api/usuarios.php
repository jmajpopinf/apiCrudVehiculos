<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/usuarios.class.php';

$_respuestas = new respuestas;
$_usuarios = new usuarios;

if($_SERVER['REQUEST_METHOD'] == "GET"){
    
    /*
    if(isset($_GET["page"])){
        $pagina = $_GET["page"];
        $listaPacientes = $_usuarios->listaPacientes($pagina);
        header("Content-Type: application/json");
        echo json_encode($listaPacientes);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $usuarioid = $_GET['id'];
        $datosUsuario = $_usuarios->obtenerUsuario($usuarioid);
        header("Content-Type: application/json");
        echo json_encode($datosUsuario);
        http_response_code(200);
    }
    */
    /*if(isset($_GET['id'])){
        $usuarioid = $_GET['id'];
        $datosUsuario = $_usuarios->obtenerUsuario($usuarioid);
        header("Content-Type: application/json");
        echo json_encode($datosUsuario);
        http_response_code(200);
    }else if(isset($_GET['usuario'])){
        $usuario = $_GET['usuario'];
        $password = $_GET['password'];
        $datosUsuario = $_usuarios->obtenerUs($usuario, $password);
        header("Content-Type: application/json");
        echo json_encode($datosUsuario);
        http_response_code(200);
    }else{
        $postBody = file_get_contents("php://input");
        $datosArray = $_usuarios->listarUsuarios($postBody);
        //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);
    }*/
        //$id = $_GET['id'];
        $usuario = $_GET['usuario'];
        $password = $_GET['contrasena'];
        $action = $_GET['action'];
        if($action=='1'){
        //echo json_encode('usuario'->$usuario, 'password'->$password, 'action'->$action);
            $datosUsuario = $_usuarios->obtenerUs($usuario, $password);
            header("Content-Type: application/json");
            echo json_encode($datosUsuario);
            http_response_code(200);

        }else if($action=='2'){
            echo json_encode('usuario'->$usuario, 'password'->$password, 'action'->$action);
        }else{

        }
   



}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_usuarios->post($postBody);
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
    $datosArray = $_usuarios->put($postBody);
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
        $usuarioid = $_GET['id'];
        $datosUsuario = $_usuarios->eliminarUsario2($usuarioid);
        header("Content-Type: application/json");
        echo json_encode($datosUsuario);
        http_response_code(200);
    }else{
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos datos al manejador
        $datosArray = $_usuarios->delete($postBody);
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