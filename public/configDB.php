<?php


// ------------------------------
// base para desplegar en Heroku
// ------------------------------

// // Obtener la URL de la base de datos desde la variable de entorno
$url = parse_url(getenv("JAWSDB_URL"));

$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = substr($url["path"], 1);


// ------------------------------
// base para desplegar en local
// ------------------------------

// $host = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = 'seguridad_laboral';

// // Validar la conexión a la base de datos
// $mysqli = new mysqli($host, $username, $password, $dbname);

// if ($mysqli->connect_error) {
//     die("Conexión fallida: " . $mysqli->connect_error);
// }