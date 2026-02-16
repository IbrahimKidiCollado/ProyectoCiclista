/* VARIABLES GLOBALES */
const enlace = document.getElementById("historico_ciclista");
let datos = [];

/* ESCUCHADORES */
enlace.addEventListener("click", obtenerDatos);

//FUNCIONES PARA TAREAS ESPECIFICAS

function isEmpty(obj) {return !obj || obj.length === 0;}

/* FUNCIONES CORRIENTES */

/* OBTENCION DE DATOS */
async function obtenerDatos() {
	try {
		
		//EXTRAEMOS LOS DATOS DE LA TABLA 
		const response = await fetch(`/ciclista/historial/${obtenerIdSesion()}`, {
			//METODO QUE USAMOS
			method: "GET",
			//TIEMPO QUE VAMOS A ESPERAR LA RESPUESTA
			signal: AbortSignal.timeout(5000)
		});
		
		//COMPROBAMOS QUE LA EXTRACCION A SALIDO BIEN
		if (!response.ok) {
			throw new Error("Error al obtener el historico ciclista...");
		} else {
			//VACIAMOS LA VARIABLE GLOBAL
			datos.length = 0;
			//AÑADIMOS LOS DATOS AL ARRAY GLOBAL CREADO PARA LOS DATOS
			datos.push(await response.json());
			datos = datos[0];
			console.log(datos);
			// SI NO HUBIERA DATOS NO MOSTRAMOS NADA
			if (!isEmpty(datos)) mostrarDatos();
		}
	} catch(error) {
		console.log(error);
	}
}

/* TRATAMIENTO DE DATOS */
function obtenerTitulos() {
	const titulos = [];
	let nombres = datos["historial"];

	Object.keys(nombres[0]).forEach(d => titulos.push(d));

	return titulos;
}

function obtenerIdSesion() {
    const id = document.cookie
  .split("; ")
  .find((row) => row.startsWith("usuario_id="))
  ?.split("=")[1];

    console.log(id);
    return id;
    }

function mostrarDatos() {
	/* VARIABLES */
	const contenedor = document.getElementById("main");
	const table = document.createElement("table");
	
	//INVOCAMOS FUNCIONES QUE CREAR LAS PARTES DE LA TABLA E INSERTAMOS EN LA MISMA
	table.append(creacionCabecera(), creacionCuerpo());
	//VACIAMOS CONTENEDOR DE MUESTREO PARA QUE NO SE APILEN LAS TABLAS
	contenedor.innerHTML = "";
	//INSERTAMOS LA TABLA FINAL
	contenedor.append(table);
}

// CREACION DE LA CABECERA CON LOS TITULOS DINAMICOS DE LAS TABLAS
function creacionCabecera() {
	//VARIABLES
	const titulos = obtenerTitulos();
	const thead = document.createElement("thead");
	const trHead = document.createElement("tr");

	// ITERAMOS SOBRE EL ARRAY DE TITULOS
	for(let nombre in titulos) {
		const th = document.createElement("th");
		th.textContent = titulos[nombre];
		trHead.append(th);
	}
	thead.append(trHead);
	return thead;
}

// CREACION DE EL CUERPO DE LAS TABLAS
function creacionCuerpo() {
	//VARIABLES
	const tbody = document.createElement("tbody");
	const arrayDatos = datos["historial"];

	// ACCEDEMOS AL ARRAY DE OBJETOS
	arrayDatos.forEach(objeto => {
        const tr = document.createElement("tr");

        // EXTRAEMOS LOS VALORES DE CADA UNO DE LOS OBJETOS
        const valores = Object.values(objeto);

		//ITERAMOS SOBRE LOS VALORES EXTRAIDOS PARA INCORPORAR LAS FILAS Y COLUMNAS
        valores.forEach(valor => {
            const td = document.createElement("td");
            td.textContent = valor;
            tr.append(td);
        });

        tbody.append(tr);
    });

	return tbody;
}