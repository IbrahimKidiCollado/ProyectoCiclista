/* VARIABLES GLOBALES */
const enlacePlan = document.getElementById("verPlan");
const datos = [];

/* ESCUCHADORES */
enlacePlan.addEventListener("click", obtenerPlan);

/* FUNCIONES */

/* OBTENCION DE DATOS */
async function obtenerPlan() {
	try {
		console.log("hola");
		const response = await fetch("/plan", {
			method: "GET",
			signal: AbortSignal.timeout(25000)
		});

		if (!response.ok) throw new Error("Error al obtener planes...");

		datos.push(await response.json());
	} catch(error) {
		console.log(error);
	}

	if (datos) mostrarDatos();
}

/* TRATAMIENTO DE DATOS */
function mostrarDatos() {
	console.log(datos);
}