<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];

    // Cargar el archivo Excel
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    // Crear conexión a la base de datos
    include 'configDB.php';
    $mysqli = new mysqli($host, $username, $password, $dbname);

    // Verificar la conexión
    if ($mysqli->connect_error) {
        die("Conexión fallida: " . $mysqli->connect_error);
    }

    // Insertar datos en la base de datos
    $mysqli->query("TRUNCATE TABLE datos"); // Limpiar la tabla antes de importar nuevos datos
    foreach ($data as $index => $row) {
        if ($index == 0) continue; // Saltar la fila de encabezado
        $sql = "INSERT INTO datos (anio, mes, cantidad_trabajadores, personal_administrativo, personal_operativo, actos_inseguros, condiciones_inseguras, accidentes, ac_operativas, ac_administrativos, otros_accidentes, incidentes, in_operativos, in_administrativos, otros_incidentes, indice_severidad, indice_frecuencia, indice_accidentabilidad, casos_covid_positivos, inspecciones_programadas, inspecciones_ejecutadas, capacitaciones_programadas, capacitaciones_ejecutadas, simulacros_programados, simulacros_ejecutados, passt_programadas, passt_ejecutadas, fecha_actualizacion) VALUES (
            '{$row[1]}', '{$row[2]}', '{$row[3]}', '{$row[4]}', '{$row[5]}', '{$row[6]}', '{$row[7]}', '{$row[8]}', '{$row[9]}', '{$row[10]}', '{$row[11]}', '{$row[12]}', '{$row[13]}', '{$row[14]}', '{$row[15]}', '{$row[16]}', '{$row[17]}', '{$row[18]}', '{$row[19]}', '{$row[20]}', '{$row[21]}', '{$row[22]}', '{$row[23]}', '{$row[24]}', '{$row[25]}', '{$row[26]}', '{$row[27]}', '{$row[28]}')";
        $mysqli->query($sql);
    }

    $mysqli->close();
    header('Location: dashboard.php');
    exit;
}