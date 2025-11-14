// tailwind.config.cjs

/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",   // <-- IMPORTANT: enables dark mode using the .dark class

  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],

  theme: {
    extend: {},
  },

  plugins: [
    // require('@tailwindcss/forms'),
    // require('@tailwindcss/typography'),
  ],
};
