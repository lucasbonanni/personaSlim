<?php
require_once "BaseEntity.php";

class band extends BaseEntity {
    
    
    public $band_id;
    public $name;
    public $style_id;
    
    public static function GetBandById($id)
    {
        $query = "SELECT * FROM bands WHERE band_id =:id";
        return parent::GetById($id, "Band", $query);
    }

    public static function GetAllBands()
    {
        $query = "SELECT * FROM bands";
        return parent::GetAll("Band", $query);
    }

    public static function BandDelete($id)
    {
        $query = "DELETE FROM bands WHERE band_id =:id";
        return parent::Delete($id,$query);
    }

    public static function BandUpdate($id,$band)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update bands
            set name=:name,
            style_id =: product_type_id
            WHERE band_id =:id");
        $consulta->bindValue(':band_id',$id, PDO::PARAM_INT);
        $consulta->bindValue(':name',$band->name, PDO::PARAM_STR);
        $consulta->bindValue(':style_id', $band->style_id, PDO::PARAM_INT);
        return $consulta->execute();
    }
}


?>