<?php
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  //require '../vendor/autoload.php';
  //require '../src/config/db.php';
  require '../vendor/autoload.php';  
  require '../src/models/dev.php';  
  require '../src/handlers/exceptions.php';

  $config = include('../src/config.php');

  $app = new \Slim\App(['settings'=> $config]);

  $container = $app->getContainer();

  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($container['settings']['db']);
  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  $capsule->getContainer()->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
  );

  //$app = new \Slim\App;
  /*
  $app->get('/hello/{name}', function (Request $request, Response $response) {
      $name = $request->getAttribute('name');
      $response->getBody()->write("Hello, $name");

      return $response;
  });
  
  */

  //Se integran las rutas de otro archivo
  require '../src/routes/devsRoutes.php';


  //Costumers routes

  //require '../src/routes/customers.php';

  $app->run();