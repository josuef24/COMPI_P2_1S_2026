# Manual Técnico - Golampi Compiler

## Arquitectura del Proyecto

El proyecto está diseñado bajo una arquitectura monolítica con una clara separación lógica (Cliente-Servidor).

- **Frontend:** HTML5, CSS3, Vanilla JS. Actúa como vista y manejador de eventos del usuario. No contiene lógica de compilación.
- **Backend:** PHP 8.x. Actúa como controlador y núcleo del compilador.
- **Analizador Lexicográfico y Sintáctico:** ANTLR4 genera clases en PHP (`GolampiLexer`, `GolampiParser`, `GolampiVisitor`) que forman el AST.
- **Generador de Código:** `ARM64Generator.php`.

## Flujo de Compilación (API Endpoint)

Cuando el usuario hace clic en "Compilar", se envía un POST a `api/compile.php`.

1. **Análisis Léxico/Sintáctico:**
   El código es consumido por `GolampiLexer`. Los tokens pasan a `GolampiParser`. Se capturan errores mediante `GolampiErrorListener` que reporta al objeto `ErrorReport`.

2. **Análisis Semántico (Patrón Visitor):**
   Si no hay errores graves, se invoca a `GolampiSemanticVisitor`, el cual:
   - Recorre el árbol.
   - Mantiene el ámbito usando `Environment`.
   - Llena la `SymbolTable` (inyectada en `SymbolReport`).
   - Resuelve el *hoisting* de funciones.
   - Verifica tipos usando `Types.php`.

3. **Generación de Código:**
   A medida que el Visitor evalúa las sentencias, llama a métodos de `ARM64Generator` para inyectar instrucciones en `.section .data` o `.section .text`.

## Tabla de Símbolos

Administrada en memoria por `Environment.php` (modelo de scopes enlazados) y reportada visualmente por `SymbolReport.php`.

## Generación ARM64

Se asume convención `AArch64`. Parámetros viajan por registros `x0-x7`. La función *print* embebida hace una llamada al sistema operativa local usando `svc 0` y la syscall 64 (`write`).
