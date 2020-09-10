<?php
    require "../herramientas.php";
    class eliminar_receta extends herramientas{
        private $id;
        public function __construct($i){
            $this->id = $i;
        }
        public function eliminar_receta_ahora(){
            $this->conectar_bd();
            //saco caracteres especiales
            $this->id = $this->conexion->real_escape_string($this->id);
            //
            $query = "DELETE FROM publicaciones WHERE id = $this->id";
            $this->conexion->query($query);
            $this->desconectar_bd();
        }
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
                $this->cuidado($mensaje);
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
        private function cuidado($mensaje){
            $cuid['cuidado'] = $mensaje;
            echo json_encode($cuid);
            die();
        }
    }
    $id = $_POST['id'];
    $receta = new eliminar_receta($id);
    $receta->eliminar_receta_ahora();
    $receta->verificar_publicaciones_vacias();
    $receta->traer_publicaciones_ahora()
?>