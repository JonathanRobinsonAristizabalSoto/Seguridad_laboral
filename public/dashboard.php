<?php
// obtener_datos_dashboard.php
include 'obtener_datos_dashboard.php';

// Establecer la zona horaria a Colombia
date_default_timezone_set('America/Bogota');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Seguridad Laboral</title>
    <!-- Enlace a Tailwind CSS -->
    <link href="./assets/css/styles.css" rel="stylesheet">

    <!-- Enlace a Font Awesome para los íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Vincula Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-color3 font-sans text-color5">

    <!-- Incluir el menú -->
    <?php include('menu.php'); ?>

    <!-- Contenido principal -->
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-heading font-bold text-center text-color2 mb-8">REPORTE DE SEGURIDAD Y SALUD EN EL TRABAJO</h1>

        <!-- botones filtro meses para las graficas -->
        <div class="text-center mb-8">
            <form method="post" action="dashboard.php" class="grid grid-cols-2 gap-4 sm:flex sm:flex-wrap sm:justify-center">
                <button type="submit" name="meses" value="1" class="<?php echo (isset($_POST['meses']) && $_POST['meses'] == '1') ? 'bg-color2' : 'bg-color1'; ?> text-color3 py-2 px-4 rounded w-full sm:w-auto hover:bg-color5">
                    <i class="fas fa-calendar-alt mr-2"></i>Último Mes
                </button>
                <button type="submit" name="meses" value="3" class="<?php echo (isset($_POST['meses']) && $_POST['meses'] == '3') ? 'bg-color2' : 'bg-color1'; ?> text-color3 py-2 px-4 rounded w-full sm:w-auto hover:bg-color5">
                    <i class="fas fa-calendar-alt mr-2"></i>Últimos 3 Meses
                </button>
                <button type="submit" name="meses" value="6" class="<?php echo (isset($_POST['meses']) && $_POST['meses'] == '6') ? 'bg-color2' : 'bg-color1'; ?> text-color3 py-2 px-4 rounded w-full sm:w-auto hover:bg-color5">
                    <i class="fas fa-calendar-alt mr-2"></i>Últimos 6 Meses
                </button>
                <button type="submit" name="meses" value="12" class="<?php echo (isset($_POST['meses']) && $_POST['meses'] == '12') ? 'bg-color2' : 'bg-color1'; ?> text-color3 py-2 px-4 rounded w-full sm:w-auto hover:bg-color5">
                    <i class="fas fa-calendar-alt mr-2"></i>Últimos 12 Meses
                </button>
            </form>
        </div>

        <!-- Botones de exportar e importar -->
        <div class="text-center mb-8">
            <form id="import-form" method="post" action="importar.php" enctype="multipart/form-data" class="inline-block">
                <label for="file-upload" class="bg-color2 text-color3 py-2 px-4 rounded w-full sm:w-auto cursor-pointer text-center block hover:bg-color5">
                    <i class="fas fa-file-import mr-2"></i>Importar Datos
                </label>
                <input id="file-upload" type="file" name="file" class="hidden">
            </form>
            <form method="post" action="exportar.php" class="inline-block">
                <button type="submit" class="bg-color2 text-color3 py-2 px-4 rounded w-full sm:w-auto text-center hover:bg-color5">
                    <i class="fas fa-file-export mr-2"></i>Exportar Datos
                </button>
            </form>
        </div>

        <!-- Modal de confirmación -->
        <div id="confirm-modal" class="fixed inset-0 flex items-center justify-center bg-color6 bg-opacity-75 hidden">
            <div class="bg-color3 p-6 rounded shadow-lg text-center w-11/12 sm:w-1/2 lg:w-1/3">
                <h2 class="text-xl mb-4">Confirmar Importación</h2>
                <p class="mb-4">¿Estás seguro de que deseas importar los datos?</p>
                <button id="confirm-button" class="bg-color1 text-color3 py-2 px-4 rounded mr-2">Confirmar</button>
                <button type="button" class="bg-color2 text-color3 py-2 px-4 rounded" onclick="document.getElementById('confirm-modal').style.display = 'none';">Cancelar</button>
            </div>
        </div>

        <!-- Modal de éxito de exportación -->
        <div id="export-success-modal" class="fixed inset-0 flex items-center justify-center bg-color6 bg-opacity-75 hidden">
            <div class="bg-color3 p-6 rounded shadow-lg text-center w-11/12 sm:w-1/2 lg:w-1/3">
                <h2 class="text-xl mb-4 text-color1">¡Exportación Exitosa!</h2>
                <p class="mb-4">La base de datos se ha exportado con exitosamente.</p>
                <button type="button" class="bg-color1 text-color3 py-2 px-4 rounded" onclick="document.getElementById('export-success-modal').style.display = 'none';">Cerrar</button>
            </div>
        </div>

        <!-- Modal de éxito de importación -->
        <div id="import-success-modal" class="fixed inset-0 flex items-center justify-center bg-color6 bg-opacity-75 hidden">
            <div class="bg-color3 p-6 rounded shadow-lg text-center w-11/12 sm:w-1/2 lg:w-1/3">
                <h2 class="text-xl mb-4 text-color1">¡Importación Exitosa!</h2>
                <p class="mb-4">La base de datos se ha importado exitosamente.</p>
                <button type="button" class="bg-color1 text-color3 py-2 px-4 rounded" onclick="document.getElementById('import-success-modal').style.display = 'none';">Cerrar</button>
            </div>
        </div>

        <!-- Modal de éxito de actualización -->
        <div id="update-success-modal" class="fixed inset-0 flex items-center justify-center bg-color6 bg-opacity-75 hidden">
            <div class="bg-color3 p-6 rounded shadow-lg text-center w-11/12 sm:w-1/2 lg:w-1/3">
                <h2 class="text-xl mb-4 text-color1">¡Actualización Exitosa!</h2>
                <p class="mb-4">Los datos del mes <span id="update-mes"></span> del año <span id="update-anio"></span> se han actualizado exitosamente.</p>
                <button type="button" class="bg-color1 text-color3 py-2 px-4 rounded" onclick="document.getElementById('update-success-modal').style.display = 'none';">Cerrar</button>
            </div>
        </div>

        <!-- Modal de éxito de creación -->
        <div id="create-success-modal" class="fixed inset-0 flex items-center justify-center bg-color6 bg-opacity-75 hidden">
            <div class="bg-color3 p-6 rounded shadow-lg text-center w-11/12 sm:w-1/2 lg:w-1/3">
                <h2 class="text-xl mb-4 text-color1">¡Creación Exitosa!</h2>
                <p class="mb-4">Los indicadores del mes <span id="create-mes"></span> del año <span id="create-anio"></span> se han creado exitosamente.</p>
                <button type="button" class="bg-color1 text-color3 py-2 px-4 rounded" onclick="document.getElementById('create-success-modal').style.display = 'none';">Cerrar</button>
            </div>
        </div>

        <script>
            // Mostrar el modal de confirmación solo cuando se haya seleccionado un archivo
            document.getElementById('file-upload').addEventListener('change', function() {
                if (this.files.length > 0) {
                    document.getElementById('confirm-modal').style.display = 'flex';
                }
            });

            // Enviar el formulario al confirmar
            document.getElementById('confirm-button').addEventListener('click', function() {
                document.getElementById('import-form').submit();
            });
        </script>
        <script>
            // Mostrar el modal de éxito de importación si se ha importado correctamente
            <?php if (isset($_GET['import_success']) && $_GET['import_success'] == 1): ?>
                document.getElementById('import-success-modal').style.display = 'flex';
            <?php endif; ?>

            // Mostrar el modal de éxito de actualización si se ha actualizado correctamente
            <?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
                document.getElementById('update-mes').innerText = "<?php echo $_GET['mes']; ?>";
                document.getElementById('update-anio').innerText = "<?php echo $_GET['anio']; ?>";
                document.getElementById('update-success-modal').style.display = 'flex';
            <?php endif; ?>

            // Mostrar el modal de éxito de creación si se ha creado correctamente
            <?php if (isset($_GET['create_success']) && $_GET['create_success'] == 1): ?>
                document.getElementById('create-mes').innerText = "<?php echo $_GET['mes']; ?>";
                document.getElementById('create-anio').innerText = "<?php echo $_GET['anio']; ?>";
                document.getElementById('create-success-modal').style.display = 'flex';
            <?php endif; ?>
        </script>

        <!-- Mostrar la fecha y hora de actualización -->
        <div class="text-center mb-8">
            <div class="flex justify-center items-center mb-2">
                <i class="fas fa-calendar-alt text-color2 mr-2"></i>
                <h2 class="text-base font-heading font-semibold text-color1">
                    Fecha de actualización:
                    <span class="text-color2">
                        <?php
                        $fecha_actualizacion = new DateTime($ultima_actualizacion, new DateTimeZone('UTC'));
                        $fecha_actualizacion->setTimezone(new DateTimeZone('America/Bogota'));
                        echo $fecha_actualizacion->format('d-m-Y');
                        ?>
                    </span>
                </h2>
            </div>
            <div class="flex justify-center items-center">
                <i class="fas fa-clock text-color2 mr-2"></i>
                <h2 class="text-base font-heading font-semibold text-color1">
                    Hora de actualización:
                    <span class="text-color2">
                        <?php
                        echo $fecha_actualizacion->format('H:i:s');
                        ?>
                    </span>
                </h2>
            </div>
        </div>

        <!-- Tablero de gráficos -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 shadow-xl border-2 border-color1 rounded-lg">
            <!-- Gráfico de Accidentes e Incidentes -->
            <div class="bg-color3 p-6 rounded-lg" style="height: 350px;">
                <canvas id="accidentesIncidentesChart"></canvas>
            </div>

            <!-- Gráfico de Índices de Seguridad -->
            <div class="bg-color3 p-6 rounded-lg" style="height: 350px;">
                <canvas id="indicesChart"></canvas>
            </div>

            <!-- Gráfico de Personal -->
            <div class="bg-color3 p-6 rounded-lg" style="height: 350px;">
                <canvas id="personalChart" width="200" height="200"></canvas>
            </div>

            <!-- Gráfico de Inspecciones y Capacitaciones -->
            <div class="bg-color3 p-6 rounded-lg" style="height: 350px;">
                <canvas id="inspeccionesCapacitacionesChart"></canvas>
            </div>

            <!-- Gráfico de Actos y Condiciones Inseguras -->
            <div class="bg-color3 p-6 rounded-lg" style="height: 350px;">
                <canvas id="actosCondicionesChart"></canvas>
            </div>

            <!-- Gráfico de Casos Covid Positivos -->
            <div class="bg-color3 p-6 rounded-lg" style="height: 350px;">
                <canvas id="covidChart"></canvas>
            </div>

            <!-- Gráfico de Trabajadores -->
            <div class="bg-color3 p-6 rounded-lg" style="height: 350px;">
                <canvas id="trabajadoresChart"></canvas>
            </div>

            <!-- Gráfico de Accidentes Operativos y Administrativos -->
            <div class="bg-color3 p-6 rounded-lg" style="height: 350px;">
                <canvas id="accidentesOperativosAdministrativosChart"></canvas>
            </div>

            <!-- Gráfico de Incidentes Operativos y Administrativos -->
            <div class="bg-color3 p-6 rounded-lg" style="height: 350px;">
                <canvas id="incidentesOperativosAdministrativosChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Incluir el menú -->
