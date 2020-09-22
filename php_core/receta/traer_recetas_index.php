<?php
    require 'php_core/herramientas.php';
    class traer_recetas extends herramientas{
        public function verificar_publicaciones_vacias(){
            $this->conectar_bd();
            $query = "SELECT COUNT(*) as cantidad FROM publicaciones";
            $cantidad_bd = $this->conexion->query($query);
            $this->desconectar_bd();
            $cantidad_json = $cantidad_bd->fetch_assoc();
            if (intval($cantidad_json['cantidad']) > 0) {
                return false;
            }else{
                return $this->error();
            }
        }
        public function traer_publicaciones_ahora(){
            $this->conectar_bd();
            $query = "SELECT * FROM publicaciones ORDER BY id DESC";
            $publicaciones_bd = $this->conexion->query($query);
            $this->desconectar_bd();
            return $publicaciones_bd;
        }
        private function error(){
            return true;
        }
    }
    $receta = new traer_recetas();
    if ($receta->verificar_publicaciones_vacias()){
    	$recetas_bd = "vacio";
	}else{
    	$recetas_bd = $receta->traer_publicaciones_ahora();
	}
?>