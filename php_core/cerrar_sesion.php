<?php
    session_start();
    class cerrar_sesion{
        public function eliminar_session(){
            session_destroy();
        }
        public function redireccionar_pagina(){
            setcookie('correcto','cerraste sesión con éxito',time()+1,"/");
            header("Location:../index.php");
        }
    }
    $usuario = new cerrar_sesion();
    $usuario->eliminar_session();
    $usuario->redireccionar_pagina();
?>