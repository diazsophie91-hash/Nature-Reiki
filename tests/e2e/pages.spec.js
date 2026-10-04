const { test, expect } = require("@playwright/test");

const pages = [
    {
        name: "Accueil",
        url: "/",
        title: "VOTRE UNIVERS",
    },
    {
        name: "Accueil Guide-Nature",
        url: "/accueil-guide-nature/",
        title: "Guide-Nature",
    },
    {
        name: "Accueil Reiki",
        url: "/accueil-reiki/",
        title: "Reiki",
    },
    {
        name: "Qui suis-je — Nature",
        url: "/qui-suis-je/?univers=nature",
        title: "Joëlle Siwek",
    },
    {
        name: "Qui suis-je — Reiki",
        url: "/qui-suis-je/?univers=reiki",
        title: "Joëlle Siwek",
    },
    {
        name: "Balades",
        url: "/balades/",
        title: "Balades",
    },
    {
        name: "Animations",
        url: "/animations/",
        title: "Animations",
    },
    {
        name: "Réserver",
        url: "/reserver/",
        title: "Réserver",
    },
    {
        name: "À venir",
        url: "/a-venir/",
        title: "À venir",
    },
    {
        name: "FAQ — Nature",
        url: "/faq/?univers=nature",
        title: "F.A.Q",
    },
    {
        name: "FAQ — Reiki",
        url: "/faq/?univers=reiki",
        title: "F.A.Q",
    },
    {
        name: "Me contacter — Nature",
        url: "/me-contacter/?univers=nature",
        title: "Me contacter",
    },
    {
        name: "Me contacter — Reiki",
        url: "/me-contacter/?univers=reiki",
        title: "Me contacter",
    },
    {
        name: "Le Reiki",
        url: "/le-reiki/",
        title: "Le Reiki",
    },
    {
        name: "Soins Reiki",
        url: "/soins-reiki/",
        title: "Soins Reiki",
    },
    {
        name: "Prendre rendez-vous",
        url: "/prendre-rendez-vous-reiki/",
        title: "Prendre rendez-vous",
    },
];

test.describe("Nature & Reiki — vérification des pages", () => {
    for (const currentPage of pages) {
        test(`la page « ${currentPage.name} » fonctionne`, async ({ page }) => {
            const consoleErrors = [];
            const pageErrors = [];
            const failedDocumentResponses = [];

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
                    failedDocumentResponses.push(
                        `${response.status()} ${response.url()}`
                    );
                }
            });

            const response = await page.goto(currentPage.url, {
                waitUntil: "networkidle",
            });

            expect(response).not.toBeNull();
            expect(
                response.status(),
                `Réponse HTTP invalide pour ${currentPage.url}`
            ).toBeLessThan(400);

            await expect(page.locator("main")).toBeVisible();

            await expect(
                page.locator("h1").first(),
                `Le h1 attendu est absent sur ${currentPage.url}`
            ).toHaveText(currentPage.title);

            expect(
                pageErrors,
                `Erreur JavaScript détectée sur ${currentPage.url}`
            ).toEqual([]);

            expect(
                consoleErrors,
                `Erreur console détectée sur ${currentPage.url}`
            ).toEqual([]);

            expect(
                failedDocumentResponses,
                `Réponse document en erreur sur ${currentPage.url}`
            ).toEqual([]);
        });
    }
});