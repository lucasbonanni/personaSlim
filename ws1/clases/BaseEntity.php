<?php
require_once "AccesoDatos.php";
/**
 * Base class
 */
class BaseEntity
{


    public static function GetById($id, $classType, $query)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta($query);
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindValue(':id', $id, PDO::PARAM_INT);
		$consulta->execute();
		$personaBuscada= $consulta->fetchObject($classType);
		return $personaBuscada;
    }

    public static function GetAll($classType, $query)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta($query);
        //$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasPersonas() ");
        $consulta->execute();
        $arrPersonas= $consulta->fetchAll(PDO::FETCH_CLASS, $classType);
        return $arrPersonas;
    }

    public static function Update($id,$entity,$classType,$query)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update productos
            set nombre=:nombre,
            descripcion=:descripcion,
            precio=:precio
            WHERE id=:id");
    }

    public static function Delete($id,$query)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta($query);
        //$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarPersona(:id)");
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

}



 ?>
