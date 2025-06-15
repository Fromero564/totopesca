<?php
$request = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$path = str_replace($scriptName, '', $request);
$path = parse_url($path, PHP_URL_PATH);

switch ($path) {
    case '/':
    case '/home':
        require 'View/home.php';
        break;
    case '/login':
        require 'View/login.php';
        break;
    case '/dashboard':
        require 'View/dashboard.php';
        break;
    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}
