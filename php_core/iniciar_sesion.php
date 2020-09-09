<?php
    require 'herramientas.php';
    session_start();
    class iniciar_sesion extends herramientas{
        private $usuario;
        private $clave;
        private $clave_encriptada;
        public function __construct($usu,$cla){
            $this->usuario = $usu;
            $this->clave   = $cla;
        }
        public function verificar_exceso_caracteres(){
            if (strlen($this->usuario) < 50 || strlen($this->clave) < 50) {
                //pasó sin problemas
            }else{
                $mensaje = "usuario o clave incorrectos";
                $this->error($mensaje);
            }
        }
        public function verificar_caracteres_vacios(){
            if (strlen($this->usuario) > 0 && strlen($this->clave) > 0) {
                //pasó sin problemas
            }else{
                $mensaje = "usuario o clave incorrectos";
                $this->error($mensaje);
            }
        }
        public function verificar_coincidencia_usuario(){
            $this->conectar_bd();
            //saco los caráctes especiales
            $this->usuario = $this->conexion->real_escape_string($this->usuario);
            $this->clave   = $this->conexion->real_escape_string($this->clave);
            //
            $query = "SELECT clave FROM usuario WHERE usuario = '$this->usuario'";
            $clave_encriptada_bd = $this->conexion->query($query);
            $this->desconectar_bd();
            $clave_encriptada_json = $clave_encriptada_bd->fetch_assoc();
            if (isset($clave_encriptada_json['clave'])) {
                $this->clave_encriptada = $clave_encriptada_json['clave'];
            }else{
                $mensaje = "usuario o clave incorrectos";
                $this->error($mensaje);
            }
        }
        public function verificar_coincidencia_clave(){
            if (password_verify($this->clave,$this->clave_encriptada)) {
                //pasó sin problemas
            }else{
                $mensaje = "usuario o clave incorrectos";
                $this->error($mensaje);                
            }
        }
        public function asignar_permisos(){
            $_SESSION['id'] = 1;
        }
        public function redireccionar(){
            setcookie('correcto','bienvenido',time()+5,"/");
            $corr['correcto'] = "admin.php";
            echo json_encode($corr);
            die();
        }
        private function error($mensaje){
            $err['error'] = $mensaje;
            echo json_encode($err);
            die();
        }
    }
    $usuari = $_POST['usuario'];
    $clave = $_POST['clave'];
    $usuario = new iniciar_sesion($usuari,$clave);
    $usuario->verificar_exceso_caracteres();
    $usuario->verificar_caracteres_vacios();
    $usuario->verificar_coincidencia_usuario();
    $usuario->verificar_coincidencia_clave();
    $usuario->asignar_permisos();
    $usuario->redireccionar();
?> 