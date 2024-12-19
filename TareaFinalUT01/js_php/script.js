// V E R    P E R S I S T E N C I A

//Función para obtener el contenido del archivo desde el servidor
async function loadFileContent() {
    try {
        const response = await fetch('js_php/persistencia.php');
        if (!response.ok) throw new Error("Error al cargar el archivo");
        
        //Obtener el texto del archivo
        const text = await response.text(); 
        
        //los salto de linea los convierte en <br> (chatgpt)
        document.getElementById('contenido_persistencia').innerHTML = text.replace(/\n/g, "<br>");
    } catch (error) {
        document.getElementById('contenido_persistencia').textContent = "Error al cargar el contenido del archivo.";
        console.error(error);
    }
}

//Cargar el contenido al cargar la página
loadFileContent();


// M E N U   DE  LA   A P L I C A C I O N


//Función que me aplica el estilo a la opciòn seleccionada y quita la previamente seleccionada
function seleccionar(link) {
    var opciones = document.querySelectorAll('#links  a');
    opciones[0].className = "";
    opciones[1].className = "";
    opciones[2].className = "";
    opciones[3].className = "";
    opciones[4].className = "";
    link.className = "seleccionado";

    //Hacemos desaparecer el menu una vez que se ha seleccionado una opcion en modo responsive
    var x = document.getElementById("nav");
    x.className = "";
}

