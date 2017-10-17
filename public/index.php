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

  //Ruta para agregar devs
  $app->post('/devs', function (Request $request, Response $response) {
    
    $data = $request->getParsedBody();

    $dev = new Dev();
    try{

      if (!isset($data['name'])) throw new Exception("Error Processing Request, name is null or empty", 1);
      if (!isset($data['focus'])) throw new Exception("Error Processing Request, focus is null or empty", 1);
      if (!isset($data['hireDate'])) throw new Exception("Error Processing Request, hireDate is null or empty", 1);

      $dev->name = $data['name'];
      $dev->focus = $data['focus'];
      $dev->hireDate = $data['hireDate'];

      $dev->save();
    }catch (Exception $e){
      return "{\"error\":\"".$e->getMessage()."\"}";
    }

    return $response->withStatus(201)->getBody()->write('{"mensaje":"Dev agregado exitosamente"}');

  });

  //Ruta para eliminar devs
  $app->delete('/devs/{id}', function (Request $request, Response $response) {
    
    $id = $request->getAttribute('id');
    try{

      $dev = Dev::findOrFail($id);
      $dev->delete();
      return $response->withStatus(200);

    }catch (/* Illuminate\Database\Eloquent\ModelNotFoundException */ Exception $e){
      return '{"mensaje":"Dev not found, excepcion: '.$e->getMessage().'"}';
    }

    //return "HOLA";
  });


  //Costumers routes

  //require '../src/routes/customers.php';

  $app->run();