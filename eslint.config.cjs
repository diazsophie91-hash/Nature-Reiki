const globals = require("globals");

module.exports = [
    {
        ignores: ["vendor/**", "node_modules/**"],
    },
    {
        files: ["**/*.js"],
        languageOptions: {
            ecmaVersion: "latest",
            sourceType: "script",
            globals: {
                ...globals.browser,
            },
        },
        rules: {},
    },
];
