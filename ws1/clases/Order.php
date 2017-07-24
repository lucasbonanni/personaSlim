<?php
require_once "BaseEntity.php";

class order extends BaseEntity
{
    //--ATRIBUTOS
    public $id;
    public $userId;
    public $totalPrice;
    public $date;
    public $state;
    public $detailId;
    public $userName;
    public $userStreet;


    public static function GetProductById($id)
    {
        $query = "SELECT * FROM orders WHERE id =:id";
        return parent::GetById($id, "order", $query);
    }

    public static function GetAllProducts()
    {
        $query = "SELECT * FROM orders";
        return parent::GetAll("order", $query);
    }

    public static function ProductDelete($id)
    {
        $query = "DELETE FROM orders WHERE id =:id";
        return parent::Delete($id,$query);
    }

    public static function ProductUpdate($id, $order)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update orders
            set userId=:userId,
            totalPrice=:totalPrice,
            date=:date,
            state =:state,
            userName =:userName,
            userStreet =:userStreet
            WHERE id =:id");
        //$consulta =$objetoAccesoDato->RetornarConsulta("CALL Modificarproducto(:id,:nombre,:apellido,:foto)");
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);
        $consulta->bindValue(':userId',$order->userId, PDO::PARAM_INT);
        $consulta->bindValue(':totalPrice',$order->totalPrice, PDO::PARAM_INT);
        $consulta->bindValue(':date', $order->date, PDO::PARAM_STR);
        $consulta->bindValue(':state',$order->state, PDO::PARAM_STR);
        $consulta->bindValue(':userName', $order->userName, PDO::PARAM_STR);
        $consulta->bindValue(':userStreet', $order->userStreet, PDO::PARAM_STR);
        $consulta->execute();
        return $order;
    }

    public static function ProductCreate($order){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta= $objetoAccesoDato->RetornarConsulta("
            insert into orders
             (userId, totalPrice, date,state,userName,userStreet)
            VALUES (:userId, :totalPrice, :date,:state,:userName,:userStreet)
        
        ");
        $consulta->bindValue(':userId',$order->userId, PDO::PARAM_INT);
        $consulta->bindValue(':totalPrice',$order->totalPrice, PDO::PARAM_INT);
        $consulta->bindValue(':date', $order->date, PDO::PARAM_STR);
        $consulta->bindValue(':state',$order->state, PDO::PARAM_STR);
        $consulta->bindValue(':userName', $order->userName, PDO::PARAM_STR);
        $consulta->bindValue(':userStreet', $order->userStreet, PDO::PARAM_STR);
        $consulta->execute();
        $order->id = $objetoAccesoDato->RetornarUltimoIdInsertado();
        return $order;
    }
    
    public static function GetTotalAmountByMonth(){
        
        $objetoAccesoDatos = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDatos->RetornarConsulta(
        "select DATE_FORMAT(date,'%M') as month, sum(totalPrice) as totalamount from orders group by  month(date), year(date)");
        $consulta->execute();
        $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

}

?>
