// VARIABLES GLOBALES
const enlace = document.getElementById("crear");
const contenedor = document.getElementById("main");

//ESCUCHADORES
enlace.addEventListener("click", mostrarFormularioDeEleccion);

//FORMULARIO PARA LA ELECCION DEL ENTRENAMIENTO QUE HAY QUE CREAR
function mostrarFormularioDeEleccion() {
    const eleccionEntrenamiento = `
    <form>
            <h2>Crear nuevo</h2>
            <label for="entrenamientos">Elige el tipo de entrenamiento: </label>
            <select name="entrenamientos" id="entrenamientos">
                <option value="Bloques">Bloques</option>
                <option value="Sesiones">Sesiones</option>
                <option value="Planes">Planes</option>
            </select>
        </form>
    `;

    contenedor.innerHTML = eleccionEntrenamiento;
}

function crearFormularioAdaptado() {
    console.log(" ");
}