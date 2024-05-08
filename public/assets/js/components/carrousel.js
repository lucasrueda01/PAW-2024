class Carrousel {

    /*

    Recibe dos argumentos (clase, listaImagenes) ->
        clase         => contenedor de tipo class donde agregar el carrousel
        listaImagenes => ruta a las imagenes que van en el carrousel

    */
    
    constructor(clase, listaImagenes) {

    this._listaImagenes = listaImagenes;
    this._clase = clase;
    this._cantidadImagenes = this._listaImagenes.length;
    
    this.crearCarrousel();
    this.startCarrousel()
    this.selectImage();      
    
    }

    crearCarrousel() { 
        let porcentajeSlider = 100 * this._cantidadImagenes;

        let seccionCarrousel = document.querySelector(this._clase);
        let slider = PAW.nuevoElemento('div', '', {class: 'slider', style: 'width: ' + porcentajeSlider + '%'});
        seccionCarrousel.appendChild(slider);
        let div = seccionCarrousel.querySelector(".slider");

        this.agregarImagenes(this._listaImagenes, div);
        this.agregarPuntos(seccionCarrousel)

    }

    agregarImagenes(listaImagenes, contenedor) {
        listaImagenes.forEach(imagen => {
            let img = PAW.nuevoElemento('img','', {src: imagen, alt: 'comida', style: `width: calc(100% / ${this._cantidadImagenes})`});
            contenedor.appendChild(img)
        })
    }

    agregarPuntos(contenedor) {
        let ul = PAW.nuevoElemento('ul', '', {class: 'puntos'});
        let li;
        
       for (let i = 0; i < this._cantidadImagenes; i++) {
            if (i == 0)
                li = PAW.nuevoElemento('li', '', {class: 'punto activo'});
            else
                li = PAW.nuevoElemento('li', '', {class: 'punto'});
            ul.appendChild(li)
       }    

       contenedor.appendChild(ul);

    }

    startCarrousel() {
        let time = 3000;
        let imagenActual = 0;
        let punto = document.querySelectorAll('.punto')
        let slider = document.querySelector('.slider');
        let divisor = 100 / this._cantidadImagenes;
        
        let intervalID = setInterval(() => {

            let operacion = imagenActual * -divisor;
    
            slider.style.transform = `translateX(${operacion}%)`;

            this.pintarPunto(punto, imagenActual);

            if (imagenActual < this._cantidadImagenes - 1) {
                imagenActual = imagenActual + 1;
            } else
                imagenActual = 0
        }, time)
        
    }

    selectImage() {
        let punto = document.querySelectorAll('.punto');
        let slider = document.querySelector('.slider');
        let divisor = 100 / punto.length;
        punto.forEach((puntoParticular, i) => {
            punto[i].addEventListener('click', () => {
                let posicion = i;
                let operacion = posicion * -divisor;
                slider.style.transform = `translateX(${operacion}%)`;
                this.pintarPunto(punto, i);
        })    
        });  
    }

    pintarPunto(punto, i) {
        punto.forEach(( puntoParticular, i) => {
            punto[i].classList.remove('activo') 
        });
        punto[i].classList.add('activo');
    }
}