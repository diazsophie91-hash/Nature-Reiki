const { test, expect } = require("@playwright/test");

/*
 * Compatibilité Safari : exécute les contrôles responsive essentiels avec
 * le moteur WebKit de Playwright. Détecte les incompatibilités évidentes,
 * sans prétendre reproduire un vrai Mac ou un vrai iPhone.
 */

test.use({ browserName: "webkit" });

const mobileBreakpoint = 800;

const viewports = [
    { width: 375, height: 667 },
    { width: 430, height: 932 },
    { width: 768, height: 1024 },
    { width: 1024, height: 768 },
    { width: 1440, height: 900 },
];

const pages = [
    "/",
    "/accueil-reiki/",
    "/accueil-guide-nature/",
    "/le-reiki/",
    "/soins-reiki/",
    "/qui-suis-je/?univers=reiki",
    "/qui-suis-je/?univers=nature",
    "/me-contacter/?univers=reiki",
    "/me-contacter/?univers=nature",
    "/faq/?univers=reiki",
    "/faq/?univers=nature",
    "/balades/",
    "/animations/",
    "/a-venir/",
];

/**
 * Vérifie l'absence de débordement horizontal (html et body).
 *
 * @param {import("@playwright/test").Page} page Page Playwright.
 * @param {string} label Contexte affiché en cas d'échec.
 * @return {Promise<void>}
 */
async function expectNoHorizontalOverflow(page, label) {
    const overflow = await page.evaluate(() => ({
        html: document.documentElement.scrollWidth,
        body: document.body.scrollWidth,
        client: document.documentElement.clientWidth,
    }));

    expect(
        overflow.html,
        `documentElement.scrollWidth ${label}`
    ).toBeLessThanOrEqual(overflow.client);
    expect(overflow.body, `body.scrollWidth ${label}`).toBeLessThanOrEqual(
        overflow.client
    );
}

/**
 * Vérifie que le contenu principal et l'en-tête sont rendus et que le bas
 * de l'en-tête ne chevauche pas le premier titre.
 *
 * @param {import("@playwright/test").Page} page Page Playwright.
 * @param {string} label Contexte affiché en cas d'échec.
 * @return {Promise<void>}
 */
async function expectHeaderAndContentSound(page, label) {
    await expect(page.locator("main").first()).toBeVisible();
    await expect(page.locator("h1").first()).toBeVisible();

    const measures = await page.evaluate(() => {
        const header = document.querySelector(".accueil-header");
        const title = document.querySelector("main h1, h1");

        if (!header || !title || header.contains(title)) {
            return null;
        }

        const rect = header.getBoundingClientRect();

        return {
            headerWidth: rect.width,
            headerHeight: rect.height,
            headerBottom: rect.bottom,
            titleTop: title.getBoundingClientRect().top,
            clientWidth: document.documentElement.clientWidth,
        };
    });

    if (measures) {
        expect(measures.headerHeight, `Hauteur en-tête ${label}`).toBeGreaterThan(
            0
        );
        expect(
            measures.headerWidth,
            `Largeur en-tête ${label}`
        ).toBeLessThanOrEqual(measures.clientWidth + 1);
        expect(
            measures.titleTop,
            `Chevauchement en-tête / titre ${label}`
        ).toBeGreaterThanOrEqual(measures.headerBottom - 1);
    }
}

for (const { width, height } of viewports) {
    test.describe(`WebKit — ${width}×${height}`, () => {
        test.use({ viewport: { width, height } });

        for (const url of pages) {
            test(`chargement, menu et débordement sur ${url}`, async ({
                page,
            }) => {
                await page.goto(url, { waitUntil: "networkidle" });

                const label = `sur ${url} à ${width}×${height} (WebKit)`;
                const hasMenu = (await page.locator("#header-menu").count()) > 0;
                const toggle = page.locator(".menu-toggle");

                await expectHeaderAndContentSound(page, label);

                // Menu desktop ou hamburger selon la largeur.
                if (hasMenu) {
                    if (width <= mobileBreakpoint) {
                        await expect(toggle).toBeVisible();
                        await expect(page.locator("#header-menu")).toBeHidden();
                    } else {
                        await expect(toggle).toBeHidden();
                        await expect(page.locator("#header-menu")).toBeVisible();
                    }
                }

                await expectNoHorizontalOverflow(page, label);

                // Accordéons ouverts : toujours aucun débordement.
                await page.evaluate(() => {
                    document.querySelectorAll("details").forEach((item) => {
                        item.open = true;
                    });
                });
                await expectNoHorizontalOverflow(
                    page,
                    `avec <details> ouverts ${label}`
                );
            });
        }
    });
}

const phoneAndTabletViewports = viewports.filter(
    ({ width }) => width <= mobileBreakpoint
);

