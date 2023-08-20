function confirmacion(e){
    if (confirm("¿estas seguro que deseas salir de la plataforma?")) {
        return true;
    } else {
        e.preventDefault();
    }
}
let linkDelet = document.querySelectorAll(".salir");
for (var i = 0; i < linkDelet.length; i++){
    linkDelet[i].addEventListener('click', confirmacion);
}