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
          "main-bg": '#f3f3f3',
          neutral: '#4A4A4A',
          "neutral-black": '#141414',
          neutral3: '#A5A5A5',
        },
        display: ["group-hover"],
      },
    },
    plugins: [
      require('@tailwindcss/line-clamp'),
    ],
  }