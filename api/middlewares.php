<?php

  use \SugarPuppy\Env;
  use \SugarPuppy\DB;

  use Psr\Http\Message\RequestInterface as Request;
  use Psr\Http\Message\ResponseInterface as Response;

  include_once(__DIR__.'/controllers/LoginController.php');

  // Middleware de CORS
  $cors_middleware = function(Request $request, Response $response, callable $next) {
    if ($request->isOptions() && strlen($request->getBody()) == 0) {
      return $response->withStatus(200)->write('"CORS OK"');
    }

    return $next($request, $response);
  };

  // Middleware de Conexao
  $db_middleware = function(Request $request, Response $response, callable $next) {

    $rs = $next($request, $response);

    // Fecha conexoes pendentes
    DB::closeConnection();

    return $rs;
  };

  // Middleware de Sessão
  $session_middleware = function(Request $request, Response $response, callable $next) {

    $headers_api = [
      'api-key',
      'access-key',
      'id-usuario'
    ];

    foreach ($headers_api as $header) {
      $head_value = $request->getHeader($header);

      if (!empty($head_value)) {
        $env_var = str_replace("-", "_", $header);
        Env::Set($env_var, $head_value[0]);
      }
    }

    return $next($request, $response);
  };

  // Middleware de Autenticação
  $auth_middleware = function(Request $request, Response $response, callable $next) {

    // Não autoriazado: chave de API Incorreta
    $api_key = "c4e00bb8f7d21b50fc56a91d775f61d2";
    if (Env::Get('api_key') != $api_key) {
      return $response->withStatus(401)->write('Forbidden: Invalid Api Key');
    }
    
    // Autorizado: método de acesso público
    $public_methods = [ 'POST-login' ];
    $uri = $request->getMethod().'-'.$request->getUri()->getPath();
    if (in_array($uri, $public_methods)) {
      $response = $response->withHeader('Content-type', 'application/json');
      return $next($request, $response);
    }

    // Não autoriazado: chave de Acesso Incorreta
    if (!LoginController::validarChaveAcesso(
      Env::Get('id_usuario'), 
      Env::Get('access_key')
    )) {
      return $response->withStatus(403)->write('Forbidden: Invalid Access Key');
    }


    try {
      LoginController::carregarLogin(Env::Get('id_usuario'));
    } catch (Exception $e) {
      // Não autorizado: login não é mais válido
      return $response->withStatus(403)->write('Forbidden: Login is not valid');
    }

    // Autorizado
    $response = $response->withHeader('Content-type', 'application/json');
    return $next($request, $response);
  };

  /* Os middlewares são executados na ordem inversa da subscricao, 
    ou seja, de baixo pra cima
  */
  $app->add($auth_middleware);
  $app->add($session_middleware);
  $app->add($db_middleware);
  $app->add($cors_middleware);

?>