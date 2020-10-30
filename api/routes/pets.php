<?php

  use \SugarPuppy\SPException;

  include_once(__DIR__.'/../controllers/LoginController.php');
  
  $app->group('/pets', function () {

    $this->get('', function ($request) {
      
      $response_obj = [];
      $params = $request->getQueryParams();
      
      try {
        $pets = PetController::buscar($params);
        
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';
        $response_obj['dados'] = $pets;

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'erro_query' => [500, 'erro_busca']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

    $this->get('/caracteristicas', function ($request) {
      
      $response_obj = [];
      
      try {
        $caracteristicas = PetController::buscarCaracteristicas();
        
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';
        $response_obj['dados'] = $caracteristicas;

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'erro_query_cores' => [500, 'erro_cores'],
          'erro_query_estados' => [500, 'erro_estados'],
          'erro_query_cidades' => [500, 'erro_cidades'],
          'erro_query_animais' => [500, 'erro_animais'],
          'erro_query_racas' => [500, 'erro_racas']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

    $this->post('/{id_pet}/like', function ($request, $response, $args) {
      
      $response_obj = [];
      $body = $request->getParsedBody();
      $body['id_pet'] = $args['id_pet'];
      
      try {
        PetController::like($body);
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'sem_pet' => [500, 'id_pet_vazio'],
          'erro_query' => [500, 'erro_insercao']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

    $this->post('/{id_pet}/dislike', function ($request, $response, $args) {
      
      $response_obj = [];
      $body = $request->getParsedBody();
      $body['id_pet'] = $args['id_pet'];
      
      try {
        PetController::dislike($body);
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';

      } catch (Exception $e) {
        $response_obj = SPException::catch($e, [
          'sem_pet' => [500, 'id_pet_vazio'],
          'erro_query' => [500, 'erro_insercao']
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

  });

?>