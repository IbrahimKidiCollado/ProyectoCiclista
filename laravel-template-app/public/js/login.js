const links = document.querySelectorAll("#show-register, #show-login");

links.forEach(link => link.addEventListener("click", mostrarRegistro_mostrarInicio))


function mostrarRegistro_mostrarInicio(e) {
	const registro = document.getElementById("registro-container");
	const inicio = document.getElementById("inicio-container");

	inicio.classList.toggle("hidden");
	registro.classList.toggle("hidden");
}

