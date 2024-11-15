<?php
// Aquí puedes agregar cualquier lógica de PHP, si lo deseas
?>

<?php include('head.php'); ?>

<body class="bg-blanco font-sans text-gris-oscuro flex flex-col min-h-screen">

    <!-- Incluir el menú -->
    <?php include('menu.php'); ?>

    <!-- Contenido Principal -->
    <main class="p-6 flex justify-center items-center mt-8 flex-grow">
        <!-- Contenedor centralizado -->
        <div class="max-w-4xl w-full bg-blanco p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-heading font-semibold text-azul mb-6 text-center">Bienvenido al sistema de gestión de Seguridad Laboral</h2>
            <p class="text-lg text-gris-oscuro mb-6 text-center">Este es un sistema para el registro y análisis de datos relacionados con la seguridad laboral. Aquí podrás ingresar información y consultar estadísticas en tiempo real para la toma de decisiones.</p>
            <div class="flex justify-center">
                <a href="/dashboard.php" class="bg-rojo text-blanco px-8 py-4 rounded-full text-xl hover:bg-gris-oscuro transition duration-300">
                    Ir al Dashboard
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-azul text-blanco py-3 mt-auto w-full">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; 2023 Seguridad Laboral. Todos los derechos reservados.</p>
            <div class="flex justify-center mt-2">
                <a href="#" class="mx-2 text-blanco hover:text-gris-claro transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="mx-2 text-blanco hover:text-gris-claro transition duration-300">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="mx-2 text-blanco hover:text-gris-claro transition duration-300">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>