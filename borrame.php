<?php
$clave = "soriano123456789";
$usuario = "paula";
$clave = password_hash($clave,PASSWORD_BCRYPT,['cost' => 11]);
$conexion = new mysqli("localhost","root","","psa");
$conexion->query("INSERT INTO usuario(usuario,clave) VALUES ('$usuario','$clave')");
$conexion->close();
echo "listo";
?>