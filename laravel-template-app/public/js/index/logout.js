document.getElementById('cerrarSesion').addEventListener('click', cerrarSesion);

async function cerrarSesion() {
    try {
        const response = await fetch('/logout', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!response.ok) throw new Error();

        if (window.Notificador) {
            window.Notificador.mostrar("Cerrando sesión correctamente...", "exito");
        }

        setTimeout(() => {
            window.location.href = '/';
        }, 1500);

    } catch (error) {
        if (typeof Notificador !== 'undefined') {
            Notificador.mostrar("No se pudo cerrar sesión", "error");
        }
        console.error("Error:", error);
    }
}