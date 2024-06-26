class Datos {

  static locales = {
    "Local A" : {
      "horaApertura": "09:00",
      "horaCierre": "21:00",
      "mesa" : ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"],
      "2024/05/07" : {
        "mesa-143" : [
          { horaInicio: '09:00', horaFin: '10:30' },
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
      "2024/05/08" : {
        "mesa-143" : [
          { horaInicio: '09:00', horaFin: '10:30' },
          { horaInicio: '13:00', horaFin: '14:30' },
          { horaInicio: '19:00', horaFin: '20:30' }
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
            
    },
    "Local B" : {
      "horaApertura": "09:00",
      "horaCierre": "21:00",
      "mesa" : ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"],            
      "2024/05/08" : {
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

    getLocales() {
      return fetch('/locales/get', {
          method: 'GET',
          headers: {
              'Content-Type': 'application/json'
          }
      })
      .then(response => {
          // Verificar si la respuesta es correcta
          if (!response.ok) {
              throw new Error('La respuesta de la red no fue correcta: ' + response.statusText);
          }
          return response.json();
      })
      .catch(error => {
          console.error('Ha habido un problema con su operación de recuperación: ', error);
          // Puede lanzar el error nuevamente si deseas manejarlo fuera de esta función
          throw error;
      });
  }
} 