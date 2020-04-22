<?php
namespace KeenFram;
 
class PDOFactory
{
  public static function getMysqlConnexion($dbname = 'news')
  {
    $db = new \PDO('mysql:host=localhost;dbname='.$dbname, 'root', '');
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
 
    return $db;
  }
}