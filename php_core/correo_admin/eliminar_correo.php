<?php
    require '../herramientas.php';
    class eliminar_correo extends herramientas{
        private $id;
        public function __construct($i){
            $this->id = $i;
        }
        public function eliminar_correo_ahora(){
            $this->conectar_bd();
            //escapo caracteres especiales
            $this->id = $this->conexion->real_escape_string($this->id);
            //
            $query = "DELETE FROM correos WHERE id = '$this->id'";
            $this->conexion->query($query);
            $this->desconectar_bd();
        }
        public function verificar_correos_vacios(){
            $this->conectar_bd();
            $query = "SELECT COUNT(*) AS cantidad FROM correos ORDER BY id DESC";
            $cantidad_bd = $this->conexion->query($query);
            $this->desconectar_bd();
            $cantidad_json = $cantidad_bd->fetch_assoc();
            if (intval($cantidad_json['cantidad']) != 0){
                //pasó sin problemas
            }else{
                $this->error();
            }
        }
        public function traer_correos_ahora(){
            $this->conectar_bd();
            $query = "SELECT * FROM correos";
            $correos_bd = $this->conexion->query($query);
            $this->desconectar_bd();
            foreach ($correos_bd as $row) {
                $cargando[] = $row;
            }
            $corr['correos'] = $cargando;
            $corr['correcto'] = 'lísto';
            echo json_encode($corr);
        }
        private function error(){
            $corr['correos'] = null;
            $corr['correcto'] = 'No hay ningún correo para leer';
            echo json_encode($corr);
            die();
        }
    }
    $id = $_POST['id'];
    $correo = new eliminar_correo($id);
    $correo->eliminar_correo_ahora();
    $correo->verificar_correos_vacios();
    $correo->traer_correos_ahora();
?>