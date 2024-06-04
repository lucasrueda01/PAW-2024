class Utils {

  static formatCurrency(number) {
      return number.toLocaleString('es-AR', {
        style: 'currency',
        currency: 'ARS',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    }

    static getCookie(name) {
      let cookieArr = document.cookie.split(";");
  
      for (let i = 0; i < cookieArr.length; i++) {
          let cookiePair = cookieArr[i].split("=");
  
          /* Eliminar el espacio al inicio del nombre de la cookie y compararlo con el nombre dado */
          if (name == cookiePair[0].trim()) {
              /* Decodificar el valor de la cookie y devolverlo */
              return decodeURIComponent(cookiePair[1]);
          }
      }
  
      /* Retorna null si no encuentra la cookie */
      return null;
  }
}