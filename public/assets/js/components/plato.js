class Plato
{
    constructor(
        nombre,
        descripcion,
        precio,
        cantidad = 0,
        id
    ){
        this.nombre = nombre
        this.descripcion = descripcion,
        this.precio = precio
        this.cantidad = cantidad
        this.id = id
    }

    incrementarCantidad(cantidad = 1){
        this.cantidad += cantidad
    }

    descrementarCantidad(){
        if (this.cantidad >= 1){
            this.cantidad -= 1
        }
    }


}