<?php

require_once "BaseEntity.php";

class Categories extends BaseEntity {
    
    public $category_id;
    public $name;
    
    public static function GetCategoryById($id)
    {
        $query = "SELECT * FROM category WHERE category_id =:id";
        return parent::GetById($id, "Categories", $query);
    }

    public static function GetAllCategories()
    {
        $query = "SELECT * FROM category";
        return parent::GetAll("Categories", $query);
    }

    public static function DeleteById($id)
    {
        $query = "DELETE FROM category WHERE category_id =:id";
        return parent::Delete($id,$query);
    }
        
    
    public static function UpdateById($id,$category)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update catetory
            set name=:name,
            WHERE category_id =:id");
        $consulta->bindValue(':name',$category->name, PDO::PARAM_STR);
        $consulta->bindValue(':style_id', $category->style_id, PDO::PARAM_INT);
        return $consulta->execute();
    }
    
    /*Add query to get the categories related justo related to bands (maybe) */    
    
}

?>