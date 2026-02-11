window.Notificador = {
    init() {
        if (!document.getElementById('container-alertas')) {
            const container = document.createElement('div');
            container.id = 'container-alertas';
            document.body.appendChild(container);
        }
    },

    mostrar(mensaje, tipo = 'exito') {
        this.init();
        const container = document.getElementById('container-alertas');

        const iconos = {
            'exito': '\u2714', // Tick ✔
            'error': '\u2716', // Cruz ✖
            'info':  '\u2139'  // Info ℹ
        };

        const alerta = document.createElement('div');
        alerta.classList.add('alerta-personalizada', `alerta-${tipo}`);

        alerta.innerHTML = `
            <div style="display: flex; align-items: center;">
                <span style="margin-right: 12px; font-size: 1.2rem; font-weight: bold;">
                    ${iconos[tipo]}
                </span>
                <span>${mensaje}</span>
            </div>
            <strong style="margin-left: 20px; cursor: pointer; font-size: 1.2rem;">&times;</strong>
        `;

        container.appendChild(alerta);

        const duracion = (tipo === 'error') ? 6000 : 4000;

        const eliminar = () => {
            if (alerta.parentElement) {
                alerta.classList.add('alerta-salida');
                alerta.addEventListener('animationend', () => alerta.remove());
            }
        };

        const timer = setTimeout(eliminar, duracion);

        alerta.onclick = () => {
            clearTimeout(timer);
            eliminar();
        };
    }
};