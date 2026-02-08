/* VARIABLES GLOBALES */
const enlacePlan = document.getElementById("verPlan");
const datos = [];

/* ESCUCHADORES */
enlacePlan.addEventListener("click", obtenerPlan);

/* FUNCIONES */

/* OBTENCION DE DATOS */
async function obtenerPlan() {
	try {
		const response = await fetch("/plan", {
			method: "GET",
			signal: AbortSignal.timeout(10000)
		});

		if (!response.ok) {
            // Intentamos leer el texto del error que mandó PHP
            const textoError = await response.text();
            throw new Error(`PHP Error ${response.status}: ${textoError}`);
        }

		datos = await response.json();
	} catch(error) {
		console.error("Identificando el fallo:");
        console.error("- Tipo:", error.name);
        console.error("- Mensaje:", error.message);
	}

	if (datos) mostrarDatos();
}

/* TRATAMIENTO DE DATOS */
function mostrarDatos() {
	console.log(datos);
}