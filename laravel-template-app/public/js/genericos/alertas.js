const Notificador = {
    init() {
        // Crea el contenedor si no existe
        if (!document.getElementById('container-alertas')) {
            const container = document.createElement('div');
            container.id = 'container-alertas';
            document.body.appendChild(container);
        }
    },

    mostrar(mensaje, tipo = 'exito') {
        this.init();
        const container = document.getElementById('container-alertas');
        
        const alerta = document.createElement('div');
        alerta.classList.add('alerta-personalizada', `alerta-${tipo}`);
        
        alerta.innerHTML = `
            <span>${mensaje}</span>
            <strong style="margin-left: 10px; opacity: 0.7;">&times;</strong>
        `;

        container.appendChild(alerta);

        // Auto-eliminar después de 4 segundos
        const eliminar = () => {
            alerta.classList.add('alerta-salida');
            alerta.addEventListener('animationend', () => alerta.remove());
        };

        const timer = setTimeout(eliminar, 4000);

        // Eliminar al hacer clic
        alerta.onclick = () => {
            clearTimeout(timer);
            eliminar();
        };
    }
};