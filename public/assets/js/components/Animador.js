class Animador {
    animar(elemento, duracion, clase) {

        console.log(`agregando clase: ${clase}, al elemento`)
        console.log(elemento)
        // Aplicar una clase para activar la animación
        elemento.classList.add(`${clase}`)

        // Detener la animación después del tiempo especificado
        setTimeout(() => {
            elemento.classList.remove(`${clase}`)
            console.log(`quitando clase: ${clase}`)
        }, duracion);
    }
}