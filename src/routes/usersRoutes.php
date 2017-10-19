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


