<?php
    require '../herramientas.php';
    class agregar_receta extends herramientas{
        private $imagen_ubicacion;
        private $titulo;
        private $contenido;
        public function __construct($ima_ubi,$tit,$con){
            $this->imagen_ubicacion = $ima_ubi;
            $this->titulo           = $tit;
            $this->contenido        = $con;
        }
        public function verificar_exceso_caracteres(){
            if (strlen($this->titulo) < 50){
                //pasó sin problemas
            }else{
                $mensaje = "El título es muy largo";
            }
            if (strlen($this->contenido) < 2500){
                //pasó sin problemas
            }else{
                $mensaje = "El contenido es muy largo";
            }

        }
        public function guardar_receta(){
            $this->conectar_bd();
            //escapo de los carácteres especiales
            $this->titulo = $this->conexion->real_escape_string($this->titulo);
            $this->contenido = $this->conexion->real_escape_string($this->contenido);
            //
            $query = "INSERT INTO publicaciones(imagen,titulo,contenido) VALUES ('$this->imagen_ubicacion','$this->titulo','$this->contenido')";
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
    $imagen_ubicacion = $_POST['imagen_ubicacion'];
    $titulo           = $_POST['titulo'];
    $contenido        = $_POST['contenido'];
    $receta = new agregar_receta($imagen_ubicacion,$titulo,$contenido);
    $receta->verificar_exceso_caracteres();
    $receta->guardar_receta();
    $receta->traer_recetas_ahora();
?>