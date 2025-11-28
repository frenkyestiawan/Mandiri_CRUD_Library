export default {
  plugins: ["@prettier/plugin-php", "prettier-plugin-blade"],
  overrides: [
    {
      files: "*.blade.php",
      options: {
        parser: "blade",
        tabWidth: 4,
      },
    },
  ],
  tabWidth: 2,
  semi: true,
  singleQuote: false,
  printWidth: 100,
  trailingComma: "es5",
  bracketSpacing: true,
  arrowParens: "always",
};