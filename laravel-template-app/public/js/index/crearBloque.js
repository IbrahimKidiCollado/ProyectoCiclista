/* VARIABLES GLOBALES */
const formulario = document.getElementById("envioBloque");
/* ESCUCHADORES */
formulario.addEventListener("submit", crear);


console.log("Estamos en crear bloque")
console.log(formulario)
/* ENVIO DE DATOS */
async function crear(e) {
	e.preventDefault();
	console.log("Entramos")
	//EXTRAEMOS LOS DATOS DE LA TABLA 
    const datos = {
		nombre: document.getElementById("nombre").value,
		descripcion: document.getElementById("descripcion").value,
		tipo: document.getElementById("tipo").value,
		duracion_estimada: document.getElementById("duracion").value, 
		potencia_pct_min: document.getElementById("potencia_min").value, 
		potencia_pct_max: document.getElementById("potencia_max").value, 
		pulso_pct_max: document.getElementById("pulso_max").value,
		pulso_reserva_pct: document.getElementById("pulso_min").value, 
		comentario: document.getElementById("comentario").value
	};
	try {
		const response = await fetch("/bloque/crear", {
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
			throw new Error("Error al obtener bloques...");
		} 

		//COMPROBAMOS QUE LA RESPUESTA ES CORRECTA
		if (response.ok) {
			//REDIRIGIMOS A LA PAGINA DE BLOQUES
			console.log(response);
		}
		
	} catch(error) {
		console.log(error);
	}
}