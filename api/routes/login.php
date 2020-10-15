<?php

  include_once(__DIR__.'/../controllers/LoginController.php');
  
  $app->group('/login', function () {

    $this->post('', function ($request) {
      
      $response_obj = [];
      $body = $request->getParsedBody();
      
      try {
        $login = LoginController::loginUsuario($body);
        
        $response_obj['status'] = 200;
        $response_obj['msg'] = 'ok';
        $response_obj['dados'] = $login;

      } catch (Exception $e) {
        $response_obj = MVException::catch($e, [
          'campos_invalidos' => [500, 'campos_invalidos'],
          'campos_incorretos' => [404, 'campos_incorretos'],
          'nao_ativo' => [500, 'nao_ativo'],
        ]);
      }

      echo json_encode($response_obj, JSON_NUMERIC_CHECK);
    });

  });

?>