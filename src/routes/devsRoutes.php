<?php

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

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

  //Ruta para modificar devs
  $app->put('/devs/{id}', function (Request $request, Response $response) {
    
    $id = $request->getAttribute('id');


    $data = $request->getParsedBody();

    try{

      $dev = Dev::findOrFail($id);

      if (!isset($data['name'])) throw new Exception("Error Processing Request, name is null or empty", 1);
      if (!isset($data['focus'])) throw new Exception("Error Processing Request, focus is null or empty", 1);
      if (!isset($data['hireDate'])) throw new Exception("Error Processing Request, hireDate is null or empty", 1);

      $dev->name = (!isset($data['name'])? $dev->name : $data['name']);
      $dev->focus = (!isset($data['focus'])? $dev->focus : $data['focus']);
      $dev->hireDate = (!isset($data['hireDate'])? $dev->hireDate : $data['hireDate']);

      $dev->save();
      //return $response->getBody()->write($dev->toJson());
    }catch (Exception $e){
      return "{\"error\":\"".$e->getMessage()."\"}";
    }

    return $response->withStatus(201)->getBody()->write('{"mensaje":"Dev modificado exitosamente"}');

  });
