<?php

require_once "BaseEntity.php";

class product extends BaseEntity
{
    //--ATRIBUTOS
    public $product_id;
    public $name;
    public $description;
    public $quantity;
    public $price;
    public $band_id;
    public $product_type;


    public static function GetProductById($id)
    {
        $query = "SELECT * FROM products WHERE product_id =:id";
        return parent::GetById($id, "product", $query);
    }

    public static function GetAllProducts()
    {
        $query = "SELECT * FROM products";
        return parent::GetAll("product", $query);
    }

    public static function ProductDelete($id)
    {
        $query = "DELETE FROM products WHERE product_id =:id";
        return parent::Delete($id,$query);
    }

    public static function ProductUpdate($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update products
            set name=:name,
            description=:description,
            quantity=:quantity,
            price=:price,
            band_id =:band_id,
            product_type_id =: product_type_id
            WHERE product_id =:id");
        //$consulta =$objetoAccesoDato->RetornarConsulta("CALL Modificarproducto(:id,:nombre,:apellido,:foto)");
        $consulta->bindValue(':product_id',$id, PDO::PARAM_INT);
        $consulta->bindValue(':name',$producto->name, PDO::PARAM_STR);
        $consulta->bindValue(':description', $producto->description, PDO::PARAM_STR);
        $consulta->bindValue(':price', $producto->price, PDO::PARAM_INT);
        $consulta->bindValue(':quantity',$producto->quantity, PDO::PARAM_STR);
        $consulta->bindValue(':band_id', $producto->band_id, PDO::PARAM_STR);
        $consulta->bindValue(':product_type_id', $producto->product_type_id, PDO::PARAM_INT);
        return $consulta->execute();
    }
    
    

}

?>
