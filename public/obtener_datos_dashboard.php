<?php
// obtener_datos_dashboard.php

// Obtener la URL de la base de datos desde la variable de entorno
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

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

// Obtener los datos desde la base de datos
$sql = "SELECT * FROM datos";
$result = $conn->query($sql);

// Arrays para almacenar los datos del gráfico
$meses = [];
$cant_trabajadores = [];
$personal_administrativo = [];
$personal_operativo = [];
$actos_inseguros = [];
$condiciones_inseguras = [];
$cant_accidentes = [];
$ac_operativas = [];
$ac_administrativos = [];
$otros_accidentes = [];
$cant_incidentes = [];
$in_operativos = [];
$in_administrativos = [];
$otros_incidentes = [];
$indice_severidad = [];
$indice_frecuencia = [];
$indice_accidentabilidad = [];
$casos_covid_positivos = [];
$inspecciones_programadas = [];
$inspecciones_ejecutadas = [];
$capacitaciones_programadas = [];
$capacitaciones_ejecutadas = [];
$simulacros_programados = [];
$simulacros_ejecutados = [];
$passt_programadas = [];
$passt_ejecutadas = [];
$ultima_actualizacion = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $meses[] = $row['mes'];
        $cant_trabajadores[] = $row['cantidad_trabajadores'];
        $personal_administrativo[] = $row['personal_administrativo'];
        $personal_operativo[] = $row['personal_operativo'];
        $actos_inseguros[] = $row['actos_inseguros'];
        $condiciones_inseguras[] = $row['condiciones_inseguras'];
        $cant_accidentes[] = $row['accidentes'];
        $ac_operativas[] = $row['ac_operativas'];
        $ac_administrativos[] = $row['ac_administrativos'];
        $otros_accidentes[] = $row['otros_accidentes'];
        $cant_incidentes[] = $row['incidentes'];
        $in_operativos[] = $row['in_operativos'];
        $in_administrativos[] = $row['in_administrativos'];
        $otros_incidentes[] = $row['otros_incidentes'];
        $indice_severidad[] = $row['indice_severidad'];
        $indice_frecuencia[] = $row['indice_frecuencia'];
        $indice_accidentabilidad[] = $row['indice_accidentabilidad'];
        $casos_covid_positivos[] = $row['casos_covid_positivos'];
        $inspecciones_programadas[] = $row['inspecciones_programadas'];
        $inspecciones_ejecutadas[] = $row['inspecciones_ejecutadas'];
        $capacitaciones_programadas[] = $row['capacitaciones_programadas'];
        $capacitaciones_ejecutadas[] = $row['capacitaciones_ejecutadas'];
        $simulacros_programados[] = $row['simulacros_programados'];
        $simulacros_ejecutados[] = $row['simulacros_ejecutados'];
        $passt_programadas[] = $row['passt_programadas'];
        $passt_ejecutadas[] = $row['passt_ejecutadas'];
        $ultima_actualizacion = $row['fecha_actualizacion'];
    }
}

// Obtener la cantidad de meses seleccionada por el usuario
$meses_seleccionados = isset($_POST['meses']) ? (int)$_POST['meses'] : 6;

// Seleccionar solo los últimos X meses de datos
$meses = array_slice($meses, -$meses_seleccionados);
$cant_trabajadores = array_slice($cant_trabajadores, -$meses_seleccionados);
$personal_administrativo = array_slice($personal_administrativo, -$meses_seleccionados);
$personal_operativo = array_slice($personal_operativo, -$meses_seleccionados);
$actos_inseguros = array_slice($actos_inseguros, -$meses_seleccionados);
$condiciones_inseguras = array_slice($condiciones_inseguras, -$meses_seleccionados);
$cant_accidentes = array_slice($cant_accidentes, -$meses_seleccionados);
$ac_operativas = array_slice($ac_operativas, -$meses_seleccionados);
$ac_administrativos = array_slice($ac_administrativos, -$meses_seleccionados);
$otros_accidentes = array_slice($otros_accidentes, -$meses_seleccionados);
$cant_incidentes = array_slice($cant_incidentes, -$meses_seleccionados);
$in_operativos = array_slice($in_operativos, -$meses_seleccionados);
$in_administrativos = array_slice($in_administrativos, -$meses_seleccionados);
$otros_incidentes = array_slice($otros_incidentes, -$meses_seleccionados);
$indice_severidad = array_slice($indice_severidad, -$meses_seleccionados);
$indice_frecuencia = array_slice($indice_frecuencia, -$meses_seleccionados);
$indice_accidentabilidad = array_slice($indice_accidentabilidad, -$meses_seleccionados);
$casos_covid_positivos = array_slice($casos_covid_positivos, -$meses_seleccionados);
$inspecciones_programadas = array_slice($inspecciones_programadas, -$meses_seleccionados);
$inspecciones_ejecutadas = array_slice($inspecciones_ejecutadas, -$meses_seleccionados);
$capacitaciones_programadas = array_slice($capacitaciones_programadas, -$meses_seleccionados);
$capacitaciones_ejecutadas = array_slice($capacitaciones_ejecutadas, -$meses_seleccionados);
$simulacros_programados = array_slice($simulacros_programados, -$meses_seleccionados);
$simulacros_ejecutados = array_slice($simulacros_ejecutados, -$meses_seleccionados);
$passt_programadas = array_slice($passt_programadas, -$meses_seleccionados);
$passt_ejecutadas = array_slice($passt_ejecutadas, -$meses_seleccionados);

$conn->close();
?>