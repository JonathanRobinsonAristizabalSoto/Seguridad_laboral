<?php
// Aquí puedes agregar cualquier lógica de PHP, si lo deseas
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguridad Laboral - Inicio</title>

    <!-- Enlace a Tailwind CSS -->
    <link href="./assets/css/styles.css" rel="stylesheet">

    <!-- Enlace a Font Awesome para los íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-white font-sans text-gris-oscuro flex flex-col min-h-screen">

    <!-- Incluir el menú -->
    <?php include('menu.php'); ?>

    <!-- Contenido Principal -->
    <main class="p-6 flex justify-center items-center mt-8 flex-grow">
        <!-- Contenedor centralizado -->
        <div class="max-w-4xl w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-azul mb-6 text-center">Bienvenido al sistema de gestión de Seguridad Laboral</h2>
            <p class="text-lg text-gris-oscuro mb-6 text-center">Este es un sistema para el registro y análisis de datos relacionados con la seguridad laboral. Aquí podrás ingresar información y consultar estadísticas en tiempo real.</p>
            <div class="flex justify-center">
                <a href="./dashboard.php" class="bg-rojo text-white px-8 py-4 rounded-full text-xl hover:bg-gris-oscuro transition duration-300">
                    Ir al Dashboard
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-azul text-white py-3 mt-auto w-full">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; 2023 Seguridad Laboral. Todos los derechos reservados.</p>
            <div class="flex justify-center mt-2">
                <a href="#" class="mx-2 text-white hover:text-gris-oscuro transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="mx-2 text-white hover:text-gris-oscuro transition duration-300">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="mx-2 text-white hover:text-gris-oscuro transition duration-300">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>
