<?php
require_once 'libs/response.php';
require_once 'libs/router.php';
require_once 'controllers/player.api.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$router = new Router();


#                 endpoint        verbo      controller              metodo
$router->addRoute('jugadores',    'GET',     'playerApiController',   'getAllplayers');
$router->addRoute('jugadores/:sort_filter/:sort_mode', 'GET',     'playerApiController',   'getAllplayers');
$router->addRoute('jugadores/:id','GET',     'playerApiController',   'getPlayerById');
$router->addRoute('jugadores/:id','DELETE',  'playerApiController',   'deletePlayerById');
$router->addRoute('jugadores' ,    'POST',    'playerApiController',   'createPlayer');
$router->addRoute('jugadores/:id', 'PUT',     'playerApiController',   'updatePlayerById');
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
