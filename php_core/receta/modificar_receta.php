<?php
    require '../herramientas.php';
    class modificar_receta extends herramientas{
        private $imagen;
        private $id;
        private $titulo;
        private $contenido;
        public function __construct($ima,$i,$tit,$con){
            $this->imagen = $ima;
            $this->id = $i;
            $this->titulo = $tit;
            $this->contenido = $con;
        }
        public function verificar_campos_vacios(){
            if (strlen($this->titulo) != 0){
                //pasó sin problemas
            }else{
                $mensaje = "El título está vacío";
                $this->error($mensaje);
            }
            if (strlen($this->contenido) != 0){
                //pasó sin problemas
            }else{
                $mensaje = "El contenido está vacío";
                $this->error($mensaje);
            }
        }
        public function verificar_exceso_caracteres(){
            if (strlen($this->titulo) < 50){
                //pasó sin problemas
            }else{
                $mensaje = "El título excede los 50 carácteres";
                $this->error($error);
            }
            if (strlen($this->contenido) < 1000){
                //pasó sin problemas
            }else{
                $mensaje = "El contenido excede los 1000 carácteres";
                $this->error($error);
            }
        }
        public function modificar_ahora(){
            $this->conectar_bd();
            //escapo de los caracteres especiales
            $this->titulo = $this->conexion->real_escape_string($this->titulo);
            $this->contenido = $this->conexion->real_escape_string($this->contenido);
            //
            $query = "UPDATE publicaciones SET imagen = '$this->imagen', titulo = '$this->titulo', contenido = '$this->contenido' WHERE id = $this->id";
            $this->conexion->query($query);
            $this->desconectar_bd();
        }
        public function traer_recetas_ahora(){
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
            echo json_encode($mensaje);
            die();
        }
    }
    $imagen = $_POST['imagen'];
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $receta = new modificar_receta($imagen,$id,$titulo,$contenido);
    $receta->verificar_campos_vacios();
    $receta->verificar_exceso_caracteres();
    $receta->modificar_ahora();
    $receta->traer_recetas_ahora();
?>