<?php
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';

class usuarios extends conexion{

    private $table = "usuario";
    private $usuario = "";
    private $nombre = "";
    private $edad = "";
    private $genero = "";
    private $cargo = "";
    private $contrasena = "";
  

    public function listaUsuarios($pagina = 1){
        $inicio = 0;
        $cantidad = 100;

        if($pagina > 1){
            $inicio = ($cantidad *($pagina -1)) +1;
            $cantidad = $cantidad * $pagina;

        }

        $query = "SELECT UsuarioId,Nombre,Usuario,Telefono,Correo FROM " . $this->table . " limit $inicio, $cantidad";
        $datos = parent::obtenerDatos($query);
        return($datos);
    }

    public function obtenerUsuario($id){
        $query = "SELECT * FROM " . $this->table . " WHERE UsuarioId = '$id'";
        $datos =  parent::obtenerDatos($query);
        return($datos);

    }

    public function obtenerUs($usuario,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE usuario = '$usuario' and contrasena = '$password'" ;
        $datos =  parent::obtenerDatos($query);
        if(sizeof($datos)>0){
            return array('success'=>true, 'datos'=>$datos);

        }else{
            return array('success'=>false, 'datos'=>$datos);
        };

    }



    public function listarUsuarios(){
        $query = "SELECT * FROM usuarios";
        $datos = parent::obtenerDatos($query);
        return($datos);
    }

    public function post($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['usuario']) || !isset($datos['nombre']) || !isset($datos['edad']) || !isset($datos['genero']) || !isset($datos['cargo']) || !isset($datos['contrasena'])){
            return $_respuestas->error_400();
        }else{
            $this->usuario = $datos['usuario'];
            $this->nombre = $datos['nombre'];
            $this->edad = $datos['edad'];
            $this->genero = $datos['genero'];
            $this->cargo = $datos['cargo'];
            $this->contrasena = $datos['contrasena'];
            $resp = $this->insertarUsuario();
            if($resp){
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "idUsuario" => $resp
                );
                return $respuesta;
            }else{
                return $_respuestas->error_500();
            }
        }
    }

    private function insertarUsuario(){
        $query = "INSERT INTO " . $this->table . " (usuario, nombre, edad, genero, cargo, contrasena)
        values
        ('" . $this->usuario . "','" . $this->nombre . "','" . $this->edad . "','" . $this->genero . "','" . $this->cargo . "','" . $this->contrasena . "')"; 
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

        if(!isset($datos['usuarioId'])){
            return $_respuestas->error_400();
        }else{
            $this->usuarioid = $datos['usuarioId'];
            if(isset($datos['password'])) { $this->password = $datos['password']; }
            if(isset($datos['usuario'])) { $this->usuario = $datos['usuario']; }


            $resp = $this->modificarUsuario();
            if($resp){
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "usuarioId" => $this->usuarioid
                );
                return $respuesta;
            }else{
                return $_respuestas->error_500();
            }
        }
    }


    private function modificarUsuario(){
        $query = "UPDATE " . $this->table . " SET Nombre ='" . $this->password . "',Direccion = '" . $this->direccion . "', Usuario = '" . $this->usuario . "', CodigoPostal = '" .
        $this->codigoPostal . "', Telefono = '" . $this->telefono . "', Genero = '" . $this->genero . "', FechaNacimiento = '" . $this->fechaNacimiento . "', Correo = '" . $this->correo .
         "' WHERE UsuarioId = '" . $this->usuarioid . "'"; 
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

        if(!isset($datos['usuarioId'])){
            return $_respuestas->error_400();
        }else{
            $this->usuarioid = $datos['usuarioId'];
            $resp = $this->eliminarUsuario();
            if($resp){
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "usuarioId" => $this->usuarioid
                );
                return $respuesta;
            }else{
                return $_respuestas->error_500();
            }
        }
    }

    private function eliminarUsuario(){
        $query = "DELETE FROM " . $this->table . " WHERE UsuarioId= '" . $this->usuarioid . "'";
        $resp = parent::nonQuery($query); 
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function eliminarUsuario2($id){
        $query = "DELETE FROM " . $this->table . " WHERE UsuarioId = '$id'";
        $resp = parent::nonQuery($query); 
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }

    }

}

?>