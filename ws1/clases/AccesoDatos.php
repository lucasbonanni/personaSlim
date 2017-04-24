<?php
//require "vendor/lichtner/fluentpdo/FluentPDO/FluentPDO.php";

class AccesoDatos
{
    private static $ObjetoAccesoDatos;
    private $objetoPDO;
    private static $fluentPDO;

    private function __construct()
    {
        try {
            $this->objetoPDO = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
            self::$fluentPDO = new FluentPDO($this->objetoPDO);
            }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public function RetornarConsulta($sql)
    {
        return $this->objetoPDO->prepare($sql);
    }

     public function RetornarUltimoIdInsertado()
    {
        return $this->objetoPDO->lastInsertId();
    }

    public static function dameUnObjetoAcceso()
    {
        if (!isset(self::$ObjetoAccesoDatos)) {
            self::$ObjetoAccesoDatos = new AccesoDatos();
        }
        return self::$ObjetoAccesoDatos;
    }

    public static function dameUnFluentPDO()
    {
        self::$ObjetoAccesoDatos = new AccesoDatos();
        return self::$fluentPDO;
    }

    public function emulateToFalse()
    {
      $this->objetoPDO->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
    }

     // Evita que el objeto se pueda clonar
    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }
}
?>
