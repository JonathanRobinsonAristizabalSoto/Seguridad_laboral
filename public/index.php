<?php
// index.php

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

switch ($requestMethod) {
    case 'GET':
        if ($requestUri == '/') {
            // Manejar la solicitud GET para la ruta raíz
            include 'home.php';
        } elseif ($requestUri == '/dashboard') {
            // Manejar la solicitud GET para la ruta /dashboard
            include 'dashboard.php';
        }
        // Agrega más rutas GET según sea necesario
        break;

    case 'POST':
        if ($requestUri == '/actualizar') {
            // Manejar la solicitud POST para la ruta /actualizar
            include 'actualizar.php';
        }
        // Agrega más rutas POST según sea necesario
        break;

    // Agrega más métodos HTTP según sea necesario

    default:
        // Manejar métodos HTTP no permitidos
        header('HTTP/1.1 405 Method Not Allowed');
        echo 'Method Not Allowed';
        break;
}