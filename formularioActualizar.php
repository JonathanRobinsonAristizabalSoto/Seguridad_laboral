<!-- head -->
<?php
// Incluir la lógica de consulta desde head.php
include('head.php');
?>

<body class="bg-blanco">

    <!-- Incluir el menú -->
    <?php include('menu.php'); ?>

    <?php
    // Incluir la lógica de consulta desde actualizar.php
    include('actualizar.php');
    ?>

    <div class="container mx-auto p-6">
        <div class="text-center mb-6 max-w-3xl mx-auto">
            <h1 class="text-2xl font-bold text-rojo mb-4">Actualizacion de indicadores Seguridad Laboral</h1>
            <p class="text-lg text-justify">Este formulario está diseñado para actualizar indicadores de la seguridad laboral mes a mes.</p>
        </div>

        <form action="actualizar.php" method="POST" class="bg-white p-8 rounded-lg shadow-lg border-2 border-azul space-y-4">
            <h1 class="text-2xl text-center font-bold text-rojo mb-8">Actualiza tus datos</h1>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Campo: Año -->
                <div class="flex flex-col">
                    <label for="anio" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-calendar text-rojo mr-2"></i> Año
                    </label>
                    <select name="anio" id="anio" class="p-2 border border-gray-300 rounded-md" required>
                        <option value="" disabled selected>Seleccione el año</option>
                        <!-- Opciones de años se cargarán dinámicamente -->
                    </select>
                </div>

                <!-- Campo: Mes -->
                <div class="flex flex-col">
                    <label for="mes" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-calendar-alt text-rojo mr-2"></i> Mes
                    </label>
                    <select name="mes" id="mes" class="p-2 border border-gray-300 rounded-md" required>
                        <option value="" disabled selected>Seleccione el mes</option>
                        <!-- Opciones de meses se cargarán dinámicamente -->
                    </select>
                </div>

                <!-- Campo: Cantidad de Trabajadores -->
                <div class="flex flex-col">
                    <label for="cantidad_trabajadores" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-users text-rojo mr-2"></i> Cantidad de Trabajadores
                    </label>
                    <input type="number" name="cantidad_trabajadores" id="cantidad_trabajadores" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Personal Administrativo -->
                <div class="flex flex-col">
                    <label for="personal_administrativo" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-user-tie text-rojo mr-2"></i> Personal Administrativo
                    </label>
                    <input type="number" name="personal_administrativo" id="personal_administrativo" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Personal Operativo -->
                <div class="flex flex-col">
                    <label for="personal_operativo" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-hard-hat text-rojo mr-2"></i> Personal Operativo
                    </label>
                    <input type="number" name="personal_operativo" id="personal_operativo" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Actos Inseguros -->
                <div class="flex flex-col">
                    <label for="actos_inseguros" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-exclamation-triangle text-rojo mr-2"></i> Actos Inseguros
                    </label>
                    <input type="number" name="actos_inseguros" id="actos_inseguros" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Condiciones Inseguras -->
                <div class="flex flex-col">
                    <label for="condiciones_inseguras" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-exclamation-circle text-rojo mr-2"></i> Condiciones Inseguras
                    </label>
                    <input type="number" name="condiciones_inseguras" id="condiciones_inseguras" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Accidentes -->
                <div class="flex flex-col">
                    <label for="accidentes" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-ambulance text-rojo mr-2"></i> Accidentes
                    </label>
                    <input type="number" name="accidentes" id="accidentes" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Accidentes Operativos -->
                <div class="flex flex-col">
                    <label for="ac_operativas" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-tools text-rojo mr-2"></i> Accidentes Operativos
                    </label>
                    <input type="number" name="ac_operativas" id="ac_operativas" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Accidentes Administrativos -->
                <div class="flex flex-col">
                    <label for="ac_administrativos" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-briefcase text-rojo mr-2"></i> Accidentes Administrativos
                    </label>
                    <input type="number" name="ac_administrativos" id="ac_administrativos" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Otros Accidentes -->
                <div class="flex flex-col">
                    <label for="otros_accidentes" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-car-crash text-rojo mr-2"></i> Otros Accidentes
                    </label>
                    <input type="number" name="otros_accidentes" id="otros_accidentes" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Incidentes -->
                <div class="flex flex-col">
                    <label for="incidentes" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-exclamation text-rojo mr-2"></i> Incidentes
                    </label>
                    <input type="number" name="incidentes" id="incidentes" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Incidentes Operativos -->
                <div class="flex flex-col">
                    <label for="in_operativos" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-cogs text-rojo mr-2"></i> Incidentes Operativos
                    </label>
                    <input type="number" name="in_operativos" id="in_operativos" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Incidentes Administrativos -->
                <div class="flex flex-col">
                    <label for="in_administrativos" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-user-cog text-rojo mr-2"></i> Incidentes Administrativos
                    </label>
                    <input type="number" name="in_administrativos" id="in_administrativos" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Otros Incidentes -->
                <div class="flex flex-col">
                    <label for="otros_incidentes" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-exclamation-triangle text-rojo mr-2"></i> Otros Incidentes
                    </label>
                    <input type="number" name="otros_incidentes" id="otros_incidentes" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Indice de Severidad -->
                <div class="flex flex-col">
                    <label for="indice_severidad" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-thermometer-half text-rojo mr-2"></i> Índice de Severidad
                    </label>
                    <input type="number" step="0.01" name="indice_severidad" id="indice_severidad" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Indice de Frecuencia -->
                <div class="flex flex-col">
                    <label for="indice_frecuencia" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-sync-alt text-rojo mr-2"></i> Índice de Frecuencia
                    </label>
                    <input type="number" step="0.01" name="indice_frecuencia" id="indice_frecuencia" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Índice de Accidentabilidad -->
                <div class="flex flex-col">
                    <label for="indice_accidentabilidad" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-chart-line text-rojo mr-2"></i> Índice de Accidentabilidad
                    </label>
                    <input type="number" step="0.01" name="indice_accidentabilidad" id="indice_accidentabilidad" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Casos Covid Positivos -->
                <div class="flex flex-col">
                    <label for="casos_covid_positivos" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-virus text-rojo mr-2"></i> Casos Covid Positivos
                    </label>
                    <input type="number" name="casos_covid_positivos" id="casos_covid_positivos" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Inspecciones Programadas -->
                <div class="flex flex-col">
                    <label for="inspecciones_programadas" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-calendar-check text-rojo mr-2"></i> Inspecciones Programadas
                    </label>
                    <input type="number" name="inspecciones_programadas" id="inspecciones_programadas" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Inspecciones Ejecutadas -->
                <div class="flex flex-col">
                    <label for="inspecciones_ejecutadas" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-clipboard-check text-rojo mr-2"></i> Inspecciones Ejecutadas
                    </label>
                    <input type="number" name="inspecciones_ejecutadas" id="inspecciones_ejecutadas" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Capacitaciones Programadas -->
                <div class="flex flex-col">
                    <label for="capacitaciones_programadas" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-chalkboard-teacher text-rojo mr-2"></i> Capacitaciones Programadas
                    </label>
                    <input type="number" name="capacitaciones_programadas" id="capacitaciones_programadas" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Capacitaciones Ejecutadas -->
                <div class="flex flex-col">
                    <label for="capacitaciones_ejecutadas" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-chalkboard text-rojo mr-2"></i> Capacitaciones Ejecutadas
                    </label>
                    <input type="number" name="capacitaciones_ejecutadas" id="capacitaciones_ejecutadas" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Simulacros Programados -->
                <div class="flex flex-col">
                    <label for="simulacros_programados" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-calendar-alt text-rojo mr-2"></i> Simulacros Programados
                    </label>
                    <input type="number" name="simulacros_programados" id="simulacros_programados" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: Simulacros Ejecutados -->
                <div class="flex flex-col">
                    <label for="simulacros_ejecutados" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-calendar-check text-rojo mr-2"></i> Simulacros Ejecutados
                    </label>
                    <input type="number" name="simulacros_ejecutados" id="simulacros_ejecutados" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: PASST Programadas -->
                <div class="flex flex-col">
                    <label for="passt_programadas" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-tasks text-rojo mr-2"></i> PASST Programadas
                    </label>
                    <input type="number" name="passt_programadas" id="passt_programadas" class="p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Campo: PASST Ejecutadas -->
                <div class="flex flex-col">
                    <label for="passt_ejecutadas" class="font-semibold text-azul flex items-center">
                        <i class="fas fa-tasks text-rojo mr-2"></i> PASST Ejecutadas
                    </label>
                    <input type="number" name="passt_ejecutadas" id="passt_ejecutadas" class="p-2 border border-gray-300 rounded-md" required>
                </div>
            </div>

            <!-- Botón de Enviar -->
            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-azul text-white py-2 px-6 rounded-md hover:bg-gris-oscuro focus:outline-none">Guardar Datos</button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?php
    // Incluir la lógica de consulta desde footer.php
    include('footer.php');
    ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cargar años disponibles
            $.get('actualizar.php?getAños', function(data) {
                const años = JSON.parse(data);
                const añoSelect = $('#anio');
                años.forEach(año => {
                    añoSelect.append(new Option(año.anio, año.anio));
                });
            });

            // Cargar meses cuando se selecciona un año
            $('#anio').on('change', function() {
                const año = $(this).val();
                $.get('actualizar.php?getMeses&anio=' + año, function(data) {
                    const meses = JSON.parse(data);
                    const mesSelect = $('#mes');
                    mesSelect.empty();
                    mesSelect.append(new Option('Seleccione un mes', '')); // Añadir opción por defecto
                    meses.forEach(mes => {
                        mesSelect.append(new Option(mes.mes, mes.mes));
                    });
                });
            });

            // Cargar datos cuando se selecciona un mes
            $('#mes').on('change', function() {
                const año = $('#anio').val();
                const mes = $(this).val();
                $.get('actualizar.php?getDatos&anio=' + año + '&mes=' + mes, function(data) {
                    const datos = JSON.parse(data);
                    for (const key in datos) {
                        if (datos.hasOwnProperty(key) && key !== 'anio' && key !== 'mes') {
                            $('#' + key).val(datos[key]);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>