<?php
require "../vendor/autoload.php";

$router = new AltoRouter();

$router->map('GET', '/', 'posts', 'posts');
$router->map('GET', '/login', 'login', 'login');
$router->map('GET', '/fullPost', 'fullPost', 'fullPost');
$router->map('GET', '/admin', 'admin', 'admin');
$router->map('GET', '/adminEdit', 'adminEdit', 'adminEdit');
$router->map('GET', '/admin', 'admin', 'admin');

$match = $router->match();