<?php
require "../vendor/autoload.php";

$router = new AltoRouter();

$router->map('GET', '/', 'posts', 'posts');
$router->map('GET', '/login', 'login', 'login');
$router->map('GET', '/posts/[*:slug]-[i:id]', 'posts/post', 'post');
$router->map('GET', '/admin', 'admin', 'admin');

$match = $router->match();