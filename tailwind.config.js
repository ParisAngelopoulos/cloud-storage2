/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./files/*.php'],
  theme: {
    extend: {
      colors: {
        brand: { DEFAULT: '#0f7c9c', dark: '#0b6580' },
      },
    },
  },
  plugins: [],
};
