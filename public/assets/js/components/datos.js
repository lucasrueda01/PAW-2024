class Datos {

  static locales2 = {
    "Local A" : {
      "horaApertura": "09:00",
      "horaCierre": "21:00",
      "mesa" : ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"],
      "2024/05/06" : {
        "13:30" : ["mesa-162", "mesa-161", "mesa-144"],
        "15:00" : ["mesa-143", "mesa-142", "mesa-141", "mesa-126"],
      },
    "Local B" : {
      "horaApertura": "09:00",
      "horaCierre": "21:00",
      "mesa" : ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"],            
      "2024/05/07" : {
        "13:30" : ["mesa-162", "mesa-161", "mesa-144"],
        "15:00" : ["mesa-143", "mesa-142", "mesa-141", "mesa-126"]
      }
      }            
    }
  }
  static locales3 = {
    "Local A" : {
      "horaApertura": "09:00",
      "horaCierre": "21:00",
      "mesa" : ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"],
      "2024/05/06" : {
        "mesa-143" : [
          { horaInicio: '13:00', horaFin: '14:30' },
          { horaInicio: '15:00', horaFin: '16:30' }
        ],
        "mesa-161" : [
          { horaInicio: '13:00', horaFin: '14:30' },
          { horaInicio: '15:00', horaFin: '16:30' }
        ],
        "mesa-144" : [
          { horaInicio: '13:00', horaFin: '14:30' },
          { horaInicio: '15:00', horaFin: '16:30' }
        ]
      },
    "Local B" : {
      "horaApertura": "09:00",
      "horaCierre": "21:00",
      "mesa" : ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"],            
      "2024/05/07" : {
          "mesa-143" : [
            { horaInicio: '13:00', horaFin: '14:30' },
            { horaInicio: '15:00', horaFin: '16:30' }
            ],
          "mesa-161" : [
            { horaInicio: '13:00', horaFin: '14:30' },
            { horaInicio: '15:00', horaFin: '16:30' }
            ],
          "mesa-144" : [
            { horaInicio: '13:00', horaFin: '14:30' },
            { horaInicio: '15:00', horaFin: '16:30' }
            ]
        }
      }            
    }
  }


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
        return this.locales2
    }
          
}