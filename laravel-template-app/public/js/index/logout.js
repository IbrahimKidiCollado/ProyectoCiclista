const cerrar = document.getElementById('cerrarSesion');

cerrar.addEventListener('click', cerrarSesion);

async function cerrarSesion(){
    console.log("entramos")
    try {
        const response = await fetch('/logout', {
            method: 'POST'
        })

        if(!response.ok){
            throw new Error("Error al cerrar sesion...");
        }

        window.location.href = '/';

    } catch (error) {
        console.log(error);
        
    }

}