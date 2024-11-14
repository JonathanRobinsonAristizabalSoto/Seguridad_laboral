module.exports = {
    // Modo JIT (Just-In-Time), recomendado para mejorar el rendimiento
    mode: 'jit',
    content: [
      './**/*.html', // Asegúrate de que tus archivos HTML sean incluidos
      './**/*.php',  // Si usas PHP también
    ],
    theme: {
      extend: {
        // Definición de la paleta de colores personalizada
        colors: {
          'azul': '#043473',         // Azul principal
          'rojo': '#ef4444',         // Rojo principal
          'blanco': '#ffffff',       // Blanco
          'gris-claro': '#d1d5db',   // Gris claro
          'gris-oscuro': '#374151',  // Gris oscuro
          'negro': '#000A09',        // Tonalidad de negro
        },
        // Variables de tamaños
        spacing: {
          '4': '1rem',     // Tamaño 4 (espaciado pequeño)
          '8': '2rem',     // Tamaño 8
          '16': '4rem',    // Tamaño 16
          '32': '8rem',    // Tamaño 32
          '128': '32rem',  // Tamaño 128
        },
        fontFamily: {
          sans: ['Helvetica', 'Arial', 'sans-serif'], // Ejemplo de fuente
        },
        borderRadius: {
          'xl': '1.25rem', // Un valor adicional de border-radius
          'full': '9999px', // Border-radius completo
        },
        fontSize: {
          'sm': '0.875rem',  // Fuente pequeña
          'base': '1rem',    // Fuente base
          'lg': '1.125rem',  // Fuente grande
          'xl': '1.25rem',   // Fuente extra grande
          '2xl': '1.5rem',   // Fuente 2x extra grande
          '3xl': '1.875rem', // Fuente 3x extra grande
          '4xl': '2.25rem',  // Fuente 4x extra grande
          '5xl': '3rem',     // Fuente 5x extra grande
        },
      },
    },
    plugins: [],
}
