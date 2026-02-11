const datos = [];
const contenedor = document.getElementById('usuario');
obtenerCredenciales();
async function obtenerCredenciales() {
    try {
        const response = await fetch('/usuario-sesion', {
            method: 'POST'
        })

        if(!response.ok){
            throw new Error("Error al obtener credenciales...");
        }

        datos.push(await response.json());

        mostrarUsuario(datos);

    } catch (error) {
        console.log(error);
        
    }
    
}

function mostrarUsuario(datos){
    console.log(datos[0].nombre);
    contenedor.textContent= 'Bienvenido ' + datos[0].nombre;

}