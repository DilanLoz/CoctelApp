<?php 
class Mexbpedproc{
    //atributos
    private $idpedido;
    private $idcarrito;
    private $idmetpago;
    private $fecha_pedido;
    private $estado;
    private $total;

    //metodos get
	public function getIdpedido(){
		return $this->idpedido;
	}
    public function getIdcarrito(){
		return $this->idcarrito;
	}
    public function getIdmetpago(){
		return $this->idmetpago;
	}
    public function getFecha_pedido(){
		return $this->fecha_pedido;
	}
    public function getEstado(){
		return $this->estado;
	}
    public function getTotal(){
		return $this->total;
	}

    //metodos SET
	public function setIdpedido($idpedido){
		$this->idpedido =$idpedido;
	}
    public function setIdcarrito($idcarrito){
		$this->idcarrito =$idcarrito;
	}
    public function setIdmetpago($idmetpago){
		$this->idmetpago =$idmetpago;
	}
    public function setFecha_pedido($fecha_pedido){
		$this->fecha_pedido =$fecha_pedido;
	}
    public function setEstado($estado){
		$this->estado =$estado;
	}
    public function setTotal($total){
		$this->total =$total;
	}

    //metodos publicos
	public function getAll(){
		$res = NULL;
		$sql = "SELECT * FROM pedido";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res= $result->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}
    public function getOne(){
		$res = NULL;
		$sql = "SELECT * FROM pedido WHERE idpedido=:idpedido";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$id = $this->getId();
		$result->bindParam(":idpedido", $idpedido);
		$result->execute();
		$res= $result->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}
}
?>