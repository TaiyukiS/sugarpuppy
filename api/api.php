<?php
  
  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS, DELETE');
  header('Access-Control-Allow-Headers: content-type, api-key, access-key, id-usuario');

  include_once(__DIR__.'/Env.php');
  include_once(__DIR__.'/Exception.php');

  $app = new \Slim\App();

  include_once(__DIR__.'/middlewares.php');
  include_once(__DIR__.'/routes/check.php');

  $app->run();

?>