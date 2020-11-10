<?php

namespace SugarPuppy;

class DB {
  private static $host = "database-1.c0j7lrmnjkkq.sa-east-1.rds.amazonaws.com";
  private static $user = "admin";
  private static $senha = "sugarpuppy";
  private static $dbase = "sugarpyppy";
  private static $port = "3306";

  private static $instance = null;

  public static function init() {
    if (!isset(static::$instance)) {
      static::$instance = mysqli_connect(
        static::$host, 
        static::$user, 
        static::$senha, 
        static::$dbase
      );
    }
  }

  public static function getConnection() {
    if (!isset(static::$instance)) {
      static::init();
    }
    return static::$instance;
  }

  public static function closeConnection() {
    if (isset(static::$instance)) {
      static::$instance->close();
    }
  }

  /* Operação para inserção */
  public static function getInsertedID($query) {
    $rs = static::execute($query);
    if (!$rs) {
      return false;
    } else {
      return static::$instance->insert_id;
    }
  }

  public static function execute($query) {
    if (!isset(static::$instance)) {
      static::init();
    }
    return static::$instance->query($query);
  }

  public static function fetchAll($query) {
    $result = static::execute($query);
    if (!$result) {
      return null;
    }
    
    $acc = [];
    while ($row = $result->fetch_assoc())
      $acc[] = $row;
    return $acc;
  }
}

?>