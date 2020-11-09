<?php

  use \SugarPuppy\SPException;

  include_once(__DIR__.'/../controllers/PostController.php');
  
  $app->group('/posts', function () {

    $this->get('', function ($request) {
      
      $response_obj = [];
      $params = $request->getQueryParams();
      
      try {
        $posts = PostController::buscar($params);
        
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';
        $response_obj['dados'] = $posts;

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'erro_query' => [500, 'erro_busca']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

    $this->post('', function ($request, $response, $args) {
      
      $response_obj = [];
      $body = $request->getParsedBody();
      $body['id_pet'] = $args['id_pet'];
      
      try {
        PostController::publicar($body);
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'erro_query' => [500, 'erro_insercao']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

    $this->post('/{id_post}/like', function ($request, $response, $args) {
      
      $response_obj = [];
      $body = $request->getParsedBody();
      $body['id_post'] = $args['id_post'];
      
      try {
        PostController::like($body);
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'sem_post' => [500, 'id_post_vazio'],
          'erro_query' => [500, 'erro_insercao']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

    $this->post('/{id_post}/dislike', function ($request, $response, $args) {
      
      $response_obj = [];
      $body = $request->getParsedBody();
      $body['id_post'] = $args['id_post'];
      
      try {
        PostController::dislike($body);
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'sem_pet' => [500, 'id_post_vazio'],
          'erro_query' => [500, 'erro_insercao']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

  });

?>