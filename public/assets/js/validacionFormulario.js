$(document).ready(function() {
    const form = $('form');
    const inputs = form.find('input, select');

    form.on('submit', function(event) {
        let valid = true;

        inputs.each(function() {
            const input = $(this);
            if (!input.val()) {
                valid = false;
                input.addClass('border-red-500');
            } else {
                input.removeClass('border-red-500');
            }
        });

        if (!valid) {
            event.preventDefault();
            alert('Por favor, complete todos los campos.');
        }
    });

    // Cargar años disponibles
    $.get('actualizar.php?getAños', function(data) {
        const años = JSON.parse(data);
        const añoSelect = $('#año');
        años.forEach(año => {
            añoSelect.append(new Option(año.año, año.año));
        });
    });

    // Cargar meses cuando se selecciona un año
    $('#año').on('change', function() {
        const año = $(this).val();
        $.get('actualizar.php?getMeses&año=' + año, function(data) {
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
        const año = $('#año').val();
        const mes = $(this).val();
        $.get('actualizar.php?getDatos&año=' + año + '&mes=' + mes, function(data) {
            const datos = JSON.parse(data);
            for (const key in datos) {
                if (datos.hasOwnProperty(key) && key !== 'año' && key !== 'mes') {
                    $('#' + key).val(datos[key]);
                }
            }
        });
    });
});