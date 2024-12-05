// Este script js es para admitir sólo números
function validarNumeros(input) {
    // Reemplazar todo lo que no sea un número por vacío
    input.value = input.value.replace(/[^0-9]/g, '');
}