const { test, expect } = require("@playwright/test");

test.describe("Nature & Reiki — fonctionnement du site", () => {
    test("la page d'accueil fonctionne", async ({ page }) => {
        const consoleErrors = [];
        const pageErrors = [];
        const failedResponses = [];

        page.on("console", (message) => {
            if (message.type() === "error") {
                consoleErrors.push(message.text());
            }
        });

        page.on("pageerror", (error) => {
            pageErrors.push(error.message);
        });

        page.on("response", (response) => {
            const request = response.request();

            if (
                request.resourceType() === "document" &&
                response.status() >= 400
            ) {
                failedResponses.push(
                    `${response.status()} ${response.url()}`
                );
            }
        });

        const response = await page.goto("/", {
            waitUntil: "networkidle",
        });

        expect(response).not.toBeNull();
        expect(response.status()).toBeLessThan(400);

        await expect(page.locator("h1")).toHaveText("VOTRE UNIVERS");

        await expect(
            page.getByRole("link", { name: /Explorer la nature/i })
        ).toBeVisible();

        await expect(
            page.getByRole("link", { name: /Découvrir le Reiki/i })
        ).toBeVisible();

        expect(pageErrors).toEqual([]);
        expect(consoleErrors).toEqual([]);
        expect(failedResponses).toEqual([]);
    });

    test("les deux univers sont accessibles depuis l'accueil", async ({
        page,
    }) => {
        await page.goto("/");

        await page
            .getByRole("link", { name: /Explorer la nature/i })
            .click();

        await expect(page).toHaveURL(/\/accueil-guide-nature\/?$/);
        await expect(page.locator("h1")).toHaveText("Guide-Nature");

        await page.goto("/");

        await page
            .getByRole("link", { name: /Découvrir le Reiki/i })
            .click();

        await expect(page).toHaveURL(/\/accueil-reiki\/?$/);
        await expect(page.locator("h1")).toHaveText("Reiki");
    });

    test("les deux contextes de la FAQ affichent le bon univers", async ({
        page,
    }) => {
        await page.goto("/faq/?univers=nature");

        await expect(
            page.locator(".faq-univers").first().locator("h2")
        ).toHaveText("Guide-Nature");

        await page.goto("/faq/?univers=reiki");

        await expect(
            page.locator(".faq-univers").first().locator("h2")
        ).toHaveText("Reiki");
    });

    test("les accordéons fonctionnent", async ({ page }) => {
        await page.goto("/soins-reiki/");

        const accordion = page.locator(
            "details.soins-reiki-accordeon"
        ).first();

        const summary = accordion.locator("summary");

        await expect(accordion).not.toHaveAttribute("open", "");

        await summary.click();

        await expect(accordion).toHaveAttribute("open", "");
    });

    test("le carrousel Nature fonctionne", async ({ page }) => {
        await page.goto("/balades/");

        const carrousel = page.locator(
            "[data-nature-carrousel]"
        ).first();

        await expect(carrousel).toBeVisible();

        const diapositives = carrousel.locator(
            "[data-nature-carrousel-diapositive]"
        );

        const boutonSuivant = carrousel.locator(
            "[data-nature-carrousel-suivant]"
        );

        expect(await diapositives.count()).toBeGreaterThan(1);

        await boutonSuivant.click();

        await expect(diapositives.nth(0)).toHaveAttribute(
            "aria-hidden",
            "true"
        );

        await expect(
            diapositives.nth(1)
        ).not.toHaveAttribute("aria-hidden", "true");
    });

    test("les liens de navigation Nature répondent", async ({ page, request }) => {
        await page.goto("/accueil-guide-nature/");

        const links = await page
            .locator(".nature-menu a")
            .evaluateAll((anchors) =>
                anchors.map((anchor) => anchor.href)
            );

        for (const url of links) {
            const response = await request.get(url);

            expect(
                response.status(),
                `Lien invalide : ${url}`
            ).toBeLessThan(400);
        }
    });

    test("les liens de navigation Reiki répondent", async ({ page, request }) => {
        await page.goto("/accueil-reiki/");

        const links = await page
            .locator(".reiki-menu a")
            .evaluateAll((anchors) =>
                anchors.map((anchor) => anchor.href)
            );

        for (const url of links) {
            const response = await request.get(url);

            expect(
                response.status(),
                `Lien invalide : ${url}`
            ).toBeLessThan(400);
        }
    });

    test("la page 404 fonctionne", async ({ page }) => {
        const response = await page.goto(
            "/page-qui-n-existe-pas-pour-les-tests/",
            {
                waitUntil: "networkidle",
            }
        );

        expect(response).not.toBeNull();
        expect(response.status()).toBe(404);

        await expect(page.locator("h1")).toHaveText(
            "Page introuvable"
        );
    });
});