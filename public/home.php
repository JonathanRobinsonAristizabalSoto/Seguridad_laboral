<?php
// Aquí puedes agregar cualquier lógica de PHP, si lo deseas
?>

<?php include('head.php'); ?>

<body class="bg-color3 font-sans text-color5 flex flex-col min-h-screen">

    <!-- Incluir el menú -->
    <?php include('menu.php'); ?>

    <!-- Contenido Principal -->
    <main class="p-6 flex justify-center items-center mt-8 flex-grow">
        <!-- Contenedor centralizado -->
        <div class="max-w-4xl w-full bg-color3 p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-heading font-semibold text-color1 mb-6 text-center">Bienvenido al sistema de gestión de Seguridad Laboral</h2>
            <p class="text-lg text-color5 mb-6 text-center">Este es un sistema para el registro y análisis de datos relacionados con la seguridad laboral. Aquí podrás ingresar información y consultar estadísticas en tiempo real.</p>
            <div class="flex justify-center">
                <a href="/dashboard.php" class="bg-color2 text-color3 px-8 py-4 rounded-full text-xl hover:bg-color5 transition duration-300">
                    Ir al Dashboard
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-color1 text-color3 py-3 mt-auto w-full">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; 2023 Seguridad Laboral. Todos los derechos reservados.</p>
            <div class="flex justify-center mt-2">
                <a href="#" class="mx-2 text-color3 hover:text-color4 transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="mx-2 text-color3 hover:text-color4 transition duration-300">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="mx-2 text-color3 hover:text-color4 transition duration-300">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>