function mostrar(mensaje, tipo = 'exito') {
    this.init();
    const container = document.getElementById('container-alertas');
    
    // DEFINIMOS ICONOS SEGUN TIPO DE ERROR
    const iconos = {
        'exito': '\u2714',
        'error': '\u2716',
        'info':  '\u2139'
    };

    // SI DA ERROR DURARÁ LA ALERTA 7 SEGUNDOS SINO 4
    const duracion = (tipo === 'error') ? 7000 : 4000;

    const alerta = document.createElement('div');
    alerta.classList.add('alerta-personalizada', `alerta-${tipo}`);
    
    alerta.innerHTML = `
        <span style="margin-right: 10px;">${iconos[tipo] || ''}</span>
        <span>${mensaje}</span>
        <strong style="margin-left: 15px; cursor: pointer; opacity: 0.7;">&times;</strong>
    `;

    container.appendChild(alerta);

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