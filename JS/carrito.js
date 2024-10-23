window.onload = function() { //para que ni bien se cargue la pagina carrito se llama a la funcion
    cargarProductosAlCarrito();
    Obtenertotal();
    VerDetalle();
}
let inicioreccore;
let deitem;
let mitem;
let miitems;
let mas;
let menos;
let unidadesp;
let saltolinea;
let carrito; //variable global importante captura el arreglo de local storage
let preciototal=0;
let acumulador=preciototal;
function cargarProductosAlCarrito(){ //esta funcion solo se llama una vez cuando carga la pagina
    //obtiene el array desde el localstorage
    carrito=JSON.parse(localStorage.getItem("carrito"));
    if(carrito && Array.isArray(carrito)){ //verificar si existe el array
        //iterar sobre cada objeto producto
        carrito.forEach(element => {
            let prodiv= document.createElement("div");
            let ppro=document.createElement("p");
            let imgpro=document.createElement("img");
            mas=document.createElement("button");
            unidadesp=document.createElement("label");
            menos=document.createElement("button");
            saltolinea=document.createElement("br");
                //se le agrega contenido a cada elemento de un div tales como un onclick, src o una id
                ppro.textContent = "" + element.nombre; 
                imgpro.src =element.imagen;
                mas.textContent="+";
                mas.onclick=function(){ //se usa una funcion anonima para que llame a la funcion incrementar
                incrementar(element.id);
                };
                unidadesp.textContent=element.unidades;
                unidadesp.id="uni"+element.id; //asigna un id al elemento unidades que es un label
                menos.textContent="-";
                menos.onclick=function(){ //Se usa una funcion anonima para llarmar a la funcion decrementar
                    decrementar(element.id);
                };
            //selecciono a esa seccion por su id
            let seccion= document.getElementById("mi-seccion");
            if (seccion) {
                prodiv.appendChild(ppro);
                prodiv.appendChild(imgpro);
                prodiv.appendChild(saltolinea);
                prodiv.appendChild(mas);
                prodiv.appendChild(unidadesp);
                prodiv.appendChild(menos);
                seccion.appendChild(prodiv);
            }else{
                console.log("No se encontro la seccion")
            }
        });
    }
}
let aumenta; //se declaran estas variables de forma global
let disminuir;
//pendiente agregar restricciones y mas funcionalidad
function incrementar(idProducto){
    let capturaLabelMas=document.getElementById("uni"+idProducto);
    aumenta=parseInt(capturaLabelMas.textContent); //captura el numero actual
    if(aumenta<10){
    capturaLabelMas.textContent = aumenta + 1; //aqui ya aumento sin problemas
    mitem=JSON.parse(localStorage.getItem("carrito")); //DEBERIA FUNCIONAR
    mitem.forEach(buscador => {
        if (idProducto==buscador.id) {//solo busca a uno con ese Id
            buscador.unidades=capturaLabelMas.textContent;
            localStorage.setItem("carrito",JSON.stringify(mitem)); //SI FUNCIONA Y SE MANTIENE
            sumar(parseFloat(buscador.precio * 1)); //retorna en acumulador
            //CON ESTO EL PRECIO DISMINUYE DE ACUERDO AL PRODUCTO Incrementa
            let guardadadon=document.getElementById("totalfinal");
            guardadadon.textContent="Precio total: "+acumulador.toString();
        }
    });
}
    else{
        alert('Se ha agotado la cantidad disponible de este producto en la tienda');
    }
    VerDetalle();
}

function decrementar(idProducto){
    let capturaLabelMenos=document.getElementById("uni"+idProducto);
    disminuir=parseInt(capturaLabelMenos.textContent); //captura el numero actual en el label
    if(disminuir>1){
    capturaLabelMenos.textContent=disminuir-1;
    deitem=JSON.parse(localStorage.getItem("carrito")); //DEBERIA FUNCIONAR
    deitem.forEach(buscador => {
        if (idProducto==buscador.id) { //SOLO BUSCA A ESE PRODUCTO
            buscador.unidades=capturaLabelMenos.textContent;
            localStorage.setItem("carrito",JSON.stringify(deitem)); //SI FUNCIONA Y SE MANTIENE
            restar(parseFloat(buscador.precio * 1)); 
            //
            let preciorestado= preciototal - parseFloat(buscador.precio * 1); //necesita agarrar la ultima
            //CON ESTO EL PRECIO DISMINUYE DE ACUERDO AL PRODUCTO DECREMENTADO
            let guardadadon=document.getElementById("totalfinal");
            guardadadon.textContent="Precio total: "+ acumulador.toString();
        }
    });
}
    else{
        alert('Lo sentimos, no puede execeder la cantidad disponible de este producto en la tienda');
    }
    VerDetalle();

}


function limpiarcarritos(){
    localStorage.clear();
}
function VerDetalle(){ //llamar
    miitems=JSON.parse(localStorage.getItem("carrito"));
    let survivor=document.getElementById("Detalle");
    survivor.textContent="";
    miitems.forEach(element => {
        let didi=document.createElement("div");
        let h3mostrar=document.createElement("h3");
        h3mostrar.id="DeadpoolAndWolwerine";
        let mate=(parseInt(element.unidades)*parseInt(element.precio));//
        h3mostrar.textContent="Subtotal de "+element.nombre+" : $"+ 
        element.unidades+ " x " + element.precio+ " = "
        +mate.toString()+".00";
        let salto=document.createElement("br");
        let texto=document.getElementById("Detalle");
        didi.appendChild(salto);
        didi.appendChild(h3mostrar);
        texto.appendChild(didi);
    });
}
function Obtenertotal(){ //Se llama una vez por cada compra
    inicioreccore=JSON.parse(localStorage.getItem("carrito"));
    inicioreccore.forEach(element => {
        preciototal=preciototal+(parseFloat(element.unidades)*parseFloat(element.precio));
    });
    let guardadadon=document.getElementById("totalfinal");
    guardadadon.textContent=" Precio total: $"+ preciototal.toString()+".00";
    acumulador=preciototal;
}
function sumar(numero){
    acumulador+=numero;
    return acumulador;
}
function restar(numero){
acumulador-=numero;
return acumulador;
}
/**

 */