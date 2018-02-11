<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function(){
    HelloWorldController::login();
  });
  
  $routes->post('/resepti', function(){
   ReseptiController::store();
  });
   $routes->get('/resepti/uusi', function(){
   ReseptiController::luoUusi();
   });
  
  $routes->get('/resepti', function(){
    ReseptiController::index();
  });
  $routes->get('/resepti/:tunnus', function($tunnus){
    ReseptiController::show($tunnus);
  });

  $routes->get('/ruokaLista', function(){
    HelloWorldController::ruokaLista();
  });
 
  
   $routes->get('/etusivu', function(){
    ReseptiController::index();
  });
  
  $routes->get('/resepti/:tunnus/edit', function($tunnus){
  ReseptiController::edit($tunnus);
});
$routes->post('/resepti/:tunnus/edit', function($tunnus){
  ReseptiController::update($tunnus);
});

$routes->post('/resepti/:tunnus/destroy', function($tunnus){
  ReseptiController::destroy($tunnus);
});
  $routes->get('/resepti/:tunnus/destroy', function($tunnus){
  ReseptiController::destroy($tunnus);
});
  
   