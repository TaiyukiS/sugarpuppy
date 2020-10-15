<?php

namespace SugarPuppy;

class Env {
  static $vars = [];

  public static function Get($key) {
    if (isset(self::$vars[$key]) ) {
      return self::$vars[$key];
    } else {
      return false;
    }
  }

  public static function Set($key, $value) {
    return self::$vars[$key] = $value;
  }

  public static function Unset($key) {
    unset(self::$vars[$key]);
    return true;
  }
}

?>