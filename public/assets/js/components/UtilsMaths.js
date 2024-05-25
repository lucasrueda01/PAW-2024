class UtilsMaths {

  static formatCurrency(number) {
      return number.toLocaleString('es-AR', {
        style: 'currency',
        currency: 'ARS',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    }
}