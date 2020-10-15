<?php

use \MV\Env;

class LoginController {
  private static $PRE_SALT = 'SUg4R';
  private static $POS_SALT = 'PuppY';

  private static function criarChaveAcesso($chave) {
    return password_hash(self::$PRE_SALT.$chave.self::$POS_SALT, PASSWORD_DEFAULT);
  }
  public static function validarChaveAcesso($chave, $cifra) {
    return password_verify(self::$PRE_SALT.$chave.self::$POS_SALT, $cifra);
  }

  public static function loginUsuario($dados) {
  }
  public static function carregarLogin($dados) {
  }
}

?>