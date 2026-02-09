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
			signal: AbortSignal.timeout(20000)
		});

		datos.push(await response.json());

		if (!response.ok) {
			throw new Error("Error al obtener planes...");
		} else {
			console.log(datos);
			if (datos) mostrarDatos();
		}
	} catch(error) {
		console.log(error);
	}
}

/* TRATAMIENTO DE DATOS */
function obtenerTitulos() {
	const titulos = [];

	let nombres = datos[0].planes;

	Object.keys(nombres[0]).forEach(d => titulos.push(d));

	return titulos;
}

function mostrarDatos() {
	/* VARIABLES */
	const titulos = obtenerTitulos();
	const contenedor = document.getElementById("main-content");

	/* DECLARACIONES DE ELEMENTOS DEL DOM */
	const table = document.createElement("table");
	const thead = document.createElement("thead");
	const tbody = document.createElement("tbody");
	const tr = document.createElement("tr");

	/* CREACION DE CABECERA */
	for(let nombre in titulos) {
		const th = document.createElement("th");
		th.textContent = titulos[nombre];
		thead.append(th);
	}

	table.append("thead");

	contenedor.append(table);
}