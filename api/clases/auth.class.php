<?php
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';


class auth extends conexion{

    public function login($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);
    
        if(!isset($datos['usuario']) || !isset($datos['password'])){
            //error en los campos
            return $_respuestas->error_400();
        }else{
            //sin errores en los campos
            $usuario = $datos['usuario'];
            $password = $datos['password'];
            $password = parent::encriptar($password);//se encripta la contraseña ingresada
            $datos = $this->obtenerDatosUsuario($usuario);
            if($datos){
                //verificacion de la contraseña
                if($password == $datos[0]['Password']){
                    //si el usuario ya esta activo
                    if($datos[0]['Estado'] == "Activo"){
                        //se creal el token 
                        $verificar = $this->insertarToken($datos[0]['UsuarioId']);

                        if($verificar){
                            //se guardo el token
                            $result = $_respuestas->response;
                            $result["result"] = array(
                                "token" => $verificar
                            );
                            return $result;
                        }else{
                            //error al guardar
                            return $_respuestas->error_500("Error interno, nos logro guardar la inf.");
                        }
                    }else{
                        //usuario esta inactivo
                        return $_respuestas->error_200("El usuario esta inactivo");
                    }

                }else{
                    return $_respuestas->error_200("El password es invalido ");
                }
            }else{
                //si no existe el usuario
                return $_respuestas->error_200("El usuario $usuario no existe ");
            }
        }
    }

    private function obtenerDatosUsuario($correo){
        $query = "SELECT UsuarioId, Password, Estado FROM usuarios WHERE Usuario = '$correo'";
        $datos = parent::obtenerDatos($query);
        if(isset($datos[0]["UsuarioId"])){
            return $datos;
        }else{
            return 0;
        }
    }

    private function insertarToken($usuarioId){
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16, $val));
        $date = date("Y-m-d H:i");
        $estado = "Activo";
        $query = "INSERT INTO usuarios_token (UsuarioId, Token, Estado, Fecha) VALUES('$usuarioId', '$token', '$estado', '$date')";
        $verifica = parent::nonQuery($query);

        if($verifica){
            return $token;
        }else{
            return 0;
        }
    }

   
}


?>