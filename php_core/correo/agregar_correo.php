<?php
    require '../herramientas.php';
    class agregar_correo extends herramientas{
        private $nombre;
        private $email;
        private $telefono;
        private $mensaje;
        public function __construct($nom,$ema,$tel,$men){
            $this->nombre = $nom;
            $this->email = $ema;
            $this->telefono = $tel;
            $this->mensaje = $men;
        }
        public function verificar_caracteres_vacios(){
            if (strlen($this->nombre) > 0 && strlen($this->email) > 0 && strlen($this->mensaje) > 0) {
                //pasó sin problemas
            }else{
                $mensaje = "Nombre, Email y Mensaje son obligatorios";
                $this->error($mensaje);
            }
        }
        public function verificar_exceso_caracteres(){
            if (strlen($this->nombre) < 50) {
                //pasó sin problemas
            }else{
                $mensaje = "Nombre demasiado largo";
                $this->error($mensaje);
            }
            if (strlen($this->email) < 100) {
                //sin problemas
            }else{
                $mensaje = "Email demasiado largo";
                $this->error($mensaje);
            }
            if (intval($this->telefono) < 10000000000) {
                //pasó sin problemas
            }else{
                $mensaje = "Telefono demasiado largo";
                $this->error($mensaje);
            }
            if (strlen($this->mensaje) < 1000) {
                //sin problemas
            }else{
                $mensaje = "mensaje demasiado largo";
                $this->error($mensaje);
            }
        }
        public function agregar_correo_ahora(){
            $this->conectar_bd();
            //escapo de los caracteres especiales
            $this->nombre = $this->conexion->real_escape_string($this->nombre);
            $this->email = $this->conexion->real_escape_string($this->email);
            $this->telefono = $this->conexion->real_escape_string($this->telefono);
            $this->mensaje = $this->conexion->real_escape_string($this->mensaje);
            //
            $query = "INSERT INTO correos(nombre,email,telefono,mensaje) VALUES ('$this->nombre','$this->email','$this->telefono','$this->mensaje')";
            $this->conexion->query($query);
            $this->desconectar_bd();
        }
        public function listo(){
            $corr['correcto'] = "Correo enviado exitosamente.";
            echo json_encode($corr);
        }
        private function error($mensaje){
            $err['error'] = $mensaje;
            echo json_encode($err);
            die();
        }
    }
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];
    $correo = new agregar_correo($nombre,$email,$telefono,$mensaje);
    $correo->verificar_caracteres_vacios();
    $correo->verificar_exceso_caracteres();
    $correo->agregar_correo_ahora();
    $correo->listo();
?>