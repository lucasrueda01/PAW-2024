class Drag_Drop {
    constructor(dropAreaSelector, outputSelector) {
        this.dropArea = document.querySelector(dropAreaSelector);
        this.output = document.querySelector(outputSelector);

        this.initialize();
    }

    initialize() {
        this.dropArea.addEventListener("dragover", (e) => this.handleDragOver(e));
        this.dropArea.addEventListener("drop", (e) => this.handleDrop(e));
    }

    handleDragOver(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    handleDrop(e) {
        e.preventDefault();
        const file = e.dataTransfer.files[0];
        if (!file || !file.type.match("image")) return;

        this.displayImage(file);
    }

    displayImage(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const imageHTML = `<div class="image-dad">
                                    <img src="${e.target.result}" alt="image">
                               </div>`;
            this.output.innerHTML = imageHTML;
        };
        reader.readAsDataURL(file);
    }
}

