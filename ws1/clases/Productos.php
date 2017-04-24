<?php
require_once "AccesoDatos.php";
class Producto
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $nombre;
 	public $descripcion;
  	public $precio;


//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	public function GetDescripcion()
	{
		return $this->descripcion;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetPrecio()
	{
		return $this->precio;
	}


	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function SetDescripcion($valor)
	{
		$this->descripcion = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetPrecio($valor)
	{
		$this->precio = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = Persona::TraerUnaPersona($id);

			$this->descripcion = $obj->descripcion;
			$this->nombre = $obj->nombre;
			$this->id = $id;
			$this->precio = $obj->precio;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING
  	public function ToString()
	{
	  	return $this->descripcion."-".$this->nombre."-".$this->id."-".$this->precio;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnProducto($idParametro)
	{


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from productos where id =:id");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$personaBuscada= $consulta->fetchObject('Producto');
		return $personaBuscada;

	}

	public static function TraerTodosLosProductos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from productos");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasPersonas() ");
		$consulta->execute();
		$arrPersonas= $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");
		return $arrPersonas;
	}

	public static function BorrarProducto($idParametro)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from productos	WHERE id=:id");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarPersona(:id)");
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);
		$consulta->execute();
		return $consulta->rowCount();
	}

	public static function ModificarProducto($producto)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update productos
				set nombre=:nombre,
				descripcion=:descripcion,
				precio=:precio
				WHERE id=:id");
			echo var_dump($producto);
			//$consulta =$objetoAccesoDato->RetornarConsulta("CALL Modificarproducto(:id,:nombre,:apellido,:foto)");
			$consulta->bindValue(':id',$producto->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$producto->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':descripcion', $producto->descripcion, PDO::PARAM_STR);
			$consulta->bindValue(':precio', $producto->precio, PDO::PARAM_INT);
			return $consulta->execute();
	}


	public static function BuscarProductos($order)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$fluentObj = AccesoDatos::dameUnFluentPDO();


		//$objetoAccesoDato->emulateToFalse();
		$offset = 0;
		$limit = 5;
		// $consulta = $objetoAccesoDato->RetornarConsulta("select * from productos LIMIT :offset,:limit");
		// //$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasPersonas() ");
		// $consulta->bindValue(':offset', $offset, PDO::PARAM_INT);
		// $consulta->bindValue(':limit', $limit, PDO::PARAM_INT);
		// $consulta->execute();

		$consulta = $fluentObj->from('productos')
						->orderBy($order)
            ->limit(5)
						->fetchAll();

		//$arrPersonas= $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");
		return $consulta;
	}


//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function InsertarProducto($producto)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into productos (nombre,descripcion,precio)values(:nombre,:descripcion,:precio)");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL Insertarproducto (:nombre,:descripcion,:dni,:precio)");
		$consulta->bindValue(':nombre',$producto->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':descripcion', $producto->descripcion, PDO::PARAM_STR);
		$consulta->bindValue(':precio', $producto->precio, PDO::PARAM_STR);
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();


	}



//--------------------------------------------------------------------------------//



	public static function TraerPersonasTest()
	{
		$arrayDePersonas=array();

		$persona = new stdClass();
		$persona->id = "4";
		$persona->nombre = "rogelio";
		$persona->apellido = "agua";
		$persona->dni = "333333";
		$persona->foto = "333333.jpg";

		//$objetJson = json_encode($persona);
		//echo $objetJson;
		$persona2 = new stdClass();
		$persona2->id = "5";
		$persona2->nombre = "Bañera";
		$persona2->apellido = "giratoria";
		$persona2->dni = "222222";
		$persona2->foto = "222222.jpg";

		$persona3 = new stdClass();
		$persona3->id = "6";
		$persona3->nombre = "Julieta";
		$persona3->apellido = "Roberto";
		$persona3->dni = "888888";
		$persona3->foto = "888888.jpg";

		$arrayDePersonas[]=$persona;
		$arrayDePersonas[]=$persona2;
		$arrayDePersonas[]=$persona3;



		return  $arrayDePersonas;

	}


}
