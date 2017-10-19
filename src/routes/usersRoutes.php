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

  
