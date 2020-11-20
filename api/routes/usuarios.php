<?php

  use \SugarPuppy\SPException;

  include_once(__DIR__.'/../controllers/UsuarioController.php');
  
  $app->group('/usuarios', function () {

    $this->get('', function ($request) {
      
      $response_obj = [];
      $params = $request->getQueryParams();
      
      try {
        $usuarios = UsuarioController::buscar($params);
        
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';
        $response_obj['dados'] = $usuarios;

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'erro_query' => [500, 'erro_busca']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

    $this->post('/{id_usuario}/follow', function ($request, $response, $args) {
      
      $response_obj = [];
      $body = $request->getParsedBody();
      $body['id_usuario'] = $args['id_usuario'];
      
      try {
        UsuarioController::seguir($body);
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'sem_usuario' => [500, 'id_usuario_vazio'],
          'erro_query' => [500, 'erro_follow']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

    $this->post('/{id_usuario}/unfollow', function ($request, $response, $args) {
      
      $response_obj = [];
      $body = $request->getParsedBody();
      $body['id_usuario'] = $args['id_usuario'];
      
      try {
        UsuarioController::deixarDeSeguir($body);
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'sem_usuario' => [500, 'id_usuario_vazio'],
          'erro_query' => [500, 'erro_unfollow']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });
    
  });

?>