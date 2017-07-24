<?php

require_once "BaseEntity.php";

class User extends BaseEntity {
    
    public $id;
    public $name;
    public $email;
    public $password;
    public $profile;
    public $enabled;
    public $shopId;
    
    
    public static function GetUserById($id)
    {
        $query = "SELECT * FROM users WHERE id =:id";
        return parent::GetById($id, "User", $query);
    }

    public static function GetAllUsers($profile)
    {
        $query = "";
        if(!empty($profile) && $profile == 'all')
        {
            $query = "SELECT * FROM users";
            return parent::GetAll("User", $query);
        }else
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $query = "SELECT * FROM users WHERE profile = :profile";
            $consulta =$objetoAccesoDato->RetornarConsulta($query);
            $consulta->bindValue(':profile', $profile, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_CLASS, 'User');
        }
    }

    public static function GetByProfileAndShop($shopId,$profile)
    {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $query = "SELECT * FROM users WHERE profile = :profile and shopId = :shopId";
            $consulta =$objetoAccesoDato->RetornarConsulta($query);
            $consulta->bindValue(':profile', $profile, PDO::PARAM_STR);
            $consulta->bindValue(':shopId', $shopId, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function UserDelete($id)
    {
        $query = "DELETE FROM users WHERE id =:id";
        return parent::Delete($id,$query);
    }

    public static function UserUpdate($id,$band)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update users
            set 
             name =:name,
             email =:email,
             password =:password,
             profile =:profile,
             enabled =:enabled,
             shopId =:shopId
            WHERE id =:id");
        $consulta->bindValue(':id',$id, PDO::PARAM_STR);
        $consulta->bindValue(':name', $band->name, PDO::PARAM_STR);
        $consulta->bindValue(':email', $band->email, PDO::PARAM_STR);
        $consulta->bindValue(':password', $band->password, PDO::PARAM_STR);
        $consulta->bindValue(':profile', $band->profile, PDO::PARAM_STR);
        $consulta->bindValue(':enabled', $band->enabled, PDO::PARAM_STR);
        $consulta->bindValue(':shopId', $band->shopId, PDO::PARAM_INT);
        $consulta->execute();
        return $band;
    }

    public static function UserCreate($product){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta= $objetoAccesoDato->RetornarConsulta("
            insert into users
             (name, email, password, profile, enabled,shopId)
            VALUES (:name, :email, :password, :profile,:enabled,:shopId)
        
        ");
        $consulta->bindValue(':name',$product->name, PDO::PARAM_STR);
        $consulta->bindValue(':email',$product->email, PDO::PARAM_STR);
        $consulta->bindValue(':password', $product->password, PDO::PARAM_STR);
        $consulta->bindValue(':profile',$product->profile, PDO::PARAM_STR);
        $consulta->bindValue(':enabled', $product->enabled, PDO::PARAM_STR);
        $consulta->bindValue(':shopId', $product->shopId, PDO::PARAM_INT);
        $consulta->execute();
        $product->id = $objetoAccesoDato->RetornarUltimoIdInsertado();
        return $product;
    }

    
	public static function FindUser($usuario)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select id, name, email, password, profile, enabled,shopId from users where email = :email");
		$consulta->bindValue(':email',$usuario->email, PDO::PARAM_STR);
		//echo var_dump($consulta);
		$consulta->execute();
		$personaBuscada= $consulta->fetchObject('User');
		return $personaBuscada;	
	}
    
}


?>