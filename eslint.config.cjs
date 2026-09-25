const globals = require("globals");

module.exports = [
    {
        ignores: [
            "vendor/**",
            "node_modules/**",
        ],
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
        rules: {
            "no-unused-vars": "warn",
            "no-undef": "error",
            "no-redeclare": "error",
            "no-unreachable": "error",
            "no-constant-condition": "error",
            "eqeqeq": ["error", "always"],
            "curly": ["error", "all"],
            "semi": ["error", "always"],
        },
    },
];