module.exports = {
    extends: ["stylelint-config-recommended"],
    ignoreFiles: [
        "vendor/**",
        "node_modules/**"
    ],
    rules: {
        "no-descending-specificity": null
    }
};
