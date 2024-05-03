document.addEventListener("DOMContentLoaded", function() {

    // Obtener todas las mesas
    const mesas = document.querySelectorAll('.mesa');
    
    // Agregar un evento de clic a cada mesa
    mesas.forEach(mesa => {
      mesa.addEventListener('click', function(event) {
        // Obtener el ID de la mesa clickeada
        const mesaId = event.target.id;
        
        // Hacer lo que necesites con el ID de la mesa clickeada
        console.log('ID de la mesa clickeada:', mesaId);
        
        // Por ejemplo, podrías guardarlo en una variable global, enviarlo a un servidor, etc.
        // globalVariable = mesaId;
      });
    });
    
});
    