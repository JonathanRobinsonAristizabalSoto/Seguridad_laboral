<?php

include('configDB.php');

// Establecer la zona horaria a Colombia
date_default_timezone_set('America/Bogota');

// Crear conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Comprobar si los datos fueron enviados a través del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $anio = $_POST['anio'];
    $mes = $_POST['mes'];
    $cantidad_trabajadores = $_POST['cantidad_trabajadores'];
    $personal_administrativo = $_POST['personal_administrativo'];
    $personal_operativo = $_POST['personal_operativo'];
    $actos_inseguros = $_POST['actos_inseguros'];
    $condiciones_inseguras = $_POST['condiciones_inseguras'];
    $accidentes = $_POST['accidentes'];
    $ac_operativas = $_POST['ac_operativas'];
    $ac_administrativos = $_POST['ac_administrativos'];
    $otros_accidentes = $_POST['otros_accidentes'];
    $incidentes = $_POST['incidentes'];
    $in_operativos = $_POST['in_operativos'];
    $in_administrativos = $_POST['in_administrativos'];
    $otros_incidentes = $_POST['otros_incidentes'];
    $indice_severidad = $_POST['indice_severidad'];
    $indice_frecuencia = $_POST['indice_frecuencia'];
    $casos_covid_positivos = $_POST['casos_covid_positivos'];
    $inspecciones_programadas = $_POST['inspecciones_programadas'];
    $inspecciones_ejecutadas = $_POST['inspecciones_ejecutadas'];
    $capacitaciones_programadas = $_POST['capacitaciones_programadas'];
    $capacitaciones_ejecutadas = $_POST['capacitaciones_ejecutadas'];
    $simulacros_programados = $_POST['simulacros_programados'];
    $simulacros_ejecutados = $_POST['simulacros_ejecutados'];
    $passt_programadas = $_POST['passt_programadas'];
    $passt_ejecutadas = $_POST['passt_ejecutadas'];
    $fecha_actualizacion = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual

    // Calcular el Índice de Accidentabilidad
    $indice_accidentabilidad = ($accidentes / $cantidad_trabajadores) * 1000;

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO datos (
                anio,
                mes,
                cantidad_trabajadores,
                personal_administrativo,
                personal_operativo,
                actos_inseguros,
                condiciones_inseguras,
                accidentes,
                ac_operativas,
                ac_administrativos,
                otros_accidentes,
                incidentes,
                in_operativos,
                in_administrativos,
                otros_incidentes,
                indice_severidad,
                indice_frecuencia,
                indice_accidentabilidad,
                casos_covid_positivos,
                inspecciones_programadas,
                inspecciones_ejecutadas,
                capacitaciones_programadas,
                capacitaciones_ejecutadas,
                simulacros_programados,
                simulacros_ejecutados,
                passt_programadas,
                passt_ejecutadas,
                fecha_actualizacion
            ) VALUES (
                :anio,
                :mes,
                :cantidad_trabajadores,
                :personal_administrativo,
                :personal_operativo,
                :actos_inseguros,
                :condiciones_inseguras,
                :accidentes,
                :ac_operativas,
                :ac_administrativos,
                :otros_accidentes,
                :incidentes,
                :in_operativos,
                :in_administrativos,
                :otros_incidentes,
                :indice_severidad,
                :indice_frecuencia,
                :indice_accidentabilidad,
                :casos_covid_positivos,
                :inspecciones_programadas,
                :inspecciones_ejecutadas,
                :capacitaciones_programadas,
                :capacitaciones_ejecutadas,
                :simulacros_programados,
                :simulacros_ejecutados,
                :passt_programadas,
                :passt_ejecutadas,
                :fecha_actualizacion
            )";

    // Preparar la sentencia
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta con los datos del formulario
    try {
        $stmt->execute([
            ':anio' => $anio,
            ':mes' => $mes,
            ':cantidad_trabajadores' => $cantidad_trabajadores,
            ':personal_administrativo' => $personal_administrativo,
            ':personal_operativo' => $personal_operativo,
            ':actos_inseguros' => $actos_inseguros,
            ':condiciones_inseguras' => $condiciones_inseguras,
            ':accidentes' => $accidentes,
            ':ac_operativas' => $ac_operativas,
            ':ac_administrativos' => $ac_administrativos,
            ':otros_accidentes' => $otros_accidentes,
            ':incidentes' => $incidentes,
            ':in_operativos' => $in_operativos,
            ':in_administrativos' => $in_administrativos,
            ':otros_incidentes' => $otros_incidentes,
            ':indice_severidad' => $indice_severidad,
            ':indice_frecuencia' => $indice_frecuencia,
            ':indice_accidentabilidad' => $indice_accidentabilidad,
            ':casos_covid_positivos' => $casos_covid_positivos,
            ':inspecciones_programadas' => $inspecciones_programadas,
            ':inspecciones_ejecutadas' => $inspecciones_ejecutadas,
            ':capacitaciones_programadas' => $capacitaciones_programadas,
            ':capacitaciones_ejecutadas' => $capacitaciones_ejecutadas,
            ':simulacros_programados' => $simulacros_programados,
            ':simulacros_ejecutados' => $simulacros_ejecutados,
            ':passt_programadas' => $passt_programadas,
            ':passt_ejecutadas' => $passt_ejecutadas,
            ':fecha_actualizacion' => $fecha_actualizacion
        ]);
        // Redirigir al dashboard después de insertar los datos
        header("Location: dashboard.php?create_success=1&anio=$anio&mes=$mes");
        exit();
    } catch (PDOException $e) {
        echo "<p class='text-red-600 text-center'>Error al insertar los datos: " . $e->getMessage() . "</p>";
    }
}

// Obtener los datos del último mes
$sql = "SELECT * FROM datos ORDER BY anio DESC, mes DESC LIMIT 1";
$stmt = $pdo->query($sql);
$datos = $stmt->fetch(PDO::FETCH_ASSOC);
?>