module.exports = {
    extends: ["stylelint-config-standard"],
    ignoreFiles: [
        "vendor/**",
        "node_modules/**",
    ],
    rules: {
        "no-descending-specificity": null,

        "declaration-empty-line-before": null,
        "rule-empty-line-before": null,
        "comment-empty-line-before": null,

        "font-family-name-quotes": null,

        "media-feature-range-notation": null,

        "color-function-alias-notation": null,
        "color-function-notation": null,
        "alpha-value-notation": null,

        "property-no-vendor-prefix": null,

        "shorthand-property-no-redundant-values": null,
        "declaration-block-no-redundant-longhand-properties": null,

        "color-hex-length": null,
        "value-keyword-case": null,

        "selector-class-pattern": null,
    },
};