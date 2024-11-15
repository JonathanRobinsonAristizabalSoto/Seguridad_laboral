<?php
// obtener_datos_dashboard.php

// Obtener la URL de la base de datos desde la variable de entorno
$url = parse_url(getenv("JAWSDB_URL"));

$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = substr($url["path"], 1);

// Crear conexión a la base de datos
$mysqli = new mysqli($host, $username, $password, $dbname);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}