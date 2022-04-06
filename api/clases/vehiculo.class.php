<?php
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

class vehiculo extends conexion{

    private $table = "vehiculo";
    private $idVehiculo = "";
    private $idUsuario = "";
    private $idMarca = "";
    private $modelo = "";
    private $color = "";
    private $costo = "";
    private $genero = "";
    private $fechaCompra = "";

    /*
    public function listaPacientes($pagina = 1){
        $inicio = 0;
        $cantidad = 100;

        if($pagina > 1){
            $inicio = ($cantidad *($pagina -1)) +1;
            $cantidad = $cantidad * $pagina;

        }

        $query = "SELECT PacienteId,Nombre,DNI,Telefono,Correo FROM " . $this->table . " limit $inicio, $cantidad";
        $datos = parent::obtenerDatos($query);
        return($datos);
    }
    */

    public function obtenerVehiculo($id){
        $query = "SELECT v.*,u.nombre, m.descripcion FROM vehiculo v, marca m,usuario u WHERE v.idUsuario = u.idUsuario and v.idMarca = m.idMarca and u.idUsuario='$id' ;";
        $datos =  parent::obtenerDatos($query);
        return($datos);

    }

    public function listarVehiculo(){
        $query = "SELECT v.*,u.nombre, m.descripcion FROM vehiculo v, marca m,usuario u WHERE v.idUsuario = u.idUsuario and v.idMarca = m.idMarca;";
        $datos = parent::obtenerDatos($query);
        return($datos);
    }

    public function listarMarca(){
        $query = "SELECT idMarca, descripcion from marca;";
        $datos = parent::obtenerDatos($query);
        return($datos);
    }

  
    public function post($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['idUsuario']) || !isset($datos['idMarca']) || !isset($datos['modelo']) || !isset($datos['color']) || !isset($datos['costo'])){
            return $_respuestas->error_400();
        }else{
            $this->idUsuario = $datos['idUsuario'];
            $this->idMarca = $datos['idMarca'];
            $this->modelo = $datos['modelo'];
            $this->color = $datos['color'];
            $this->costo = $datos['costo'];
    
            $resp = $this->insertarVehiculo();
            if($resp){
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "idVehiculo" => $resp
                );
                return $respuesta;
            }else{
                return $_respuestas->error_500();
            }
        }
    }

    private function insertarVehiculo(){
        $query = "INSERT INTO " . $this->table . " (idUsuario, idMarca, modelo, color, costo)
        values
        ('" . $this->idUsuario . "','" . $this->idMarca . "','" . $this->modelo . "','" . $this->color . "','" . $this->costo . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }

    public function put($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['idVehiculo'])){
            return $_respuestas->error_400();
        }else{
            $this->idVehiculo = $datos['idVehiculo'];
            if(isset($datos['idUsuario'])) { $this->idUsuario = $datos['idUsuario']; }
            if(isset($datos['idMarca'])) { $this->idMarca = $datos['idMarca']; }
            if(isset($datos['modelo'])) { $this->modelo = $datos['modelo']; }
            if(isset($datos['color'])) { $this->color = $datos['color']; }
            if(isset($datos['costo'])) { $this->costo = $datos['costo']; }

            $resp = $this->modificarVehiculo();
            if($resp){
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "idVehiculo" => $this->idVehiculo
                );
                return $respuesta;
            }else{
                return $_respuestas->error_500();
            }
        }
    }


    private function modificarVehiculo(){
        $query = "UPDATE " . $this->table . " SET idUsuario ='" . $this->idUsuario . "',idMarca = '" . $this->idMarca . "',modelo = '" . $this->modelo . "', color = '" . $this->color . "', costo = '" .
        $this->costo . "' WHERE idVehiculo = '" . $this->idVehiculo . "'"; 
        $resp = parent::nonQuery($query); //retorna filas afectadas
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function delete($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['idVehiculo'])){
            return $_respuestas->error_400();
        }else{
            $this->idVehiculo = $datos['idVehiculo'];
            $resp = $this->eliminarVehiculo();
            if($resp){
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "idVehiculo" => $this->idVehiculo
                );
                return $respuesta;
            }else{
                return $_respuestas->error_500();
            }
        }
    }

    private function eliminarVehiculo(){
        $query = "DELETE FROM " . $this->table . " WHERE idVehiculo= '" . $this->idVehiculo . "'";
        $resp = parent::nonQuery($query); 
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function eliminarVehiculo2($id){
        $query = "DELETE FROM " . $this->table . " WHERE idVehiculo = '$id'";
        $resp = parent::nonQuery($query); 
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }

    }

}

?>