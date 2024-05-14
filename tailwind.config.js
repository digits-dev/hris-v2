/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
      colors:{
        primary: '#1F6268',
        secondary: '#DDFAFD',
        'stroke-color': '#599297',
        'primary-text': '#113437'
      }
    },
  },
  plugins: [],
}

