<?php
require_once "BaseEntity.php";

class OrderDetail extends BaseEntity
{
    //--ATRIBUTOS
    public $id;
    public $orderId;
    public $name;
    public $short_description;
    public $description;
    public $quantity;
    public $price;
    public $type;


    public static function GetProductById($id)
    {
        $query = "SELECT * FROM order_detail WHERE id =:id";
        return parent::GetById($id, "OrderDetail", $query);
    }

    public static function GetDetailByOrderId($id){
        $query = "SELECT * FROM `order_detail` WHERE orderId = :id";
        return parent:: GetAllRelated($id, "OrderDetail", $query);
    }

    public static function GetAllProducts()
    {
        $query = "SELECT * FROM order_detail";
        return parent::GetAll("OrderDetail", $query);
    }

    public static function ProductDelete($id)
    {
        $query = "DELETE FROM order_detail WHERE id =:id";
        return parent::Delete($id,$query);
    }

    public static function ProductUpdate($id, $product)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update order_detail
            set name=:name,
            short_description=:short_description,
            description=:description,
            quantity=:quantity,
            price=:price,
            type =:type,
            orderId =:orderId
            WHERE id =:id");
        //$consulta =$objetoAccesoDato->RetornarConsulta("CALL Modificarproducto(:id,:nombre,:apellido,:foto)");
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);
        $consulta->bindValue(':name',$product->name, PDO::PARAM_STR);
        $consulta->bindValue(':short_description',$product->short_description, PDO::PARAM_STR);
        $consulta->bindValue(':description', $product->description, PDO::PARAM_STR);
        $consulta->bindValue(':price', $product->price, PDO::PARAM_INT);
        $consulta->bindValue(':quantity',$product->quantity, PDO::PARAM_INT);
        $consulta->bindValue(':type', $product->type, PDO::PARAM_STR);
        $consulta->bindValue(':orderId', $product->orderId, PDO::PARAM_STR);
        $consulta->execute(); 
        return $product;
    }

    public static function ProductCreate($product){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta= $objetoAccesoDato->RetornarConsulta("
            insert into order_detail
             (name, short_description, description,quantity,price,type,orderId)
            VALUES (:name, :short_description, :description,:quantity,:price,:type,:orderId)
        
        ");
        $consulta->bindValue(':name',$product->name, PDO::PARAM_STR);
        $consulta->bindValue(':short_description',$product->short_description, PDO::PARAM_STR);
        $consulta->bindValue(':description', $product->description, PDO::PARAM_STR);
        $consulta->bindValue(':price', $product->price, PDO::PARAM_INT);
        $consulta->bindValue(':quantity',$product->quantity, PDO::PARAM_INT);
        $consulta->bindValue(':type', $product->type, PDO::PARAM_STR);
        $consulta->bindValue(':orderId', $product->orderId, PDO::PARAM_STR);
        $consulta->execute();
        $product->id = $consulta->RetornarUltimoIdInsertado();
        return $product;
    }
    
    

}

?>
