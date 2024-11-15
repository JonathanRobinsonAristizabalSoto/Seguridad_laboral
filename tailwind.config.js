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
        '1': '0.25rem',   // Tamaño 1
        '2': '0.5rem',    // Tamaño 2
        '4': '1rem',      // Tamaño 4 (espaciado pequeño)
        '8': '2rem',      // Tamaño 8
        '16': '4rem',     // Tamaño 16
        '32': '8rem',     // Tamaño 32
        '64': '16rem',    // Tamaño 64
        '128': '32rem',   // Tamaño 128
      },
      fontFamily: {
        sans: ['Roboto', 'Helvetica', 'Arial', 'sans-serif'], // Fuente para el cuerpo del texto
        heading: ['Montserrat', 'Helvetica', 'Arial', 'sans-serif'], // Fuente para los encabezados
      },
      borderRadius: {
        'none': '0',       // Sin border-radius
        'sm': '0.125rem',  // Border-radius pequeño
        'md': '0.375rem',  // Border-radius mediano
        'lg': '0.5rem',    // Border-radius grande
        'xl': '1.25rem',   // Un valor adicional de border-radius
        'full': '9999px',  // Border-radius completo
      },
      fontSize: {
        'xs': '0.75rem',   // Fuente extra pequeña
        'sm': '0.875rem',  // Fuente pequeña
        'base': '1rem',    // Fuente base
        'lg': '1.125rem',  // Fuente grande
        'xl': '1.25rem',   // Fuente extra grande
        '2xl': '1.5rem',   // Fuente 2x extra grande
        '3xl': '1.875rem', // Fuente 3x extra grande
        '4xl': '2.25rem',  // Fuente 4x extra grande
        '5xl': '3rem',     // Fuente 5x extra grande
        '6xl': '3.75rem',  // Fuente 6x extra grande
        '7xl': '4.5rem',   // Fuente 7x extra grande
        '8xl': '6rem',     // Fuente 8x extra grande
        '9xl': '8rem',     // Fuente 9x extra grande
      },
      fontWeight: {
        'thin': '100',       // Fuente delgada
        'extralight': '200', // Fuente extra ligera
        'light': '300',      // Fuente ligera
        'normal': '400',     // Fuente normal
        'medium': '500',     // Fuente media
        'semibold': '600',   // Fuente semi negrita
        'bold': '700',       // Fuente negrita
        'extrabold': '800',  // Fuente extra negrita
        'black': '900',      // Fuente negra
      },
      lineHeight: {
        'none': '1',        // Sin espacio entre líneas
        'tight': '1.25',    // Espacio ajustado entre líneas
        'snug': '1.375',    // Espacio cómodo entre líneas
        'normal': '1.5',    // Espacio normal entre líneas
        'relaxed': '1.625', // Espacio relajado entre líneas
        'loose': '2',       // Espacio amplio entre líneas
      },
      letterSpacing: {
        'tighter': '-0.05em', // Espaciado más ajustado
        'tight': '-0.025em',  // Espaciado ajustado
        'normal': '0em',      // Espaciado normal
        'wide': '0.025em',    // Espaciado amplio
        'wider': '0.05em',    // Espaciado más amplio
        'widest': '0.1em',    // Espaciado máximo
      },
      width: {
        'auto': 'auto',       // Ancho automático
        'px': '1px',          // Ancho de 1 píxel
        '0': '0',             // Ancho de 0
        '1/2': '50%',         // Ancho de 50%
        '1/3': '33.333333%',  // Ancho de 33.333333%
        '2/3': '66.666667%',  // Ancho de 66.666667%
        '1/4': '25%',         // Ancho de 25%
        '3/4': '75%',         // Ancho de 75%
        '1/5': '20%',         // Ancho de 20%
        '2/5': '40%',         // Ancho de 40%
        '3/5': '60%',         // Ancho de 60%
        '4/5': '80%',         // Ancho de 80%
        '1/6': '16.666667%',  // Ancho de 16.666667%
        '5/6': '83.333333%',  // Ancho de 83.333333%
        'full': '100%',       // Ancho completo
        'screen': '100vw',    // Ancho de la pantalla
      },
      height: {
        'auto': 'auto',       // Alto automático
        'px': '1px',          // Alto de 1 píxel
        '0': '0',             // Alto de 0
        'full': '100%',       // Alto completo
        'screen': '100vh',    // Alto de la pantalla
      },
      boxShadow: {
        'sm': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',  // Sombra pequeña
        'DEFAULT': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',  // Sombra por defecto
        'md': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',  // Sombra mediana
        'lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',  // Sombra grande
        'xl': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',  // Sombra extra grande
        '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',  // Sombra 2x extra grande
        'inner': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',  // Sombra interna
        'none': 'none',  // Sin sombra
      },
      flex: {
        '1': '1 1 0%',  // Flex 1
        'auto': '1 1 auto',  // Flex automático
        'initial': '0 1 auto',  // Flex inicial
        'none': 'none',  // Sin flex
      },
      flexGrow: {
        '0': '0',  // Sin crecimiento
        'DEFAULT': '1',  // Crecimiento por defecto
      },
      flexShrink: {
        '0': '0',  // Sin reducción
        'DEFAULT': '1',  // Reducción por defecto
      },
    },
  },
  plugins: [],
}