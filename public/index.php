<?php
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  require '../vendor/autoload.php';
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

  //API para obtener todos los devs
  $app->get('/devs', function (Request $request, Response $response) {
      
    $devs = Dev::all();

    if (empty($devs)){
      return "No devs found";
    }else{
      return Dev::all()->toJson();
    }

      //return Dev::all()->toJson();
    //return "HOLA";
  });

  //API para obtener un solo dev por su id
  $app->get('/devs/{id}', function (Request $request, Response $response) {
    
    $id = $request->getAttribute('id');
    try{

      $dev = Dev::findOrFail($id);
      return $dev->toJson();

    }catch (/* Illuminate\Database\Eloquent\ModelNotFoundException */ Exception $e){
      return '{"mensaje":"Dev not found"}';
    }

    //return "HOLA";
  });

  //Costumers routes

  //require '../src/routes/customers.php';

  $app->run();