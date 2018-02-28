<?php


$routes->get('/hiekkalaatikko', function() {
HelloWorldController::sandbox();
});

$routes->post('/resepti', function() {
    ReseptiController::store();
});
$routes->get('/resepti/uusi', function() {
    ReseptiController::luoUusi();
});
$routes->get('/', function() {
    ReseptiController::alku();
});
$routes->get('/resepti/:tunnus', function($tunnus) {
    ReseptiController::show($tunnus);
});
$routes->get('/index', function() {
    ReseptiController::index();
});
$routes->get('/resepti/:tunnus/edit', function($tunnus) {
    ReseptiController::edit($tunnus);
});
$routes->post('/resepti/:tunnus/edit', function($tunnus) {
    ReseptiController::update($tunnus);
});
$routes->post('/resepti/:tunnus/destroy', function($tunnus) {
    ReseptiController::destroy($tunnus);
});
$routes->get('/resepti/:tunnus/destroy', function($tunnus) {
    ReseptiController::destroy($tunnus);
});


$routes->get('/login', function() {
    UserController::login();
});
$routes->post('/login', function() {
    UserController::handle_login();
});
$routes->post('/logout', function() {
    UserController::logout();
});


$routes->get('/listaus', function() {
    KategoriaController::index();
});
$routes->get('/listaus/uusi', function() {
    KategoriaController::uusi();
});
$routes->post('/uusi', function() {
    KategoriaController::store();
});
$routes->post('/listaus/:tunnus/destroy', function($tunnus) {
    KategoriaController::destroy($tunnus);
});
