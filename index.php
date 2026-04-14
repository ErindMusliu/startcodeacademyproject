<?php
require __DIR__ . '/vendor/autoload.php';

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// PSR-4 friendly: trim folderin bazë në localhost
$basePath = '/startcodeacademy-project'; // ndrysho në folderin tënd
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$dispatcher = require __DIR__ . '/Routes/web.php';
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo "404 - Page not found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        $allowedMethods = $routeInfo[1];
        echo "405 - Method not allowed. Allowed: " . implode(', ', $allowedMethods);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$class, $method] = $handler;
        if (class_exists($class) && method_exists($class, $method)) {
            $controller = new $class();
            call_user_func_array([$controller, $method], $vars);
        } else {
            http_response_code(500);
            echo "Handler not found: $class::$method";
        }
        break;
}
