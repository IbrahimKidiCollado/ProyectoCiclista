/* VARIABLES GLOBALES */
const formulario = document.getElementById("envioPlan");
/* ESCUCHADORES */
formulario.addEventListener("submit", crear);

console.log("Estamos en crear plan")
console.log(formulario)
/* ENVIO DE DATOS */
async function crear(e) {
	e.preventDefault();

	try {
		const fd = new FormData(formulario);
        const datosRaw = Object.fromEntries(fd.entries());

        const datos = {
        id_ciclista: Number(datosRaw.id_ciclista), // Forzamos a número
        nombre: datosRaw.nombre,
        descripcion: datosRaw.descripcion,
        fecha_inicio: datosRaw.fecha_inicio,
        fecha_fin: datosRaw.fecha_fin,
        objetivo: datosRaw.objetivo,
        activo: Number(datosRaw.activo) // El select envía "1", lo pasamos a 1
        };
        
        const response = await fetch("/plan/crear", {
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
			throw new Error("Error al obtener planes...");
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