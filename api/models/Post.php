<?php

use \SugarPuppy\Env;
use \SugarPuppy\DB;

class Post {

  public static function inserir($dados) {

    $id_usuario = Env::Get('id_usuario');
    $conteudo = $dados['conteudo'];

    $query = "
    INSERT INTO post (
      id_usuario, conteudo, qtd_amei, data_cadastro, data_atualizacao, ativo
    ) VALUES (
      {$id_usuario}, '{$conteudo}', 0, NOW(), NOW(), 'S'
    )";

    DB::getConnection();
    $id = DB::getInsertedID($query);
    DB::closeConnection();
    return $id;
  }

  public static function inserir($dados) {
    $query = "";


    DB::getConnection();

    $result = static::execute($query);

    $response = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $response[] = $row;
      }
    }

    DB::closeConnection();

    return $response;
  }

}

?>