# Manual de Usuario - Golampi Compiler

## Introducción
Golampi Compiler es una herramienta académica diseñada para compilar código fuente escrito en el lenguaje Golampi (un dialecto inspirado en Go) a código ensamblador ARM64 (AArch64). 

## Instalación y Ejecución

### Requisitos Previos
- PHP 8.0 o superior
- Navegador Web moderno (Chrome, Firefox, Edge, Safari)

### Pasos para iniciar
1. Abre una terminal en la carpeta raíz del proyecto.
2. Ejecuta el servidor integrado de PHP:
   ```bash
   php -S localhost:8000
   ```
3. Abre tu navegador web y navega a `http://localhost:8000/`. Serás redirigido a la interfaz principal del compilador.

## Interfaz Gráfica (GUI)

La interfaz gráfica consta de tres áreas principales:

1. **Barra de Acciones (Arriba):**
   - **Nuevo / Limpiar:** Borra el editor de código, la consola y los reportes para iniciar de cero.
   - **Cargar archivo:** Permite subir un archivo con extensión `.gl` o `.txt` desde tu computadora.
   - **Guardar código:** Descarga el código actual del editor a tu computadora.
   - **Compilar:** Inicia el proceso de análisis léxico, sintáctico, semántico y de generación de código ARM64.
   - **Limpiar consola:** Borra la salida de la consola inferior.

2. **Área de Trabajo (Centro):**
   - **Editor de Código:** Un área de texto con números de línea para escribir tu código Golampi.
   - **Consola de Salida:** Muestra el código ensamblador ARM64 generado o los mensajes de error principales de la compilación.

3. **Panel de Reportes (Abajo):**
   - **Pestaña Errores:** Muestra una tabla detallada con los errores léxicos, sintácticos o semánticos detectados.
   - **Pestaña Tabla de Símbolos:** Muestra las variables, funciones, arreglos y constantes generadas en el entorno.
   - **Descargar ARM64 (.s):** Si la compilación fue exitosa, permite descargar el archivo con código ensamblador ARM64 listo para ejecutarse en QEMU.

## Escribiendo Código Golampi

El lenguaje soporta:
- Declaración de variables: `var x int32 = 10` o corta `x := 10`
- Constantes: `const pi float32 = 3.14`
- Funciones y función `main`:
  ```go
  func main() {
      fmt.Println("Hola Mundo")
  }
  ```
- Arreglos, operaciones aritméticas, relacionales y lógicas.
- Estructuras de control de flujo: `if / else`, `for`, `switch`.
