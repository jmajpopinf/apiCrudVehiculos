<?php

    class conexion {
        private $server;
        private $user;
        private $password;
        private $database;
        private $port;

        private $conexion;

        function __construct(){
            $listadatos = $this ->datosConexion();
            foreach($listadatos as $key => $value){
                $this->server = $value['server'];
                $this->user = $value['user'];
                $this->password = $value['password'];
                $this->database = $value['database'];
                $this->port = $value['port'];
            }

            $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
            
            if($this->conexion->connect_errno){
                echo "no se puede conectar, revise la configuración";
                die();
            }
        }


        private function datosConexion(){
            $direccion = dirname(__FILE__);
            $jsondata = file_get_contents($direccion . "/" . "config");
            return json_decode($jsondata, true); //convertir json a un array
        }

        //funcion para correccion de legibilidad eje. letras ñ o tildes
        private function convertirUTF8($array){
            array_walk_recursive($array, function(&$item, $key){
                if(!mb_detect_encoding($item, 'utf-8', true)){//si no detecta caracteres desconocidos
                    $item = utf8_encode($item);
                }
            });
            return $array;
        }

        //metodo para obtener datos
        public function obtenerDatos($sqlstr){
            $result = $this->conexion->query($sqlstr);

            $resultArray = array();

            foreach($result as $key){
                $resultArray[] = $key;
            }

            return $this->convertirUTF8($resultArray);
        }

        //guardar, eliminar, editar - devulve el numero de filas afectadas
        public function nonQuery($sqlstr){
            $results = $this->conexion->query($sqlstr);
            return $this->conexion->affected_rows;
        }

        //INSERT -al guardar un dato, filas afectadas devuelve el id.
        public function nonQueryId($sqlstr){
            $results = $this->conexion->query($sqlstr);
            $filas = $this->conexion->affected_rows;
            if($filas >= 1){
                return $this->conexion->insert_id;
            }else{
                return 0;
            }
        }

        protected function encriptar($string){
            return md5($string);
        }
    }

?>