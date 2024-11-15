<!-- menu.php -->

<header class="text-azul py-4 px-6 flex justify-between items-center">
    <!-- Logo a la izquierda -->
    <div class="flex items-center">
        <img src="./assets/img/logo.png" alt="Logo" class="h-8 w-8 mr-2">
    </div>

    <!-- Título centrado -->
    <div class="flex-grow text-center">
        <h1 class="text-xl font-heading font-bold">SEGURIDAD LABORAL</h1>
    </div>

    <!-- Menú hamburguesa a la derecha -->
    <div>
        <button id="menu-button" class="text-rojo text-3xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<!-- Sidebar (menú lateral) -->
<div id="sidebar" class="fixed inset-0 bg-gris-oscuro bg-opacity-75 z-50 hidden">
    <div class="w-64 bg-rojo h-full p-6 transform -translate-x-full transition-transform duration-500 ease-in-out" id="sidebar-content">
        <div class="flex justify-between items-center mb-8">
            <span class="text-xl font-heading font-bold text-azul">Menú</span>
            <!-- Ícono para cerrar el sidebar -->
            <button id="close-sidebar" class="text-blanco text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul>
            <li><a href="/home.php" class="text-lg font-medium text-blanco hover:text-azul mb-4 block font-sans">Inicio</a></li>
            <li><a href="/formulario.php" class="text-lg font-medium text-blanco hover:text-azul mb-4 block font-sans">Crear Indicadores</a></li>
            <li><a href="/formularioActualizar.php" class="text-lg font-medium text-blanco hover:text-azul mb-4 block font-sans">Actualizar Indicadores</a></li>
            <li><a href="/dashboard.php" class="text-lg font-medium text-blanco hover:text-azul mb-4 block font-sans">Dashboard</a></li>
        </ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Abre el menú del sidebar
        $('#menu-button').click(function() {
            $('#sidebar').removeClass('hidden'); // Muestra el sidebar
            $('#sidebar-content').removeClass('-translate-x-full').addClass('translate-x-0'); // Desliza el sidebar
        });

        // Cierra el menú del sidebar
        $('#close-sidebar').click(function() {
            $('#sidebar-content').removeClass('translate-x-0').addClass('-translate-x-full'); // Desliza el sidebar fuera de la vista
            setTimeout(function() {
                $('#sidebar').addClass('hidden'); // Oculta el sidebar después de la animación
            }, 500); // Espera que termine la animación
        });
    });
</script>