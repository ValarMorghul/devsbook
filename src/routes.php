<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'UserController@login');
$router->post('/login', 'UserController@loginAction');

$router->get('/cadastro', 'UserController@cadastro');
$router->post('/cadastro', 'UserController@cadastroAction');

$router->get('/perfil', 'HomeController@perfil');

$router->get('/logout', 'UserController@logout');

$router->post('/post/{id}', 'PostController@post');