for (const { width, height } of phoneAndTabletViewports) {
    test.describe(`WebKit hamburger — ${width}×${height}`, () => {
        test.use({ viewport: { width, height } });

        test("le hamburger s'ouvre, reste dans l'écran et Échap le ferme", async ({
            page,
        }) => {
            await page.goto("/accueil-guide-nature/", {
                waitUntil: "networkidle",
            });

            const toggle = page.locator(".menu-toggle");
            const panel = page.locator("#header-menu");

            await expect(toggle).toBeVisible();
            await expect(panel).toBeHidden();

            // Ouverture et fermeture au clic.
            await toggle.click();
            await expect(toggle).toHaveAttribute("aria-expanded", "true");
            await expect(panel).toBeVisible();
            await expect(
                panel.getByRole("link", { name: "Balades" })
            ).toBeVisible();

            const box = await panel.boundingBox();

            expect(box).not.toBeNull();
            expect(box.x).toBeGreaterThanOrEqual(0);
            expect(box.x + box.width).toBeLessThanOrEqual(width);

            await toggle.click();
            await expect(toggle).toHaveAttribute("aria-expanded", "false");
            await expect(panel).toBeHidden();

            // Fermeture avec Échap : le focus revient au bouton.
            await toggle.click();
            await expect(panel).toBeVisible();
            await page.keyboard.press("Escape");
            await expect(toggle).toHaveAttribute("aria-expanded", "false");
            await expect(panel).toBeHidden();
            await expect(toggle).toBeFocused();
        });

        test("le menu hamburger permet de naviguer vers Balades", async ({
            page,
        }) => {
            await page.goto("/accueil-guide-nature/", {
                waitUntil: "networkidle",
            });

            await page.locator(".menu-toggle").click();
            await page
                .locator("#header-menu")
                .getByRole("link", { name: "Balades" })
                .click();

            await expect(page).toHaveURL(/\/balades\/?$/);
            await expect(page.locator("h1")).toHaveText("Balades");
        });
    });
}


for (const { width, height } of viewports) {
    test.describe(`WebKit interactions — ${width}×${height}`, () => {
        test.use({ viewport: { width, height } });

        for (const univers of ["nature", "reiki"]) {
            test(`la carte de visite ${univers} s'agrandit et se ferme`, async ({
                page,
            }) => {
                await page.goto(`/me-contacter/?univers=${univers}`, {
                    waitUntil: "networkidle",
                });

                const link = page
                    .locator("[data-carte-visite-lightbox]")
                    .first();
                const dialog = page.locator("[data-carte-visite-dialog]");
                const image = page.locator(".carte-visite-lightbox-image");

                await expect(link).toHaveCount(1);
                await link.scrollIntoViewIfNeeded();
                await link.click();
                await expect(dialog).toBeVisible();
                await expect(image).toBeVisible();

                const box = await image.boundingBox();

                expect(box).not.toBeNull();
                expect(box.x).toBeGreaterThanOrEqual(0);
                expect(box.x + box.width).toBeLessThanOrEqual(width);

                await page.locator("[data-carte-visite-close]").click();
                await expect(dialog).toBeHidden();
            });
        }

        test("le carrousel Nature reste utilisable", async ({ page }) => {
            await page.goto("/balades/", { waitUntil: "networkidle" });

            const carrousel = page.locator("[data-nature-carrousel]").first();
            const next = carrousel.locator("[data-nature-carrousel-suivant]");
            const slides = carrousel.locator(
                "[data-nature-carrousel-diapositive]"
            );

            await carrousel.scrollIntoViewIfNeeded();
            await expect(carrousel).toBeVisible();
            await expect(next).toBeVisible();

            await next.click();
            await expect(slides.nth(0)).toHaveAttribute("aria-hidden", "true");
            await expect(slides.nth(1)).not.toHaveAttribute(
                "aria-hidden",
                "true"
            );

            await expectNoHorizontalOverflow(
                page,
                `après le carrousel à ${width}×${height} (WebKit)`
            );
        });

        test("l'accordéon Soins Reiki s'ouvre", async ({ page }) => {
            await page.goto("/soins-reiki/", { waitUntil: "networkidle" });

            const accordion = page
                .locator("details.soins-reiki-accordeon")
                .first();
            const summary = accordion.locator("summary");

            await summary.scrollIntoViewIfNeeded();
            await expect(summary).toBeVisible();
            await summary.click();
            await expect(accordion).toHaveAttribute("open", "");

            await expectNoHorizontalOverflow(
                page,
                `avec l'accordéon ouvert à ${width}×${height} (WebKit)`
            );
        });

        test("l'accueil dispose bien les deux univers", async ({ page }) => {
            await page.goto("/", { waitUntil: "networkidle" });

            const boxes = await page.locator(".univers-box").evaluateAll(
                (elements) =>
                    elements.map((element) => {
                        const rect = element.getBoundingClientRect();

                        return {
                            left: rect.left,
                            right: rect.right,
                            top: rect.top,
                            bottom: rect.bottom,
                        };
                    })
            );

            expect(boxes).toHaveLength(2);

            const [first, second] = boxes;

            if (width > mobileBreakpoint) {
                // Desktop : côte à côte.
                expect(Math.abs(first.top - second.top)).toBeLessThan(2);
                expect(first.right).toBeLessThanOrEqual(second.left + 1);
            } else {
                // Mobile / tablette : empilés sans chevauchement.
                expect(first.bottom).toBeLessThanOrEqual(second.top + 1);
            }
        });
    });
}

