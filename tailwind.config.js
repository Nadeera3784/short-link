// tailwind.config.js
import typography from '@tailwindcss/typography';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    './resources/js/**/*.vue',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    typography,
    forms,
  ],
}