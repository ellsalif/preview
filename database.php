<?php
class Database
{
  private static $dbHost = "localhost";
  private static $dbName = "previewbdstable";
  private static $dbUser = "root";
  private static $dbUserPassword = "";
  private static $connection;
    
   public static function connect()
    {
        
        try
{
    self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,self::$dbUser,self::$dbUserPassword);
}
catch(PDOException $e)
{
    die($e->getMessage());
}
     
        return self::$connection;
    }
    
    public static function disConnect()
    {
       self:: $connection = null;
    }
    
}


?>