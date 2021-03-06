<?php


$routes->get('/', function() {
    AskareController::index(); 
});

$routes->post('/askare', function() {
    AskareController::store();
});

$routes->get('/askare/new', function() {
    AskareController::create();
});

$routes->get('/askare/:id', function($id) {
    AskareController::show($id);
});
$routes->get('/askare/:id/edit', function($id){
	AskareController::edit($id);
});
$routes->post('/askare/:id/edit', function($id){
	AskareController::update($id);
});
$routes->post('/askare/:id/destroy', function($id){
	AskareController::destroy($id);
});


#KayttajaController

$routes->get('/login', function(){
	KayttajaController::login();
});
$routes->post('/login', function(){
	KayttajaController::handle_login();
});
$routes->get('/logout', function(){
	KayttajaController::logout();
});


#PaikkaController

$routes->get('/paikat', function(){
	PaikkaController::index();
});
$routes->get('/paikka/new', function(){
	PaikkaController::create();
});
$routes->post('/paikka', function(){
	PaikkaController::store();
});
$routes->get('/paikka/:id', function($id){
	PaikkaController::show($id);
});





$routes->get('/hiekkalaatikko', function(){
	HelloWorldController::sandbox();
});

