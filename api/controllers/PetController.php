<?php

use \SugarPuppy\Env;
use \SugarPuppy\DB;
use \SugarPuppy\SPException;

class PetController {
  public static function buscar($filtros) {
    $id_usuario = Env::Get('id_usuario');
    
    $q_select = "";
    $q_join = "";
    $q_where = "";

    if (isset($filtros['animal']))
      $q_where .= " AND id_animal = ".$filtros['animal'];

    if (isset($filtros['raca']))
      $q_where .= " AND id_raca = ".$filtros['raca'];
    
    if (isset($filtros['cor']))
      $q_where .= " AND id_cor = ".$filtros['cor'];

    if (isset($filtros['estado']))
      $q_where .= " AND id_estado = ".$filtros['estado'];

    if (isset($filtros['cidade']))
      $q_where .= " AND id_cidade = ".$filtros['cidade'];
    
    if (isset($filtros['id']))
      $q_where .= " AND p.id = ".$filtros['id'];
    
    if (isset($filtros['nao_vinculado'])) {
      $q_where .= "
       AND pl.id_pet IS NULL";
    }

    $query = "
    SELECT 
      p.id, p.nome, p.descricao, p.url_foto,
      pl.like
    {$q_select}
    FROM pet p
    LEFT JOIN pet_like pl ON pl.id_pet = p.id
      AND pl.id_usuario = {$id_usuario}
    {$q_join}
    WHERE p.ativo = 'S'
      {$q_where}
    LIMIT 50";

    DB::getConnection();

    $pets = DB::fetchAll($query);

    if (is_null($pets)) {
      throw new SPException(500, "erro_query");
    }

    return $pets;
  }
  public static function buscarCaracteristicas() {
    $query_cor = "SELECT id, cor AS nome FROM pet_cor";
    $query_estado = "SELECT id, estado AS nome FROM pet_estado";
    $query_cidade = "SELECT id, cidade AS nome, id_estado FROM pet_cidade";
    $query_animal = "SELECT id, animal AS nome FROM pet_animal";
    $query_raca = "SELECT id, raca AS nome, id_animal FROM pet_raca";

    DB::getConnection();

    $cores = DB::fetchAll($query_cor);
    if (!$cores) {
      throw new SPException(500, "erro_query_cores");
    }
    $estados = DB::fetchAll($query_estado);
    if (!$estados) {
      throw new SPException(500, "erro_query_estados");
    }
    $cidades = DB::fetchAll($query_cidade);
    if (!$cidades) {
      throw new SPException(500, "erro_query_cidades");
    }
    $animais = DB::fetchAll($query_animal);
    if (!$animais) {
      throw new SPException(500, "erro_query_animais");
    }
    $racas = DB::fetchAll($query_raca);
    if (!$racas) {
      throw new SPException(500, "erro_query_racas");
    }

    return [
      'cores' => $cores,
      'estados' => $estados,
      'cidades' => $cidades,
      'animais' => $animais,
      'racas' => $racas
    ];
  }
  public static function buscarMeus() {
    $id_usuario = Env::Get('id_usuario');

    $query = "
    SELECT p.id, p.nome, p.url_foto
    FROM pet p
    WHERE p.ativo = 'S'
      AND p.id_usuario = {$id_usuario}";

    DB::getConnection();

    $pets = DB::fetchAll($query);

    if (is_null($pets)) {
      throw new SPException(500, "erro_query");
    }

    return $pets;
  }
  public static function like($dados) {

    if (!isset($dados['id_pet']) || empty($dados['id_pet'])) {
      throw new SPException(500, "sem_pet");
    }

    $id_pet = $dados['id_pet'];
    $id_usuario = Env::Get('id_usuario');

    $query_del = "
    DELETE FROM pet_like
    WHERE id_usuario = {$id_usuario}
      AND id_pet = {$id_pet}";

    $query = "
    INSERT INTO pet_like (
      id_usuario, id_pet, `like`
    ) VALUES (
      {$id_usuario}, {$id_pet}, 'S'
    )";

    DB::getConnection();

    DB::execute($query_del);
    $rs = DB::execute($query);

    if (!$rs) {
      throw new SPException(500, "erro_query");
    }

    return true;
  }
  public static function dislike($dados) {

    if (!isset($dados['id_pet']) || empty($dados['id_pet'])) {
      throw new SPException(500, "sem_pet");
    }

    $id_pet = $dados['id_pet'];
    $id_usuario = Env::Get('id_usuario');

    $query_del = "
    DELETE FROM pet_like
    WHERE id_usuario = {$id_usuario}
      AND id_pet = {$id_pet}";

    $query = "
    INSERT INTO pet_like (
      id_usuario, id_pet, `like`
    ) VALUES (
      {$id_usuario}, {$id_pet}, 'N'
    )";

    DB::getConnection();

    DB::execute($query_del);
    $rs = DB::execute($query);

    if (!$rs) {
      throw new SPException(500, "erro_query");
    }

    return true;
  }
}

?>