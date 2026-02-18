/* VARIABLES GLOBALES */
const enlace = document.getElementById("crearBloque");

/* ESCUCHADORES */
enlace.addEventListener("click", crear);


/* ENVIO DE DATOS */
async function crear() {
    const datos = {
        nombre: document.getElementById("nombre").value,
        descripcion: document.getElementById("descripcion").value,
        tipo: document.getElementById("tipo").value,
        duracion: document.getElementById("duracion").value,
        potencia_min: document.getElementById("potencia_min").value,
        potencia_max: document.getElementById("potencia_max").value,
        pulso_max: document.getElementById("pulso_max").value,
        pulso_min: document.getElementById("pulso_min").value,
        comentario: document.getElementById("comentario").value
    };
	try {
		
		//EXTRAEMOS LOS DATOS DE LA TABLA 
		const response = await fetch("/bloque/crear", {
			//METODO QUE USAMOS
			method: "POST",
			//TIEMPO QUE VAMOS A ESPERAR LA RESPUESTA
			signal: AbortSignal.timeout(5000),
			headers: {
				"Content-Type": "application/json"
			},
            body: JSON.stringify(datos)
		});
		
		//COMPROBAMOS QUE LA EXTRACCION A SALIDO BIEN
		if (!response.ok) {
			throw new Error("Error al obtener bloques...");
		} else {
			
		}
	} catch(error) {
		console.log(error);
	}
}