<?php 
class Conexion{
    public function get_conexion(){
        include ("datos.php");
        $conexion = new PDO("mysql:host=$host;dbname=coctelapp;", $user, $pass);
        return $conexion;
    }
}
?>
