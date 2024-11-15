<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear conexión a la base de datos
include 'configDB.php';
$mysqli = new mysqli($host, $username, $password, $dbname);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Obtener los datos desde la base de datos
$sql = "SELECT * FROM datos";
$result = $mysqli->query($sql);

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Agregar encabezados
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Año');
$sheet->setCellValue('C1', 'Mes');
$sheet->setCellValue('D1', 'Cantidad Trabajadores');
$sheet->setCellValue('E1', 'Personal Administrativo');
$sheet->setCellValue('F1', 'Personal Operativo');
$sheet->setCellValue('G1', 'Actos Inseguros');
$sheet->setCellValue('H1', 'Condiciones Inseguras');
$sheet->setCellValue('I1', 'Accidentes');
$sheet->setCellValue('J1', 'AC Operativas');
$sheet->setCellValue('K1', 'AC Administrativos');
$sheet->setCellValue('L1', 'Otros Accidentes');
$sheet->setCellValue('M1', 'Incidentes');
$sheet->setCellValue('N1', 'IN Operativos');
$sheet->setCellValue('O1', 'IN Administrativos');
$sheet->setCellValue('P1', 'Otros Incidentes');
$sheet->setCellValue('Q1', 'Índice Severidad');
$sheet->setCellValue('R1', 'Índice Frecuencia');
$sheet->setCellValue('S1', 'Índice Accidentabilidad');
$sheet->setCellValue('T1', 'Casos Covid Positivos');
$sheet->setCellValue('U1', 'Inspecciones Programadas');
$sheet->setCellValue('V1', 'Inspecciones Ejecutadas');
$sheet->setCellValue('W1', 'Capacitaciones Programadas');
$sheet->setCellValue('X1', 'Capacitaciones Ejecutadas');
$sheet->setCellValue('Y1', 'Simulacros Programados');
$sheet->setCellValue('Z1', 'Simulacros Ejecutados');
$sheet->setCellValue('AA1', 'PASST Programadas');
$sheet->setCellValue('AB1', 'PASST Ejecutadas');
$sheet->setCellValue('AC1', 'Fecha Actualización');

// Agregar datos
$row = 2;
while ($data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $data['id']);
    $sheet->setCellValue('B' . $row, $data['anio']);
    $sheet->setCellValue('C' . $row, $data['mes']);
    $sheet->setCellValue('D' . $row, $data['cantidad_trabajadores']);
    $sheet->setCellValue('E' . $row, $data['personal_administrativo']);
    $sheet->setCellValue('F' . $row, $data['personal_operativo']);
    $sheet->setCellValue('G' . $row, $data['actos_inseguros']);
    $sheet->setCellValue('H' . $row, $data['condiciones_inseguras']);
    $sheet->setCellValue('I' . $row, $data['accidentes']);
    $sheet->setCellValue('J' . $row, $data['ac_operativas']);
    $sheet->setCellValue('K' . $row, $data['ac_administrativos']);
    $sheet->setCellValue('L' . $row, $data['otros_accidentes']);
    $sheet->setCellValue('M' . $row, $data['incidentes']);
    $sheet->setCellValue('N' . $row, $data['in_operativos']);
    $sheet->setCellValue('O' . $row, $data['in_administrativos']);
    $sheet->setCellValue('P' . $row, $data['otros_incidentes']);
    $sheet->setCellValue('Q' . $row, $data['indice_severidad']);
    $sheet->setCellValue('R' . $row, $data['indice_frecuencia']);
    $sheet->setCellValue('S' . $row, $data['indice_accidentabilidad']);
    $sheet->setCellValue('T' . $row, $data['casos_covid_positivos']);
    $sheet->setCellValue('U' . $row, $data['inspecciones_programadas']);
    $sheet->setCellValue('V' . $row, $data['inspecciones_ejecutadas']);
    $sheet->setCellValue('W' . $row, $data['capacitaciones_programadas']);
    $sheet->setCellValue('X' . $row, $data['capacitaciones_ejecutadas']);
    $sheet->setCellValue('Y' . $row, $data['simulacros_programados']);
    $sheet->setCellValue('Z' . $row, $data['simulacros_ejecutados']);
    $sheet->setCellValue('AA' . $row, $data['passt_programadas']);
    $sheet->setCellValue('AB' . $row, $data['passt_ejecutadas']);
    $sheet->setCellValue('AC' . $row, $data['fecha_actualizacion']);
    $row++;
}

// Guardar el archivo Excel
$writer = new Xlsx($spreadsheet);
$filename = 'datos_seguridad_laboral.xlsx';
$writer->save($filename);

// Descargar el archivo excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . filesize($filename));
readfile($filename);

// Eliminar el archivo temporal
unlink($filename);

exit;