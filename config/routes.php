<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/listaus_sivu', function() {
    HelloWorldController::listaus_sivu();
  });
  $routes->get('/reseptin_esittely', function(){
    HelloWorldController::reseptin_esittely();
  });
  $routes->get('/login', function(){
    HelloWorldController::login();
  });
