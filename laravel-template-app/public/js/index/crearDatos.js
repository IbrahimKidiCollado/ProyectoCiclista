// VARIABLES GLOBALES
const enlace = document.getElementById("crear");
const contenedor = document.getElementById("main");
let eleccion;

//ESCUCHADORES
enlace.addEventListener("click", mostrarFormularioDeEleccion);

//FORMULARIO PARA LA ELECCION DEL ENTRENAMIENTO QUE HAY QUE CREAR
function mostrarFormularioDeEleccion() {
    const eleccionEntrenamiento = `
    <form id="formularioEleccion">
            <h2>Crear nuevo</h2>
            <label for="entrenamientos">Elige el tipo de entrenamiento: </label>
            <select name="entrenamientos" id="entrenamientos">
                <option value="Bloques">Bloques</option>
                <option value="Sesiones">Sesiones</option>
                <option value="Planes">Planes</option>
                <option value="SesionBloque">Sesiones Bloques</option>
            </select>
            <button type="submit" id="enviarEleccionCrear">Enviar</button>
        </form>
    `;

    contenedor.innerHTML = eleccionEntrenamiento;
    eleccion = document.getElementById("enviarEleccionCrear");
    eleccion.addEventListener("click", FormularioAdaptado);
}

function FormularioAdaptado(e) {
    e.preventDefault();

    const formularioEleccion = document.getElementById("formularioEleccion");
    const form = new FormData(formularioEleccion);
    const valores = Object.fromEntries(form.entries());

    if (valores.entrenamientos == "Bloques") {
        crearBloque();
    } else if (valores.entrenamientos == "Sesiones") {
        crearSesion();
    } else if (valores.entrenamientos == "Planes") {
        crearPlan();
    } else if (valores.entrenamientos == "SesionBloque") {
        crearSesionBloque();
    }
}

function crearBloque() {
    window.location.href = "/bloque/crear";
}

function crearSesion() {
    window.location.href = "/sesion/crear";
}

function crearPlan() {
    window.location.href = "/plan/crear";
}

function crearSesionBloque() {
    window.location.href = "/sesionbloque/crear";
}