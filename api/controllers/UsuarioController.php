<?php

use \SugarPuppy\Env;
use \SugarPuppy\DB;
use \SugarPuppy\SPException;

class UsuarioController {
  public static function buscar($filtros) {
    $id_usuario = Env::Get('id_usuario');

    $q_select = "";
    $q_limit = " LIMIT 50 ";
    $q_where = "";

    if (isset($filtros['nome']))
      $q_where .= " AND u.nome like '%".$filtros['nome']."%' ";

    if (isset($filtros['email']))
      $q_where .= " AND u.email like '%".$filtros['email']."%' ";

    if (isset($filtros['id']))
      $q_where .= " AND u.id = ".$filtros['id'];

    if (isset($filtros['cuidador']))
      $q_where .= " AND u.cuidador = 'S' ";

    if (isset($filtros['limit']))
        $q_limit = " LIMIT ".$filtros['limit'];

    $query = "
    SELECT 
      u.id, u.nome, u.email, u.descricao, u.url_foto, u.url_capa, u.cuidador, u.data_cadastro, u.data_atualizacao,
      (CASE
        WHEN us.id_usuario_seguidor IS NOT NULL THEN 1
        ELSE NULL
      END) as seguindo
    {$q_select}
    FROM usuario u
    LEFT JOIN usuario_seguidor us ON us.id_usuario_seguido = u.id
      AND us.id_usuario_seguidor = {$id_usuario}
    WHERE u.ativo = 'S'
      {$q_where} {$q_limit}";

    DB::getConnection();

    $usuarios = DB::fetchAll($query);

    if (is_null($usuarios)) {
      throw new SPException(500, "erro_query");
    }

    return $usuarios;
  }
  public static function seguir($dados) {
    if (!isset($dados['id_usuario']) || empty($dados['id_usuario'])) {
      throw new SPException(500, "sem_usuario");
    }

    $id_usuario = $dados['id_usuario'];
    $id_eu = Env::Get('id_usuario');

    $query = "
    INSERT INTO usuario_seguidor (
      id_usuario_seguidor, id_usuario_seguido
    ) VALUES (
      {$id_eu}, {$id_usuario}
    )";

    DB::getConnection();

    $rs = DB::execute($query);

    if (!$rs) {
      throw new SPException(500, "erro_query");
    }

    return true;
  }
  public static function deixarDeSeguir($dados) {
    if (!isset($dados['id_usuario']) || empty($dados['id_usuario'])) {
      throw new SPException(500, "sem_usuario");
    }

    $id_usuario = $dados['id_usuario'];
    $id_eu = Env::Get('id_usuario');

    $query = "
    DELETE FROM usuario_seguidor
    WHERE id_usuario_seguidor = {$id_eu}
      AND id_usuario_seguido = {$id_usuario}";
    error_log($query);
    DB::getConnection();

    $rs = DB::execute($query);

    if (!$rs) {
      throw new SPException(500, "erro_query");
    }

    return true;
  }
}

?>