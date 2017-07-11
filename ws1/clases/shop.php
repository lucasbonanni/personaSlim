<?php
require_once "BaseEntity.php";

class shop extends BaseEntity
{
    //--ATRIBUTOS
    public $id;
    public $name;
    public $street;
    public $city;
    public $phone;
    public $image1;
    public $image2;
    public $image3;


    public static function GetShopById($id)
    {
        $query = "SELECT * FROM shops WHERE id =:id";
        return parent::GetById($id, "shop", $query);
    }

    public static function GetAllShops()
    {
        $query = "SELECT * FROM shops";
        return parent::GetAll("shop", $query);
    }

    public static function ShopDelete($id)
    {
        $query = "DELETE FROM shops WHERE id =:id";
        return parent::Delete($id,$query);
    }

    public static function ShopUpdate($id, $shop)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update shops
            set name=:name,
            street=:street,
            city=:city,
            phone=:phone,
            image1 =:image1,
            image2 =:image2,
            image3 =:image3
            WHERE id =:id");
        //$consulta =$objetoAccesoDato->RetornarConsulta("CALL Modificarshopo(:id,:nombre,:apellido,:foto)");
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);
        $consulta->bindValue(':name',$shop->name, PDO::PARAM_STR);
        $consulta->bindValue(':street',$shop->street, PDO::PARAM_STR);
        $consulta->bindValue(':city', $shop->city, PDO::PARAM_STR);
        $consulta->bindValue(':phone',$shop->phone, PDO::PARAM_INT);
        $consulta->bindValue(':image1', $shop->image1, PDO::PARAM_STR);
        $consulta->bindValue(':image2', $shop->image2, PDO::PARAM_STR);
        $consulta->bindValue(':image3', $shop->image3, PDO::PARAM_STR);
        $consulta->execute();
        return $shop;
    }

    public static function ShopCreate($shop){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta= $objetoAccesoDato->RetornarConsulta("
            insert into shops
             (name, street, city,phone,image1,image2,image3)
            VALUES (:name, :street, :city,:phone,:image1,:image2,:image3)
        
        ");
        $consulta->bindValue(':name',$shop->name, PDO::PARAM_STR);
        $consulta->bindValue(':street',$shop->street, PDO::PARAM_STR);
        $consulta->bindValue(':city', $shop->city, PDO::PARAM_STR);
        $consulta->bindValue(':phone',$shop->phone, PDO::PARAM_INT);
        $consulta->bindValue(':image1', $shop->image1, PDO::PARAM_STR);
        $consulta->bindValue(':image2', $shop->image2, PDO::PARAM_STR);
        $consulta->bindValue(':image3', $shop->image3, PDO::PARAM_STR);
        $consulta->execute();
        $shop->id = $objetoAccesoDato->RetornarUltimoIdInsertado();
        return $shop;
    }
    
    

}

?>
