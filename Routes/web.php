<?php
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\CategoryController;

return simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    // admin
    $r->addRoute('GET', '/dashboard', [AdminController::class, 'index']);
    // categories
    $r->addRoute('GET', '/categories/create', [CategoryController::class, 'create']);
    // save category
    $r->addRoute('POST', '/categories/save_category', [CategoryController::class, 'store']);
    // list category
    $r->addRoute('GET', '/categories/list', [CategoryController::class, 'index']);
    // edit category
    $r->addRoute('GET', '/categories/edit', [CategoryController::class, 'index']);
});
