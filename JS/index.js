// Al cargar la página, cargar el carrito desde localStorage
window.onload = function() {
    cargarCarrito();
};
function limpiarcarrito(){
    localStorage.clear();
}

// Array para almacenar los productos en el carrito
let carrito = [];

// Función para cargar el carrito desde localStorage
function cargarCarrito() {
    console.log("Cargando carrito desde localStorage");
    const carritoGuardado = localStorage.getItem('carrito'); //Devuelve null si la clave no existe
    if (carritoGuardado) { //comprueba si es no null
        carrito = JSON.parse(carritoGuardado); //lo vuelve a convertir a un objeto
    } else { //Si no hay datos en el localstore se inicializa un array vacio
        carrito = [];
    }
    actualizarContadorCarrito(carrito.length);
}

// Función para guardar el carrito en localStorage
function guardarCarrito() {
    console.log("Guardando carrito en localStorage:", carrito);
    localStorage.setItem('carrito', JSON.stringify(carrito));
}

// Función para actualizar el contador del carrito
function actualizarContadorCarrito(cantidad) {
    // Obtener el elemento del contador del carrito, osea captura el span
    const contadorCarrito = document.getElementById('cuenta-carrito');
    if(contadorCarrito!=null){ //este if es para evitar errores en la consola pues
        //si no ha iniciado sesion entonces no se creara el contador y por ende sera null
    // Actualizar el contenido del contador, de lo que era 0 ahora es +1
    contadorCarrito.textContent = cantidad;} 
    else{
        console.log("Para evitar errores");
    }
}

// Función para agregar un producto al carrito
function agregarAlCarrito(idProducto) {
    // Aquí puedes enviar una solicitud AJAX al servidor para agregar el producto al carrito
    // Después de agregar el producto, actualiza el contador del carrito
    // Por ahora, solo incrementamos el contador en 1 (simulación)
    let cantidadActual = parseInt(document.getElementById('cuenta-carrito').textContent);
    actualizarContadorCarrito(cantidadActual + 1);
}

// Función para capturar datos del producto y agregarlo al array del carrito
function capturardatos(id_user,idpro, nombrepro, preciopro, tallapro, cantidadpro,imagenpro) {
    // Crear un objeto producto
    let producto = {
        id_usuario: id_user,
        id: idpro,
        nombre: nombrepro,
        precio: preciopro,
        talla: tallapro,
        cantidad: cantidadpro,
        unidades: 1,
        imagen: imagenpro,
    };

    // Verificar si el producto ya está en el carrito, variable representa un elemento del array
    //some sirve para verificar alguna condicion de todos los elementos del array
    let productoExiste = carrito.some(variable => variable.id === idpro); 

    if (productoExiste) {
        alert("Este producto ya fue añadido al carrito, intente con otro producto");
    } else {
        // Agregar el objeto producto al array carrito
        carrito.push(producto);
        // Llamar a la función para actualizar el contador del carrito
        agregarAlCarrito(idpro);
        // Guardar el carrito en localStorage
        guardarCarrito();
        console.log("hola");
    } 
}

function alerta_Sesion() {
    alert("Debe de iniciar Sesion");
}


console.log(carrito);



    
    //onclick="agregarAlCarrito('.$fila['id'].')"
    /**El método some es un método de los arrays en JavaScript que se utiliza para 
     * verificar si al menos un elemento del array cumple con una condición especificada. */