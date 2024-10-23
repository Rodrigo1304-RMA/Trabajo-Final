console.log("Archivo venta.js cargado");

// Función para enviar el carrito al servidor mediante AJAX
function evaluarCompra() {
    console.log("Archivo venta.js cargado");
    
    // Obtener el carrito desde localStorage
    let carritoFinal = JSON.parse(localStorage.getItem("carrito"));
    
    // Verificar si se obtuvo correctamente el carrito
    if (carritoFinal) {
        // Ruta del archivo PHP usando una ruta relativa desde la carpeta JS
        let urlProcesamiento = 'procesamientoDatos.php'; // Ajusta la ruta según la estructura de tus carpetas
        
        // Enviar datos al servidor mediante AJAX POST
        $.post(urlProcesamiento, { carrito: JSON.stringify(carritoFinal) }, function(datos, estado) {
            console.log("FUNCIONA"); // Esta función de callback se ejecuta cuando la solicitud AJAX se completa con éxito.
            console.log(datos); // Muestra los datos recibidos del servidor (opcional)
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
        });
    } else {
        console.log("No se pudo obtener el carrito desde localStorage");
    }
}


function limpiarcarritos(){
    localStorage.clear();
}

// Verificar si la página actual es final.php y ejecutar las funciones si es así
/*document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('final.php')) {
        console.log("Página final.php cargada");
        evaluarCompra();
        setTimeout(function() {
            window.location.href = 'Inicio.php'; // Redirigir al inicio
        }, 3000); // Redirigir después de 100ms
    }
});*/
window.onload = function() {
    console.log("La página final.php se ha cargado completamente");
    evaluarCompra();
    limpiarcarritos();
    enviarloexcel();
};

function enviarloexcel(){
        // Crear un enlace temporal para la descarga
        var link = document.createElement("a");
        link.href = 'excel.php';
        link.click();
    setTimeout(function() {
        window.location.href = 'Inicio.php'; // Redirige a la página de inicio
    }, 600); // Redirige después casi 1 segundo
}