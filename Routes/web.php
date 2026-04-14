<?php
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use App\Controllers\HomeController;
use App\Controllers\AdminController;

return simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    // admin
    $r->addRoute('GET', '/dashboard', [AdminController::class, 'index']);

});
