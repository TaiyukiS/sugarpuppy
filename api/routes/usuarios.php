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
    
  });

?>