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
  $routes->get('/resepti', function(){
    HelloWorldController::resepti();
  });
  $routes->get('/login', function(){
    HelloWorldController::login();
  });
  $routes->get('/etusivu', function(){
    HelloWorldController::etusivu();
  });