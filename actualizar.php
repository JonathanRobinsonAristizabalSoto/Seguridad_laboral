<?php
// Configuración de la base de datos
$host = 'localhost'; // O la dirección del servidor MySQL
$dbname = 'seguridad_laboral'; // Nombre de la base de datos
$username = 'root'; // Nombre de usuario de MySQL
$password = ''; // Contraseña de MySQL, dejar vacío si no tienes

// Crear conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => "No se pudo conectar a la base de datos: " . $e->getMessage()]));
}

// Comprobar si los datos fueron enviados a través del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $año = $_POST['año'];
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

    // Actualizar los datos en la base de datos
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
            WHERE año = :año AND mes = :mes";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
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
        ':año' => $año,
        ':mes' => $mes
    ]);

    echo json_encode(['success' => true, 'message' => 'Datos actualizados correctamente']);
    exit;
}

// Obtener los años disponibles en la base de datos
if (isset($_GET['getAños'])) {
    $stmt = $pdo->query("SELECT DISTINCT año FROM datos ORDER BY año");
    $años = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($años);
    exit;
}

// Obtener los meses disponibles para un año específico
if (isset($_GET['getMeses']) && isset($_GET['año'])) {
    $año = $_GET['año'];
    $stmt = $pdo->prepare("SELECT mes FROM datos WHERE año = :año ORDER BY mes");
    $stmt->execute([':año' => $año]);
    $meses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($meses);
    exit;
}

// Obtener los datos para un mes y año específicos
if (isset($_GET['getDatos']) && isset($_GET['año']) && isset($_GET['mes'])) {
    $año = $_GET['año'];
    $mes = $_GET['mes'];
    $stmt = $pdo->prepare("SELECT * FROM datos WHERE año = :año AND mes = :mes");
    $stmt->execute([':año' => $año, ':mes' => $mes]);
    $datos = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($datos);
    exit;
}