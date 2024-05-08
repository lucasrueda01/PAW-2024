class Drag_Drop {
    constructor(dropAreaSelector, outputSelector) {
        this.dropArea = document.querySelector(dropAreaSelector);
        this.output = document.querySelector(outputSelector);

        this.inicializar();
    }

    inicializar() {
        this.dropArea.addEventListener("dragover", (e) => {
            e.preventDefault();
            e.stopPropagation();});

        this.dropArea.addEventListener("drop", (e) => {
            e.preventDefault();
            const imagen = e.dataTransfer.files[0];
            if (!imagen || !imagen.type.match("image")) 
                return;
            this.mostrar(imagen);
            this.eliminarDropArea()
        });
    }

    mostrar(imagen) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const imagenHTML = `<div class="image-dad">
                                    <img src="${e.target.result}" alt="image">
                               </div>`;
            this.output.innerHTML = imagenHTML;
        };
        reader.readAsDataURL(imagen);
    }

    eliminarDropArea() {
        if (this.dropArea) {
            this.dropArea.parentNode.removeChild(this.dropArea);
        }
    }
}

