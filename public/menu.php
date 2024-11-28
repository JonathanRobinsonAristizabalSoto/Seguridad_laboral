<!-- menu.php -->

<!-- Enlace a la CDN de Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<header class="text-color1 py-4 px-6 flex justify-between items-center">
    <!-- Logo a la izquierda -->
    <div class="flex items-center">
        <img src="./assets/img/logo.svg" alt="Logo" class="h-9 w-9 mr-2">
    </div>

    <!-- Título centrado -->
    <div class="flex-grow text-center">
        <h1 class="text-xl font-heading font-bold">SEGURIDAD LABORAL</h1>
    </div>

    <!-- Menú hamburguesa a la derecha -->
    <div>
        <button id="menu-button" class="text-color2 text-3xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<!-- Sidebar (menú lateral) -->
<div id="sidebar" class="fixed inset-0 bg-color5 bg-opacity-75 z-50 hidden">
    <div class="w-64 bg-color2 h-full p-6 transform -translate-x-full transition-transform duration-500 ease-in-out" id="sidebar-content">
        <div class="flex justify-between items-center mb-8">
            <span class="text-xl font-heading font-bold text-color3">Menú</span>
            <!-- Ícono para cerrar el sidebar -->
            <button id="close-sidebar" class="text-color3 text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul>
            <li>
                <a href="/home.php" class="text-lg font-medium text-color3 hover:text-color5 mb-4 block font-sans">
                    <i class="fas fa-home text-color5 mr-2"></i>Inicio
                </a>
            </li>
            <li>
                <a href="/formulario.php" class="text-lg font-medium text-color3 hover:text-color5 mb-4 block font-sans">
                    <i class="fas fa-plus-circle text-color5 mr-2"></i>Crear nuevo mes de indicadores
                </a>
            </li>
            <li>
                <a href="/formularioActualizar.php" class="text-lg font-medium text-color3 hover:text-color5 mb-4 block font-sans">
                    <i class="fas fa-edit text-color5 mr-2"></i>Actualizar Indicadores
                </a>
            </li>
            <li>
                <a href="/dashboard.php" class="text-lg font-medium text-color3 hover:text-color5 mb-4 block font-sans">
                    <i class="fas fa-tachometer-alt text-color5 mr-2"></i>Dashboard
                </a>
            </li>
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