<?php

/* Ładowanie plików z katalogu Utils */
foreach (scandir(dirname(__FILE__)."\Utils") as $filename) {
    $path = dirname(__FILE__)."\Utils" . '/' . $filename;
    if (is_file($path)) {
        require $path;
    }
}

/* Ładowanie plików z katalogu Controllers */
require dirname(__FILE__)."\Controllers" . "/BaseController.php";
foreach (scandir(dirname(__FILE__)."\Controllers") as $filename) {
    $path = dirname(__FILE__)."\Controllers" . '/' . $filename;
    if (is_file($path) && $filename !== "BaseController.php") {
        require $path;
    }
}

/* Ładowanie plików z katalogu Entity */
foreach (scandir(dirname(__FILE__)."\Entity") as $filename) {
    $path = dirname(__FILE__)."\Entity" . '/' . $filename;
    if (is_file($path)) {
        require $path;
    }
}

/* Ładowanie plików z katalogu Repository */
foreach (scandir(dirname(__FILE__)."\Repository") as $filename) {
    $path = dirname(__FILE__)."\Repository" . '/' . $filename;
    if (is_file($path)) {
        require $path;
    }
}

$routeElements = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$routeElements = explode("/", $routeElements);
$routeElements = array_filter($routeElements);
$routeElements = array_splice($routeElements, 1);
$controller = isset($routeElements[0]) ? $routeElements[0] : "index";
$action = isset($routeElements[1]) ? $routeElements[1] : "index";

$class = "Controller\\".ucfirst($controller);

if (class_exists($class)) {
    $currentController = new $class();
    if (method_exists($currentController, $action)) {
        $currentController->$action();
    } else {
        echo "Metoda: $action w kontrolerze: $controller nie została zaimplementowana";
    }
} else {
    echo "Kontroler: $controller nie został zaimplementowany.";
}