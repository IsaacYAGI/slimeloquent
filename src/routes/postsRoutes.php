<?php

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  //API para obtener todos los users
  $app->get('/posts', function (Request $request, Response $response) {
      
    $posts = Post::all();

    if (empty($posts)){
      return "No posts found";
    }else{
      return $posts->toJson();
    }

      //return Dev::all()->toJson();
    //return "HOLA";
  });

  
