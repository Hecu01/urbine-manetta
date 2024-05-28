/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        light: '#ffffff', // color para el modo claro
        dark: '#333333',  // color para el modo oscuro
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

