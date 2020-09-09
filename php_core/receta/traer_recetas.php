<?php
    require '../herramientas.php';
    class traer_recetas extends herramientas{
        public function verificar_publicaciones_vacias(){
            $this->conectar_bd();
            $query = "SELECT COUNT(*) as cantidad FROM publicaciones";
            $cantidad_bd = $this->conexion->query($query);
            $this->desconectar_bd();
            $cantidad_json = $cantidad_bd->fetch_assoc();
            if (intval($cantidad_json['cantidad']) > 0) {
                //pasó sin problemas
            }else{
                $mensaje = "No hay recetas, agregá una!";
                $this->error($mensaje);
            }
        }
        public function traer_publicaciones_ahora(){
            $this->conectar_bd();
            $query = "SELECT * FROM publicaciones ORDER BY id DESC";
            $publicaciones_bd = $this->conexion->query($query);
            $this->desconectar_bd();
            foreach ($publicaciones_bd as $row){
                $cargando[] = $row;
            }
            $corr['recetas'] = $cargando;
            $corr['correcto'] = true;
            echo json_encode($corr);
        }
        private function error($mensaje){
            $err['error'] = $mensaje;
            echo json_encode($err);
            die();
        }
    }
    $receta = new traer_recetas();
    $receta->verificar_publicaciones_vacias();
    $receta->traer_publicaciones_ahora();
?>