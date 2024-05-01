document.addEventListener('DOMContentLoaded', function() {
    
    var svgObject = document.getElementById('svg-object');

    svgObject.addEventListener('load', function() {
        
        var svgDoc = svgObject.contentDocument;
        
        if (svgDoc) {
            
            var circulo = svgDoc.querySelector("#mesa-162 .mesa");
            if (circulo) {
                circulo.style.fill = "red";
            }
        }
    });
});
