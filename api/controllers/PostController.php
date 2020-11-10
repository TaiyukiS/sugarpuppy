<?php

use \SugarPuppy\Env;
use \SugarPuppy\DB;
use \SugarPuppy\SPException;

class PostController {
  public static function buscar($filtros) {
    $q_join = "";
    $q_where = "";

    if (isset($filtros['post']))
      $q_where .= " AND p.id = ".$filtros['post'];

    if (isset($filtros['pet']))
      $q_where .= " AND p.id_pet = ".$filtros['pet'];

    $query = "
    SELECT 
      p.id, p.conteudo, p.qtd_amei, p.data_cadastro,
      p.id_usuario, p.id_pet,
      (CASE
        WHEN p.id_pet IS NOT NULL THEN pp.nome
        ELSE u.nome
      END) as nome_poster,
      pr.reacao
    FROM post p
    INNER JOIN usuario u ON u.id = p.id_usuario
    LEFT JOIN pet pp ON pp.id = p.id_pet
      AND pp.ativo = 'S'
    LEFT JOIN post_reacao pr ON pr.id_post = p.id
    WHERE p.ativo = 'S'
      AND u.ativo = 'S'
      {$q_where}
    LIMIT 50";

    DB::getConnection();

    $posts = DB::fetchAll($query);

    if (is_null($posts)) {
      throw new SPException(500, "erro_query");
    }

    return $posts;
  }
  public static function publicar($dados) {
    $id_pet = 'NULL';
    if (!empty($dados['id_pet'])) {
      $id_pet = $dados['id_pet'];
    }

    $conteudo = 'NULL';
    if (!empty($dados['conteudo'])) {
      $conteudo = "'".addslashes($dados['conteudo'])."'";
    }

    $url_foto = 'NULL';
    if (!empty($dados['url_foto'])) {
      $url_foto = "'".addslashes($dados['url_foto'])."'";
    }

    if ($conteudo == 'NULL' && $url_foto == 'NULL') {
      throw new SPException(500, "erro_vazio");
    }

    $id_usuario = Env::Get('id_usuario');

    $query = "
    INSERT INTO post (
      id_usuario, id_pet, conteudo, url_foto, data_cadastro, data_atualizacao, ativo
    ) VALUES (
      {$id_usuario}, {$id_pet}, {$conteudo}, {$url_foto}, NOW(), NOW(), 'S'
    )";

    DB::getConnection();

    $id_post = DB::getInsertedID($query);

    if (!$id_post) {
      throw new SPException(500, "erro_query");
    }

    $response = false;

    try {
      $response = static::buscar([ 'post' => $id_post ])[0];
    } catch (Exception $e) {
      // Do nothing
    }

    return $response;
  }
  public static function like($dados) {

    if (!isset($dados['id_post']) || empty($dados['id_post'])) {
      throw new SPException(500, "sem_post");
    }

    $id_post = $dados['id_post'];
    $id_usuario = Env::Get('id_usuario');

    $query = "
    INSERT INTO post_reacao (
      id_usuario, id_post, reacao
    ) VALUES (
      {$id_usuario}, {$id_post}, 1
    )";

    DB::getConnection();

    $rs = DB::execute($query);

    if (!$rs) {
      throw new SPException(500, "erro_query");
    }

    return true;
  }
  public static function dislike($dados) {

    if (!isset($dados['id_post']) || empty($dados['id_post'])) {
      throw new SPException(500, "sem_post");
    }

    $id_post = $dados['id_post'];
    $id_usuario = Env::Get('id_usuario');

    $query = "
    DELETE FROM post_reacao
    WHERE id_usuario = {$id_usuario}
      AND id_post = {$id_post}";

    DB::getConnection();

    $rs = DB::execute($query);

    if (!$rs) {
      throw new SPException(500, "erro_query");
    }

    return true;
  }
}

?>