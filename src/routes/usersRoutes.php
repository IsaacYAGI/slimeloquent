<?php

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  //API para obtener todos los users

  $app->get('/users', function (Request $request, Response $response) {
      
    $users = User::all();

    if (empty($users)){
      return "No users found";
    }else{
      return $users->toJson();
    }

      //return Dev::all()->toJson();
    //return "HOLA";
  });

  //API para los posts de un usuario

  $app->get('/userPosts/{id}', function (Request $request, Response $response) {
    
    $id = $request->getAttribute('id');
    try{

      $user = User::findOrFail($id);
      return $user->posts->toJson();

    }catch (/* Illuminate\Database\Eloquent\ModelNotFoundException */ Exception $e){
      return '{"mensaje":"User not found"}';
    }

      //return Dev::all()->toJson();
    //return "HOLA";
  });

  //API para obtener los datos de un usuario y todos los posts a los que esta asociado

  $app->get('/userAndPosts/{id}',function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    try{

      $user = User::findOrFail($id);
      
      $data = [];

      $user->posts;

      $data["usuario"] = $user;

      $response->getBody()->write(json_encode($data));

      return $response;

    }catch (/* Illuminate\Database\Eloquent\ModelNotFoundException */ Exception $e){
      return '{"mensaje":"User not found"}';
    }

  });

  //API para obtener todos los usuarios y los posts que posee cada uno

  $app->get('/usersAndPosts',function (Request $request, Response $response) {
    //$id = $request->getAttribute('id');

    try{
      $users = User::all();
      
      foreach ($users as $usuario) {
        $usuario->posts;
      }

      $data["usuarios"] = $users;

      $response->getBody()->write(json_encode($data));

    }catch(Exception $e){
      //echo $e->getMessage();
      return '{"mensaje":"Error: '.$e->getMessage().'"}';

    }

  });


