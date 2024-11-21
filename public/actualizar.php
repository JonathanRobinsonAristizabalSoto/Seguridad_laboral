<?php

include('configDB.php');

// Crear conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Manejar solicitudes AJAX para obtener años
if (isset($_GET['getAños'])) {
    $stmt = $pdo->query("SELECT DISTINCT anio FROM datos ORDER BY anio DESC");
    $años = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($años);
    exit();
}

// Manejar solicitudes AJAX para obtener meses
if (isset($_GET['getMeses']) && isset($_GET['anio'])) {
    $anio = $_GET['anio'];
    $stmt = $pdo->prepare("SELECT DISTINCT mes FROM datos WHERE anio = :anio ORDER BY mes DESC");
    $stmt->execute(['anio' => $anio]);
    $meses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($meses);
    exit();
}

// Manejar solicitudes AJAX para obtener datos
if (isset($_GET['getDatos']) && isset($_GET['anio']) && isset($_GET['mes'])) {
    $anio = $_GET['anio'];
    $mes = $_GET['mes'];
    $stmt = $pdo->prepare("SELECT * FROM datos WHERE anio = :anio AND mes = :mes");
    $stmt->execute(['anio' => $anio, 'mes' => $mes]);
    $datos = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($datos);
    exit();
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
    $indice_accidentabilidad = $_POST['indice_accidentabilidad'];
    $casos_covid_positivos = $_POST['casos_covid_positivos'];
    $inspecciones_programadas = $_POST['inspecciones_programadas'];
    $inspecciones_ejecutadas = $_POST['inspecciones_ejecutadas'];
    $capacitaciones_programadas = $_POST['capacitaciones_programadas'];
    $capacitaciones_ejecutadas = $_POST['capacitaciones_ejecutadas'];
    $simulacros_programados = $_POST['simulacros_programados'];
    $simulacros_ejecutados = $_POST['simulacros_ejecutados'];
    $passt_programadas = $_POST['passt_programadas'];
    $passt_ejecutadas = $_POST['passt_ejecutadas'];

    // Verificar si el registro ya existe
    $stmt = $pdo->prepare("SELECT id FROM datos WHERE anio = :anio AND mes = :mes");
    $stmt->execute(['anio' => $anio, 'mes' => $mes]);
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        // Preparar la consulta SQL para actualizar los datos
        $sql = "UPDATE datos SET
                    cantidad_trabajadores = :cantidad_trabajadores,
                    personal_administrativo = :personal_administrativo,
                    personal_operativo = :personal_operativo,
                    actos_inseguros = :actos_inseguros,
                    condiciones_inseguras = :condiciones_inseguras,
                    accidentes = :accidentes,
                    ac_operativas = :ac_operativas,
                    ac_administrativos = :ac_administrativos,
                    otros_accidentes = :otros_accidentes,
                    incidentes = :incidentes,
                    in_operativos = :in_operativos,
                    in_administrativos = :in_administrativos,
                    otros_incidentes = :otros_incidentes,
                    indice_severidad = :indice_severidad,
                    indice_frecuencia = :indice_frecuencia,
                    indice_accidentabilidad = :indice_accidentabilidad,
                    casos_covid_positivos = :casos_covid_positivos,
                    inspecciones_programadas = :inspecciones_programadas,
                    inspecciones_ejecutadas = :inspecciones_ejecutadas,
                    capacitaciones_programadas = :capacitaciones_programadas,
                    capacitaciones_ejecutadas = :capacitaciones_ejecutadas,
                    simulacros_programados = :simulacros_programados,
                    simulacros_ejecutados = :simulacros_ejecutados,
                    passt_programadas = :passt_programadas,
                    passt_ejecutadas = :passt_ejecutadas
                WHERE id = :id";
        $params = [
            ':id' => $registro['id'],
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
            ':passt_ejecutadas' => $passt_ejecutadas
        ];
    } else {
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
                    passt_ejecutadas
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
                    :passt_ejecutadas
                )";
        $params = [
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
            ':passt_ejecutadas' => $passt_ejecutadas
        ];
    }

    // Preparar la sentencia
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta con los datos del formulario
    try {
        $stmt->execute($params);
        // Redirigir al dashboard después de insertar los datos
        header("Location: dashboard.php?update_success=1&anio=$anio&mes=$mes");
        exit();
    } catch (PDOException $e) {
        echo "<p class='text-red-600 text-center'>Error al insertar los datos: " . $e->getMessage() . "</p>";
    }
}

// Obtener los datos existentes de la base de datos
$sql = "SELECT * FROM datos ORDER BY anio DESC, mes DESC LIMIT 1";
$stmt = $pdo->query($sql);
$datos = $stmt->fetch(PDO::FETCH_ASSOC);
?>