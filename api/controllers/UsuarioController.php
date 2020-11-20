<?php

use \SugarPuppy\Env;
use \SugarPuppy\DB;
use \SugarPuppy\SPException;

class UsuarioController {
  public static function buscar($filtros) {
    
    $q_select = "";
    $q_limit = " LIMIT 50 ";
    $q_where = "";

    if (isset($filtros['nome']))
      $q_where .= " AND nome like '%".$filtros['nome']."%' ";

    if (isset($filtros['email']))
      $q_where .= " AND email like '%".$filtros['email']."%' ";

    if (isset($filtros['id']))
      $q_where .= " AND id = ".$filtros['id'];

    if (isset($filtros['cuidador']))
      $q_where .= " AND cuidador = 'S' ";

    if (isset($filtros['limit']))
        $q_limit = " LIMIT ".$filtros['limit'];

    $query = "
    SELECT 
      id, nome, email, descricao, url_foto, url_capa, cuidador
      data_cadastro, data_atualizacao
    {$q_select}
    FROM usuario
    WHERE ativo = 'S'
      {$q_where} {$q_limit}";

    DB::getConnection();

    $usuarios = DB::fetchAll($query);

    if (is_null($usuarios)) {
      throw new SPException(500, "erro_query");
    }

    return $usuarios;
  }
}

?>