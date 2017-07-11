<?php
require_once "BaseEntity.php";

class product extends BaseEntity
{
    //--ATRIBUTOS
    public $id;
    public $name;
    public $short_description;
    public $description;
    public $quantity;
    public $price;
    public $band;
    public $type;
    public $image1;
    public $image2;
    public $image3;


    public static function GetProductById($id)
    {
        $query = "SELECT * FROM products WHERE id =:id";
        return parent::GetById($id, "product", $query);
    }

    public static function GetAllProducts()
    {
        $query = "SELECT * FROM products";
        return parent::GetAll("product", $query);
    }

    public static function ProductDelete($id)
    {
        $query = "DELETE FROM products WHERE id =:id";
        return parent::Delete($id,$query);
    }

    public static function ProductUpdate($id, $product)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update products
            set name=:name,
            short_description=:short_description,
            description=:description,
            quantity=:quantity,
            price=:price,
            band =:band,
            type =:type,
            image1 =:image1,
            image2 =:image2,
            image3 =:image3
            WHERE id =:id");
        //$consulta =$objetoAccesoDato->RetornarConsulta("CALL Modificarproducto(:id,:nombre,:apellido,:foto)");
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);
        $consulta->bindValue(':name',$product->name, PDO::PARAM_STR);
        $consulta->bindValue(':short_description',$product->short_description, PDO::PARAM_STR);
        $consulta->bindValue(':description', $product->description, PDO::PARAM_STR);
        $consulta->bindValue(':price', $product->price, PDO::PARAM_INT);
        $consulta->bindValue(':quantity',$product->quantity, PDO::PARAM_INT);
        $consulta->bindValue(':band', $product->band, PDO::PARAM_STR);
        $consulta->bindValue(':type', $product->type, PDO::PARAM_STR);
        $consulta->bindValue(':image1', $product->image1, PDO::PARAM_STR);
        $consulta->bindValue(':image2', $product->image2, PDO::PARAM_STR);
        $consulta->bindValue(':image3', $product->image3, PDO::PARAM_STR);
        $consulta->execute();
        return $product;
    }

    public static function ProductCreate($product){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta= $objetoAccesoDato->RetornarConsulta("
            insert into products
             (name, short_description, description,quantity,price,band,type,image1,image2,image3)
            VALUES (:name, :short_description, :description,:quantity,:price,:band,:type,:image1,:image2,:image3)
        
        ");
        $consulta->bindValue(':name',$product->name, PDO::PARAM_STR);
        $consulta->bindValue(':short_description',$product->short_description, PDO::PARAM_STR);
        $consulta->bindValue(':description', $product->description, PDO::PARAM_STR);
        $consulta->bindValue(':price', $product->price, PDO::PARAM_INT);
        $consulta->bindValue(':quantity',$product->quantity, PDO::PARAM_INT);
        $consulta->bindValue(':band', $product->band, PDO::PARAM_STR);
        $consulta->bindValue(':type', $product->type, PDO::PARAM_STR);
        $consulta->bindValue(':image1', $product->image1, PDO::PARAM_STR);
        $consulta->bindValue(':image2', $product->image2, PDO::PARAM_STR);
        $consulta->bindValue(':image3', $product->image3, PDO::PARAM_STR);
        $consulta->execute();
        $product->id = $objetoAccesoDato->RetornarUltimoIdInsertado();
        return $product;
    }
    
    

}

?>
