/* VARIABLES GLOBALES */
const formulario = document.getElementById("envioSesionBloque");
/* ESCUCHADORES */
formulario.addEventListener("submit", crear);

console.log("Estamos en crear Sesion bloque")
console.log(formulario)
/* ENVIO DE DATOS */
async function crear(e) {
	e.preventDefault();

	try {
		const fd = new FormData(formulario);
        const datosRaw = Object.fromEntries(fd.entries());

        const datos = {
            id_sesion_entrenamiento: Number(datosRaw.id_sesion_entrenamiento), 
            id_bloque_entrenamiento: Number(datosRaw.id_bloque_entrenamiento),
            orden: Number(datosRaw.orden),
            repeticiones: Number(datosRaw.repeticiones)
        };
        
        const response = await fetch("/sesionbloque/crear", {
			//METODO QUE USAMOS
			method: "POST",
			//TIEMPO QUE VAMOS A ESPERAR LA RESPUESTA
			signal: AbortSignal.timeout(5000),
			headers: {
				"Content-Type": "application/json",
				"Accept": "application/json"
			},
            body: JSON.stringify(datos)
		});
		
		//COMPROBAMOS QUE LA EXTRACCION A SALIDO BIEN
		if (!response.ok) {
			throw new Error("Error al obtener sesiones bloques...");
		} 

		//COMPROBAMOS QUE LA RESPUESTA ES CORRECTA
		if (response.ok) {
			//REDIRIGIMOS A LA PAGINA DE BLOQUES
			console.log(response);
			window.location.href = "/index";
		}
		
	} catch(error) {
		console.log(error);
	}
}