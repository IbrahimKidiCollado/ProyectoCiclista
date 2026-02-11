document.getElementById('cerrarSesion').addEventListener('click', cerrarSesion);

async function cerrarSesion(){
    console.log("entramos")
    try {
        const response = await fetch('/logout', {
            method: 'POST'
        })

        if(!response.ok){
            throw new Error("Error al cerrar sesion...");
        } else {
            Notificador.mostrar("Cerrado sesion correctamente", "exito")
        }

        window.location.href = '/';

    } catch (error) {
        console.log(error);
    }

}