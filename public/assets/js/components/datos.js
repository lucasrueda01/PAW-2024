class Datos {

    

    constructor()
    {
        
        this.locales = [

            {
                "nombre": "Local A",
                "horaApertura": "09:00",
                "horaCierre": "21:00",
                "mesas": [
                  {"nombre_mesa": "mesa-162", "ocupada": true, "fecha_reserva": "2024-05-01", "hora_reserva": "12:00"},
                  {"nombre_mesa": "mesa-161", "ocupada": false},
                  {"nombre_mesa": "mesa-144", "ocupada": true, "fecha_reserva": "2024-05-01", "hora_reserva": "13:30"},
                  {"nombre_mesa": "mesa-143", "ocupada": false},
                  {"nombre_mesa": "mesa-142", "ocupada": false},
                  {"nombre_mesa": "mesa-141", "ocupada": false},
                  {"nombre_mesa": "mesa-126", "ocupada": false},
                  {"nombre_mesa": "mesa-125", "ocupada": false},
                  {"nombre_mesa": "mesa-124", "ocupada": false},
                  {"nombre_mesa": "mesa-123", "ocupada": false},
                  {"nombre_mesa": "mesa-122", "ocupada": true, "fecha_reserva": "2024-05-06", "hora_reserva": "13:30"},
                  {"nombre_mesa": "mesa-121", "ocupada": false},
                  {"nombre_mesa": "mesa-342", "ocupada": false},
                  {"nombre_mesa": "mesa-341", "ocupada": false},
                  {"nombre_mesa": "mesa-322", "ocupada": true, "fecha_reserva": "2024-05-06", "hora_reserva": "13:30"},
                  {"nombre_mesa": "mesa-321", "ocupada": false},
                  {"nombre_mesa": "mesa-262", "ocupada": false},
                  {"nombre_mesa": "mesa-261", "ocupada": false},
                  {"nombre_mesa": "mesa-241", "ocupada": false},
                  {"nombre_mesa": "mesa-223", "ocupada": false},
                  {"nombre_mesa": "mesa-222", "ocupada": true, "fecha_reserva": "2024-05-01", "hora_reserva": "15:30"},
                  {"nombre_mesa": "mesa-221", "ocupada": false}
                ]
              },
              {
                "nombre": "Local B",
                "horaApertura": "09:00",
                "horaCierre": "21:00",
                "mesas": [
                  {"nombre_mesa": "mesa-162", "ocupada": true, "fecha_reserva": "2024-05-01", "hora_reserva": "12:00"},
                  {"nombre_mesa": "mesa-161", "ocupada": false},
                  {"nombre_mesa": "mesa-144", "ocupada": true, "fecha_reserva": "2024-05-01", "hora_reserva": "13:30"},
                  {"nombre_mesa": "mesa-143", "ocupada": false},
                  {"nombre_mesa": "mesa-142", "ocupada": false},
                  {"nombre_mesa": "mesa-141", "ocupada": false},
                  {"nombre_mesa": "mesa-126", "ocupada": false},
                  {"nombre_mesa": "mesa-125", "ocupada": false},
                  {"nombre_mesa": "mesa-124", "ocupada": false},
                  {"nombre_mesa": "mesa-123", "ocupada": false},
                  {"nombre_mesa": "mesa-122", "ocupada": false},
                  {"nombre_mesa": "mesa-121", "ocupada": false},
                  {"nombre_mesa": "mesa-342", "ocupada": false},
                  {"nombre_mesa": "mesa-341", "ocupada": false},
                  {"nombre_mesa": "mesa-322", "ocupada": false},
                  {"nombre_mesa": "mesa-321", "ocupada": false},
                  {"nombre_mesa": "mesa-262", "ocupada": false},
                  {"nombre_mesa": "mesa-261", "ocupada": false},
                  {"nombre_mesa": "mesa-241", "ocupada": false},
                  {"nombre_mesa": "mesa-223", "ocupada": false},
                  {"nombre_mesa": "mesa-222", "ocupada": false},
                  {"nombre_mesa": "mesa-221", "ocupada": false}      
                ]
              }
            ]
    }

    getLocales() 
    {
        return this.locales
    }
          

}