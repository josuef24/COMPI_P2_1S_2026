document.addEventListener('DOMContentLoaded', () => {
    const editor = document.getElementById('code-editor');
    const lineNumbers = document.getElementById('line-numbers');
    const consoleOut = document.getElementById('output-console');
    let lastCompiledArm = null;

    // Line numbers update
    function updateLineNumbers() {
        const lines = editor.value.split('\n').length;
        lineNumbers.innerHTML = Array(lines).fill(0).map((_, i) => i + 1).join('<br>');
    }
    
    editor.addEventListener('input', updateLineNumbers);
    editor.addEventListener('scroll', () => {
        lineNumbers.scrollTop = editor.scrollTop;
    });

    // Action buttons
    document.getElementById('btn-new').addEventListener('click', () => {
        editor.value = '';
        updateLineNumbers();
        consoleOut.textContent = '';
        document.getElementById('report-errors').innerHTML = '<p class="empty-msg">No hay compilaciones recientes.</p>';
        document.getElementById('report-symbols').innerHTML = '<p class="empty-msg">No hay símbolos generados.</p>';
        lastCompiledArm = null;
    });

    document.getElementById('btn-load').addEventListener('click', () => {
        document.getElementById('file-upload').click();
    });

    document.getElementById('file-upload').addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            editor.value = e.target.result;
            updateLineNumbers();
        };
        reader.readAsText(file);
    });

    document.getElementById('btn-save').addEventListener('click', () => {
        const text = editor.value;
        const blob = new Blob([text], { type: 'text/plain' });
        const a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = 'codigo.gl';
        a.click();
    });

    document.getElementById('btn-clear-console').addEventListener('click', () => {
        consoleOut.textContent = '';
    });

    // Compilation
    document.getElementById('btn-compile').addEventListener('click', async () => {
        const code = editor.value;
        if (!code.trim()) return;

        consoleOut.textContent = 'Compilando...';
        
        try {
            // Note: Use absolute URL for dev server if necessary, assuming api/compile.php is accessible
            const res = await fetch('../api/compile.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ code })
            });
            
            const data = await res.json();
            
            if (data.success) {
                consoleOut.textContent = "El código ensamblador ARM64 completo generado.\n\n" + data.assembly;
                lastCompiledArm = data.assembly;
            } else {
                consoleOut.textContent = data.error || "Resumen estructurado de errores detectados.\nRevisa el panel de reportes.";
                lastCompiledArm = null;
            }

            // Update reports
            document.getElementById('report-errors').innerHTML = data.errorsHtml || '<p class="empty-msg">No hay errores.</p>';
            document.getElementById('report-symbols').innerHTML = data.symbolsHtml || '<p class="empty-msg">Tabla de símbolos vacía.</p>';
            
        } catch (e) {
            consoleOut.textContent = 'Error de conexión con el servidor de compilación: ' + e;
        }
    });

    // Tabs
    document.querySelectorAll('.tab-btn[data-target]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.report-view').forEach(v => v.classList.remove('active'));
            
            btn.classList.add('active');
            document.getElementById(btn.dataset.target).classList.add('active');
        });
    });

    // Download ARM
    document.getElementById('btn-download-arm').addEventListener('click', () => {
        if (!lastCompiledArm) {
            alert('Debes compilar correctamente primero.');
            return;
        }
        const blob = new Blob([lastCompiledArm], { type: 'text/plain' });
        const a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = 'salida.s';
        a.click();
    });
});
