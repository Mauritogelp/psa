<?php
    class herramientas{
        private $host     = "localhost";
        private $user     = "root";
        private $password = "";
        private $database = "psa";
        protected $conexion;
        public function conectar_bd(){
            $this->conexion = new mysqli($this->host,$this->user,$this->password,$this->database);
        }
        public function desconectar_bd(){
            $this->conexion->close();
        }
    }
?>