<?php include('footer.php'); ?>

<!-- Script para los gráficos -->
<script>
    // Gráfico de Accidentes e Incidentes
    var ctx1 = document.getElementById('accidentesIncidentesChart').getContext('2d');
    var accidentesIncidentesChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                    label: 'Accidentes',
                    data: <?php echo json_encode($cant_accidentes); ?>,
                    backgroundColor: '#f86a1e', // Usando color2
                    borderColor: '#f86a1e',
                    borderWidth: 1
                },
                {
                    label: 'Incidentes',
                    data: <?php echo json_encode($cant_incidentes); ?>,
                    backgroundColor: '#73b32c', // Usando color1
                    borderColor: '#73b32c',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '📊 Accidentes e Incidentes por Mes',
                    font: {
                        size: 18
                    },
                    color: '#73b32c' // Usando color1
                }
            }
        }
    });

    // Gráfico de Índices de Seguridad
    var ctx2 = document.getElementById('indicesChart').getContext('2d');
    var indicesChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                    label: 'Índice de Severidad',
                    data: <?php echo json_encode($indice_severidad); ?>,
                    borderColor: '#374237', // Usando color5
                    backgroundColor: 'rgba(55, 65, 81, 0.2)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Índice de Frecuencia',
                    data: <?php echo json_encode($indice_frecuencia); ?>,
                    borderColor: '#73b32c', // Usando color1
                    backgroundColor: 'rgba(4, 52, 115, 0.2)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Índice de Accidentabilidad',
                    data: <?php echo json_encode($indice_accidentabilidad); ?>,
                    borderColor: '#f86a1e', // Usando color2
                    backgroundColor: 'rgba(239, 68, 68, 0.2)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '📈 Índices de Seguridad a lo largo del tiempo',
                    font: {
                        size: 18
                    },
                    color: '#73b32c' // Usando color1
                }
            }
        }
    });

    // Gráfico de Personal
    var ctx3 = document.getElementById('personalChart').getContext('2d');
    var personalChart = new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: ['Personal Administrativo', 'Personal Operativo'],
            datasets: [{
                data: [
                    <?php echo end($personal_administrativo); ?>,
                    <?php echo end($personal_operativo); ?>
                ],
                backgroundColor: ['#f86a1e', '#73b32c'], // Usando color2 y color1
                borderColor: ['#f86a1e', '#73b32c'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: '👥 Gráfico de Personal',
                    font: {
                        size: 18
                    },
                    color: '#73b32c' // Usando color1
                }
            }
        }
    });

    // Gráfico de Inspecciones y Capacitaciones
    var ctx4 = document.getElementById('inspeccionesCapacitacionesChart').getContext('2d');
    var inspeccionesCapacitacionesChart = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                    label: 'Inspecciones Programadas',
                    data: <?php echo json_encode($inspecciones_programadas); ?>,
                    backgroundColor: '#f86a1e', // Usando color2
                    borderColor: '#f86a1e',
                    borderWidth: 1
                },
                {
                    label: 'Inspecciones Ejecutadas',
                    data: <?php echo json_encode($inspecciones_ejecutadas); ?>,
                    backgroundColor: '#73b32c', // Usando color1
                    borderColor: '#73b32c',
                    borderWidth: 1
                },
                {
                    label: 'Capacitaciones Programadas',
                    data: <?php echo json_encode($capacitaciones_programadas); ?>,
                    backgroundColor: '#374237', // Usando color5
                    borderColor: '#374237',
                    borderWidth: 1
                },
                {
                    label: 'Capacitaciones Ejecutadas',
                    data: <?php echo json_encode($capacitaciones_ejecutadas); ?>,
                    backgroundColor: '#c9d0c5', // Usando color4
                    borderColor: '#c9d0c5',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '📋 Inspecciones y Capacitaciones',
                    font: {
                        size: 18
                    },
                    color: '#73b32c' // Usando color1
                }
            }
        }
    });

    // Gráfico de Actos y Condiciones Inseguras
    var ctx5 = document.getElementById('actosCondicionesChart').getContext('2d');
    var actosCondicionesChart = new Chart(ctx5, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                    label: 'Actos Inseguros',
                    data: <?php echo json_encode($actos_inseguros); ?>,
                    backgroundColor: '#f86a1e', // Usando color2
                    borderColor: '#f86a1e',
                    borderWidth: 1
                },
                {
                    label: 'Condiciones Inseguras',
                    data: <?php echo json_encode($condiciones_inseguras); ?>,
                    backgroundColor: '#73b32c', // Usando color1
                    borderColor: '#73b32c',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '⚠️ Actos y Condiciones Inseguras',
                    font: {
                        size: 18
                    },
                    color: '#73b32c' // Usando color1
                }
            }
        }
    });

    // Gráfico de Casos Covid Positivos
    var ctx6 = document.getElementById('covidChart').getContext('2d');
    var covidChart = new Chart(ctx6, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                label: 'Casos Covid Positivos',
                data: <?php echo json_encode($casos_covid_positivos); ?>,
                borderColor: '#f86a1e', // Usando color2
                backgroundColor: 'rgba(239, 68, 68, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '🦠 Casos Covid Positivos',
                    font: {
                        size: 18
                    },
                    color: '#73b32c' // Usando color1
                }
            }
        }
    });

    // Gráfico de Trabajadores
    var ctx7 = document.getElementById('trabajadoresChart').getContext('2d');
    var trabajadoresChart = new Chart(ctx7, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                label: 'Cantidad de Trabajadores',
                data: <?php echo json_encode($cant_trabajadores); ?>,
                backgroundColor: '#73b32c', // Usando color4
                borderColor: '#73b32c',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '👷 Cantidad de Trabajadores',
                    font: {
                        size: 18
                    },
                    color: '#73b32c' // Usando color1
                }
            }
        }
    });

    // Gráfico de Accidentes Operativos y Administrativos
    var ctx8 = document.getElementById('accidentesOperativosAdministrativosChart').getContext('2d');
    var accidentesOperativosAdministrativosChart = new Chart(ctx8, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                    label: 'Accidentes Operativos',
                    data: <?php echo json_encode($ac_operativas); ?>,
                    backgroundColor: '#f86a1e', // Usando color2
                    borderColor: '#f86a1e',
                    borderWidth: 1
                },
                {
                    label: 'Accidentes Administrativos',
                    data: <?php echo json_encode($ac_administrativos); ?>,
                    backgroundColor: '#73b32c', // Usando color1
                    borderColor: '#73b32c',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '🚑 Accidentes Operativos y Administrativos',
                    font: {
                        size: 18
                    },
                    color: '#73b32c' // Usando color1
                }
            }
        }
    });

    // Gráfico de Incidentes Operativos y Administrativos
    var ctx9 = document.getElementById('incidentesOperativosAdministrativosChart').getContext('2d');
    var incidentesOperativosAdministrativosChart = new Chart(ctx9, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                    label: 'Incidentes Operativos',
                    data: <?php echo json_encode($in_operativos); ?>,
                    backgroundColor: '#f86a1e', // Usando color2
                    borderColor: '#f86a1e',
                    borderWidth: 1
                },
                {
                    label: 'Incidentes Administrativos',
                    data: <?php echo json_encode($in_administrativos); ?>,
                    backgroundColor: '#73b32c', // Usando color1
                    borderColor: '#73b32c',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '🚨 Incidentes Operativos y Administrativos',
                    font: {
                        size: 18
                    },
                    color: '#73b32c' // Usando color1
                }
            }
        }
    });
</script>



</body>

</html>