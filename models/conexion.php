<?php 
class conexion{
	public function get_conexion(){
		include ("datos.php");
		$conexion=new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
		
		return $conexion;
	}
}
?>
