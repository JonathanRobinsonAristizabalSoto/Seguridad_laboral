<?php
// Obtener la URL de la base de datos desde la variable de entorno
$url = parse_url(getenv("JAWSDB_URL"));

$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = substr($url["path"], 1);