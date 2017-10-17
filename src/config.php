<?php 

  return [  
    'determineRouteBeforeAppMiddleware' => false,
    'outputBuffering' => false,
    'displayErrorDetails' => true,
    'db' => [
      'driver' => 'mysql',
      'host' => 'localhost',
      //'port' => '80',//'5432',
      'database' => 'slimeloquent',
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
    ]
  ];