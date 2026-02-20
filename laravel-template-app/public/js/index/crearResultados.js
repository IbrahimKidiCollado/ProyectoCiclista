/* VARIABLES GLOBALES */
const formulario = document.getElementById("envioResultados");
/* ESCUCHADORES */
formulario.addEventListener("submit", crear);

console.log("Estamos en crear resultados")
console.log(formulario)
/* ENVIO DE DATOS */
async function crear(e) {
	e.preventDefault();

	try {
		const fd = new FormData(formulario);
        const datosRaw = Object.fromEntries(fd.entries());

        
		const datos = {
			id_ciclista: Number(datosRaw.id_ciclista) || 0,
			id_sesion: datosRaw.id_sesion_planificada ? Number(datosRaw.id_sesion_planificada) : null,
			fecha: datosRaw.fecha,
			duracion_real: datosRaw.duracion, 
			distancia_total: parseFloat(datosRaw.distancia_km) || 0, 
			potencia_media: Number(datosRaw.vatios_medios) || 0,
			pulso_medio: Number(datosRaw.pulso_medio) || 0,
			esfuerzo_percibido: Number(datosRaw.esfuerzo_rpe) || 0,
			calorias: Number(datosRaw.calorias) || 0, 
			comentarios_post_entreno: datosRaw.comentario || ""
		};
        
        const response = await fetch("/resultado/crear", {
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
			throw new Error("Error al obtener resultados...");
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