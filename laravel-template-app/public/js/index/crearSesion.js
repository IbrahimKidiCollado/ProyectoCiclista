/* VARIABLES GLOBALES */
const formulario = document.getElementById("envioSesion");
/* ESCUCHADORES */
formulario.addEventListener("submit", crear);

console.log("Estamos en crear sesion")
console.log(formulario)
/* ENVIO DE DATOS */
async function crear(e) {
	e.preventDefault();

	try {
		const fd = new FormData(formulario);
    
        const datos = Object.fromEntries(fd.entries());
        
        const response = await fetch("/sesion/crear", {
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
			throw new Error("Error al obtener sesiones...");
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