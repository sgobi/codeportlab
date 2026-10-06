/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.html",
    "./public/**/*.html",
    "./case-studies/**/*.html",
    "./public/case-studies/**/*.html",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
    "./public/js/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        mono: ['"Fira Code"', 'monospace'],
      },
    },
  },
  plugins: [],
};
