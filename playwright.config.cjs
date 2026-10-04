const { defineConfig } = require("@playwright/test");

module.exports = defineConfig({
    testDir: "./tests/e2e",
    timeout: 30000,
    fullyParallel: false,
    workers: process.env.CI ? 1 : undefined,

    reporter: [
        ["list"],
        ["html", { open: "never" }],
    ],

    use: {
        baseURL:
            process.env.PLAYWRIGHT_TEST_BASE_URL ||
            "https://nature-reiki.be",

        browserName: "chromium",

        screenshot: "only-on-failure",
        trace: "retain-on-failure",
        video: "retain-on-failure",
    },
});