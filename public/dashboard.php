<?php
// obtener_datos_dashboard.php
include 'obtener_datos_dashboard.php';
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

<body class="bg-blanco font-sans text-gris-oscuro">

    <!-- Incluir el menú -->
    <?php include('menu.php'); ?>

    <!-- Contenido principal -->
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-heading font-bold text-center text-rojo mb-8">REPORTE DE SEGURIDAD Y SALUD EN EL TRABAJO</h1>

        <!-- botones filtro meses para las graficas -->
        <div class="text-center mb-8">
            <form method="post" action="dashboard.php" class="grid grid-cols-2 gap-4 sm:flex sm:flex-wrap sm:justify-center">
                <button type="submit" name="meses" value="1" class="<?php echo (isset($_POST['meses']) && $_POST['meses'] == '1') ? 'bg-rojo' : 'bg-azul'; ?> text-blanco py-2 px-4 rounded w-full sm:w-auto">Último Mes</button>
                <button type="submit" name="meses" value="3" class="<?php echo (isset($_POST['meses']) && $_POST['meses'] == '3') ? 'bg-rojo' : 'bg-azul'; ?> text-blanco py-2 px-4 rounded w-full sm:w-auto">Últimos 3 Meses</button>
                <button type="submit" name="meses" value="6" class="<?php echo (isset($_POST['meses']) && $_POST['meses'] == '6') ? 'bg-rojo' : 'bg-azul'; ?> text-blanco py-2 px-4 rounded w-full sm:w-auto">Últimos 6 Meses</button>
                <button type="submit" name="meses" value="12" class="<?php echo (isset($_POST['meses']) && $_POST['meses'] == '12') ? 'bg-rojo' : 'bg-azul'; ?> text-blanco py-2 px-4 rounded w-full sm:w-auto">Últimos 12 Meses</button>
            </form>
        </div>

        <!-- Botones de exportar e importar -->
        <div class="text-center mb-8">
            <form method="post" action="exportar.php" class="inline-block">
                <button type="submit" class="bg-verde text-blanco py-2 px-4 rounded w-full sm:w-auto">Exportar Datos a Excel</button>
            </form>
            <form method="post" action="importar.php" enctype="multipart/form-data" class="inline-block">
                <input type="file" name="file" class="mb-2">
                <button type="submit" class="bg-amarillo text-blanco py-2 px-4 rounded w-full sm:w-auto">Importar Datos desde Excel</button>
            </form>
        </div>

        <!-- Mostrar la fecha y hora de actualización -->
        <div class="text-center mb-8">
            <div class="flex justify-center items-center mb-2">
                <i class="fas fa-calendar-alt text-rojo mr-2"></i>
                <h2 class="text-base font-heading font-semibold text-azul">
                    Fecha de actualización: <span class="text-rojo"><?php echo date('d-m-Y', strtotime($ultima_actualizacion)); ?></span>
                </h2>
            </div>
            <div class="flex justify-center items-center">
                <i class="fas fa-clock text-rojo mr-2"></i>
                <h2 class="text-base font-heading font-semibold text-azul">
                    Hora de actualización: <span class="text-rojo"><?php echo date('H:i:s', strtotime($ultima_actualizacion)); ?></span>
                </h2>
            </div>
        </div>

        <!-- Tablero de gráficos -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 shadow-xl border-2 border-azul rounded-lg">
            <!-- Gráfico de Accidentes e Incidentes -->
            <div class="bg-blanco p-6 rounded-lg" style="height: 350px;">
                <canvas id="accidentesIncidentesChart"></canvas>
            </div>

            <!-- Gráfico de Índices de Seguridad -->
            <div class="bg-blanco p-6 rounded-lg" style="height: 350px;">
                <canvas id="indicesChart"></canvas>
            </div>

            <!-- Gráfico de Personal -->
            <div class="bg-blanco p-6 rounded-lg" style="height: 350px;">
                <canvas id="personalChart" width="200" height="200"></canvas>
            </div>

            <!-- Gráfico de Inspecciones y Capacitaciones -->
            <div class="bg-blanco p-6 rounded-lg" style="height: 350px;">
                <canvas id="inspeccionesCapacitacionesChart"></canvas>
            </div>

            <!-- Gráfico de Actos y Condiciones Inseguras -->
            <div class="bg-blanco p-6 rounded-lg" style="height: 350px;">
                <canvas id="actosCondicionesChart"></canvas>
            </div>

            <!-- Gráfico de Casos Covid Positivos -->
            <div class="bg-blanco p-6 rounded-lg" style="height: 350px;">
                <canvas id="covidChart"></canvas>
            </div>

            <!-- Gráfico de Trabajadores -->
            <div class="bg-blanco p-6 rounded-lg" style="height: 350px;">
                <canvas id="trabajadoresChart"></canvas>
            </div>

            <!-- Gráfico de Accidentes Operativos y Administrativos -->
            <div class="bg-blanco p-6 rounded-lg" style="height: 350px;">
                <canvas id="accidentesOperativosAdministrativosChart"></canvas>
            </div>

            <!-- Gráfico de Incidentes Operativos y Administrativos -->
            <div class="bg-blanco p-6 rounded-lg" style="height: 350px;">
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
                        backgroundColor: '#ef4444', // Usando Rojo Principal
                        borderColor: '#ef4444',
                        borderWidth: 1
                    },
                    {
                        label: 'Incidentes',
                        data: <?php echo json_encode($cant_incidentes); ?>,
                        backgroundColor: '#043473', // Usando Azul Principal
                        borderColor: '#043473',
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
                        color: '#043473' // Color Azul
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
                        borderColor: '#374151', // Usando Gris Oscuro
                        backgroundColor: 'rgba(55, 65, 81, 0.2)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Índice de Frecuencia',
                        data: <?php echo json_encode($indice_frecuencia); ?>,
                        borderColor: '#043473', // Usando Azul Principal
                        backgroundColor: 'rgba(4, 52, 115, 0.2)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Índice de Accidentabilidad',
                        data: <?php echo json_encode($indice_accidentabilidad); ?>,
                        borderColor: '#ef4444', // Usando Rojo Principal
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
                        color: '#043473' // Color Azul
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
                    backgroundColor: ['#ef4444', '#043473'],
                    borderColor: ['#ef4444', '#043473'],
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
                        color: '#043473' // Color Azul
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
                        backgroundColor: '#ef4444', // Usando Rojo Principal
                        borderColor: '#ef4444',
                        borderWidth: 1
                    },
                    {
                        label: 'Inspecciones Ejecutadas',
                        data: <?php echo json_encode($inspecciones_ejecutadas); ?>,
                        backgroundColor: '#043473', // Usando Azul Principal
                        borderColor: '#043473',
                        borderWidth: 1
                    },
                    {
                        label: 'Capacitaciones Programadas',
                        data: <?php echo json_encode($capacitaciones_programadas); ?>,
                        backgroundColor: '#374151', // Usando Gris Oscuro
                        borderColor: '#374151',
                        borderWidth: 1
                    },
                    {
                        label: 'Capacitaciones Ejecutadas',
                        data: <?php echo json_encode($capacitaciones_ejecutadas); ?>,
                        backgroundColor: '#10b981', // Usando Verde Principal
                        borderColor: '#10b981',
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
                        color: '#043473' // Color Azul
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
                        backgroundColor: '#ef4444', // Usando Rojo Principal
                        borderColor: '#ef4444',
                        borderWidth: 1
                    },
                    {
                        label: 'Condiciones Inseguras',
                        data: <?php echo json_encode($condiciones_inseguras); ?>,
                        backgroundColor: '#043473', // Usando Azul Principal
                        borderColor: '#043473',
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
                        color: '#043473' // Color Azul
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
                    borderColor: '#ef4444', // Usando Rojo Principal
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
                        color: '#043473' // Color Azul
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
                    backgroundColor: '#10b981', // Usando Verde Principal
                    borderColor: '#10b981',
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
                        color: '#043473' // Color Azul
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
                        backgroundColor: '#ef4444', // Usando Rojo Principal
                        borderColor: '#ef4444',
                        borderWidth: 1
                    },
                    {
                        label: 'Accidentes Administrativos',
                        data: <?php echo json_encode($ac_administrativos); ?>,
                        backgroundColor: '#043473', // Usando Azul Principal
                        borderColor: '#043473',
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
                        color: '#043473' // Color Azul
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
                        backgroundColor: '#ef4444', // Usando Rojo Principal
                        borderColor: '#ef4444',
                        borderWidth: 1
                    },
                    {
                        label: 'Incidentes Administrativos',
                        data: <?php echo json_encode($in_administrativos); ?>,
                        backgroundColor: '#043473', // Usando Azul Principal
                        borderColor: '#043473',
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
                        color: '#043473' // Color Azul
                    }
                }
            }
        });
    </script>
</body>

</html>