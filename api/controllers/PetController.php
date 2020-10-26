<?php

use \SugarPuppy\Env;
use \SugarPuppy\DB;
use \SugarPuppy\SPException;

class PetController {
  public static function buscar($filtros) {
    $q_where = "";

    if (isset($filtros['animal']))
      $q_where .= " AND ".$filtros['animal'];

    if (isset($filtros['raca']))
      $q_where .= " AND ".$filtros['raca'];
    
    if (isset($filtros['cor']))
      $q_where .= " AND ".$filtros['cor'];

    if (isset($filtros['estado']))
      $q_where .= " AND ".$filtros['estado'];

    if (isset($filtros['cidade']))
      $q_where .= " AND ".$filtros['cidade'];

    $query = "
    SELECT id, nome, descricao, url_foto FROM pet
    WHERE ativo = 'S'
      {$q_where}
    LIMIT 50";

    DB::getConnection();

    $pets = DB::fetchAll($query);

    if (!$pets) {
      throw new SPException(500, "erro_query");
    }

    DB::closeConnection();

    return $pets;
  }
}

?>