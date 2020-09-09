<?php
    require '../herramientas.php';
    class guardar_imagen_tmp extends herramientas{
        private $imagen_nombre;
        private $imagen_peso;
        private $imagen_formato;
        private $imagen;
        public function __construct($ima){
            $this->imagen_nombre = $ima['name'];
            $this->imagen_peso = $ima['size'];
            $this->imagen_formato = $ima['type'];
            $this->imagen = $ima['tmp_name'];
        }
        public function verificar_peso(){
            if (strlen($this->imagen_peso) < 639103) {
                //pasó sin problemas
            }else{
                $mensaje = "solo se admite imagenes que sean menor a 11MB";
                $this->error($mensaje);
            }
        }
        public function verificar_formato(){
            if(exif_imagetype($this->imagen)) {
                //pasó sin problemas
            }else{
                $mensaje = "solo se admiten imagenes JPG/PNG/GIF/JPEG";
                $this->error($mensaje);
            }
        }
        public function modificar_nombre(){
            $this->imagen_nombre = str_shuffle("abcdefgABCDEFG123456789").$this->imagen_nombre;
        }
        public function guardar_imagen_ahora(){
            $ubicacion = $_SERVER['DOCUMENT_ROOT']."/psa/assets/img/imagen_recetas_tmp/".$this->imagen_nombre;
            move_uploaded_file($this->imagen,$ubicacion);
        }
        public function devolver_imagen_url(){
            $corr['url'] = "assets/img/imagen_recetas_tmp/".$this->imagen_nombre;
            $corr['correcto'] = true;
            echo json_encode($corr);
        }
        private function error($mensaje){
            $err['error'] = $mensaje;
            echo json_encode($err);
            die();
        }
    }
    $imagen = $_FILES['imagen'];
    $imagen_nueva = new guardar_imagen_tmp($imagen);
    $imagen_nueva->verificar_peso();
    $imagen_nueva->verificar_formato();
    $imagen_nueva->modificar_nombre();
    $imagen_nueva->guardar_imagen_ahora();
    $imagen_nueva->devolver_imagen_url();    
?>