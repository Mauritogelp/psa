<?php
    require '../herramientas.php';
    class traer_correos extends herramientas{
        public function verificar_correos_vacios(){
            $this->conectar_bd();
            $query = "SELECT COUNT(*) AS cantidad FROM correos";
            $cantidad_bd = $this->conexion->query($query);
            $this->desconectar_bd();
            $cantidad_json = $cantidad_bd->fetch_assoc();
            if (intval($cantidad_json['cantidad']) > 0) {
                //pasó sin problemas
            }else{
                $mensaje = "Todavía no hay correos";
                $this->cuidado($mensaje);
            }
        }
        public function traer_correos_ahora(){
            $this->conectar_bd();
            $query = "SELECT * FROM correos";
            $correos_bd = $this->conexion->query($query);
            $this->desconectar_bd();
            foreach($correos_bd as $row){
                $cargando[] = $row;
            }
            $corr['correos'] = $cargando;
            $corr['correcto'] = true;
            echo json_encode($corr);
        }
        private function cuidado($mensaje){
            $err['cuidado'] = $mensaje;
            echo json_encode($err);
        }
    }
    $correos = new traer_correos();
    $correos->verificar_correos_vacios();
    $correos->traer_correos_ahora();
?>