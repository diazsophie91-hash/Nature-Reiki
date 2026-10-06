const { test, expect } = require("@playwright/test");

const widths = [320, 375, 430, 768, 1024];
const mobileBreakpoint = 800;

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
    "/reserver/",
    "/prendre-rendez-vous-reiki/",
    "/page-qui-n-existe-pas-pour-les-tests/",
];

/**
 * Mesure le débordement horizontal de la page.
 *
 * @param {import("@playwright/test").Page} page Page Playwright.
 * @return {Promise<{scrollWidth: number, clientWidth: number}>} Largeurs mesurées.
 */
async function measureOverflow(page) {
    return page.evaluate(() => ({
        scrollWidth: Math.max(
            document.documentElement.scrollWidth,
            document.body.scrollWidth
        ),
        clientWidth: document.documentElement.clientWidth,
    }));
}

for (const width of widths) {
    test.describe(`Responsive — ${width}px`, () => {
        test.use({ viewport: { width, height: 800 } });

        for (const url of pages) {
            test(`aucun débordement horizontal sur ${url}`, async ({
                page,
            }) => {
                await page.goto(url, { waitUntil: "networkidle" });

                // Ouvre tous les accordéons pour mesurer leur contenu.
                await page.evaluate(() => {
                    document.querySelectorAll("details").forEach((item) => {
                        item.open = true;
                    });
                });

                const { scrollWidth, clientWidth } = await measureOverflow(page);

                expect(
                    scrollWidth,
                    `Débordement horizontal sur ${url} à ${width}px`
                ).toBeLessThanOrEqual(clientWidth);
            });
        }

        test("le menu hamburger n'apparaît qu'en dessous du point de rupture", async ({
            page,
        }) => {
            await page.goto("/accueil-guide-nature/", {
                waitUntil: "networkidle",
            });

            const toggle = page.locator(".menu-toggle");
            const panel = page.locator("#header-menu");

            if (width <= mobileBreakpoint) {
                await expect(toggle).toBeVisible();
                await expect(toggle).toHaveAttribute("aria-expanded", "false");
                await expect(panel).toBeHidden();
            } else {
                await expect(toggle).toBeHidden();
                await expect(panel).toBeVisible();
                await expect(page.locator(".nature-menu")).toBeVisible();
            }
        });

        test("l'en-tête ne chevauche pas le titre de la page", async ({
            page,
        }) => {
            await page.goto("/accueil-guide-nature/", {
                waitUntil: "networkidle",
            });

            const headerBottom = await page
                .locator(".accueil-header")
                .evaluate((element) => element.getBoundingClientRect().bottom);
            const titleTop = await page
                .locator("h1")
                .first()
                .evaluate((element) => element.getBoundingClientRect().top);

            expect(titleTop).toBeGreaterThanOrEqual(headerBottom - 1);
        });

        test("l'accueil affiche les deux univers sans chevauchement", async ({
            page,
        }) => {
            await page.goto("/", { waitUntil: "networkidle" });

            await expect(
                page.getByRole("link", { name: /Explorer la nature/i })
            ).toBeVisible();
            await expect(
                page.getByRole("link", { name: /Découvrir le Reiki/i })
            ).toBeVisible();

            const boxes = await page
                .locator(".univers-box")
                .evaluateAll((elements) =>
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
            const separated =
                first.right <= second.left + 1 ||
                second.right <= first.left + 1 ||
                first.bottom <= second.top + 1 ||
                second.bottom <= first.top + 1;

            expect(separated, "Les deux blocs se chevauchent").toBe(true);
        });

        test("les boutons principaux sont visibles et sans chevauchement", async ({
            page,
        }) => {
            await page.goto("/accueil-guide-nature/", {
                waitUntil: "networkidle",
            });

            const buttons = page.locator(".nature-banniere-bouton");
            const count = await buttons.count();

            expect(count).toBeGreaterThan(0);

            for (let index = 0; index < count; index++) {
                const button = buttons.nth(index);

                await button.scrollIntoViewIfNeeded();
                await expect(button).toBeVisible();

                const box = await button.boundingBox();

                expect(box).not.toBeNull();
                expect(box.x).toBeGreaterThanOrEqual(0);
                expect(box.x + box.width).toBeLessThanOrEqual(width);
            }

            // Le bouton ne doit pas recouvrir le texte de sa bannière.
            const overlaps = await page
                .locator(".nature-banniere")
                .evaluateAll((banners) =>
                    banners.map((banner) => {
                        const button = banner
                            .querySelector(".nature-banniere-bouton")
                            .getBoundingClientRect();
                        const text = banner
                            .querySelector(".nature-banniere-contenu p")
                            .getBoundingClientRect();

                        return !(
                            button.right <= text.left ||
                            button.left >= text.right ||
                            button.bottom <= text.top ||
                            button.top >= text.bottom
                        );
                    })
                );

            expect(overlaps.every((overlap) => !overlap)).toBe(true);
        });

        test("l'accordéon Soins Reiki reste utilisable", async ({ page }) => {
            await page.goto("/soins-reiki/", { waitUntil: "networkidle" });

            const accordion = page
                .locator("details.soins-reiki-accordeon")
                .first();
            const summary = accordion.locator("summary");

            await summary.scrollIntoViewIfNeeded();
            await expect(summary).toBeVisible();
            await summary.click();
            await expect(accordion).toHaveAttribute("open", "");

            const { scrollWidth, clientWidth } = await measureOverflow(page);

            expect(scrollWidth).toBeLessThanOrEqual(clientWidth);
        });

        test("le carrousel Nature reste utilisable", async ({ page }) => {
            await page.goto("/balades/", { waitUntil: "networkidle" });

            const carrousel = page
                .locator("[data-nature-carrousel]")
                .first();
            const next = carrousel.locator("[data-nature-carrousel-suivant]");
            const slides = carrousel.locator(
                "[data-nature-carrousel-diapositive]"
            );

            await carrousel.scrollIntoViewIfNeeded();
            await expect(carrousel).toBeVisible();
            await expect(next).toBeVisible();

            const box = await next.boundingBox();

            expect(box).not.toBeNull();
            expect(box.x).toBeGreaterThanOrEqual(0);
            expect(box.x + box.width).toBeLessThanOrEqual(width);

            await next.click();

            await expect(slides.nth(0)).toHaveAttribute("aria-hidden", "true");
            await expect(slides.nth(1)).not.toHaveAttribute(
                "aria-hidden",
                "true"
            );
        });

        test("la carte de visite s'agrandit et se ferme", async ({ page }) => {
            await page.goto("/me-contacter/?univers=nature", {
                waitUntil: "networkidle",
            });

            const link = page.locator("[data-carte-visite-lightbox]").first();

            test.skip(
                (await link.count()) === 0,
                "Pas de carte de visite sur cette page."
            );

            const dialog = page.locator("[data-carte-visite-dialog]");

            await link.scrollIntoViewIfNeeded();
            await link.click();
            await expect(dialog).toBeVisible();

            const box = await page
                .locator(".carte-visite-lightbox-image")
                .boundingBox();

            expect(box).not.toBeNull();
            expect(box.x).toBeGreaterThanOrEqual(0);
            expect(box.x + box.width).toBeLessThanOrEqual(width);

            await page.locator("[data-carte-visite-close]").click();
            await expect(dialog).toBeHidden();
        });


        if (width <= mobileBreakpoint) {
            test("le menu hamburger s'ouvre, se ferme et gère le clavier", async ({
                page,
            }) => {
                await page.goto("/accueil-guide-nature/", {
                    waitUntil: "networkidle",
                });

                const toggle = page.locator(".menu-toggle");
                const panel = page.locator("#header-menu");

                // Ouverture / fermeture au clic.
                await toggle.click();
                await expect(toggle).toHaveAttribute("aria-expanded", "true");
                await expect(panel).toBeVisible();
                await expect(
                    panel.getByRole("link", { name: "Balades" })
                ).toBeVisible();

                const panelBox = await panel.boundingBox();

                expect(panelBox).not.toBeNull();
                expect(panelBox.x).toBeGreaterThanOrEqual(0);
                expect(panelBox.x + panelBox.width).toBeLessThanOrEqual(width);

                await toggle.click();
                await expect(toggle).toHaveAttribute("aria-expanded", "false");
                await expect(panel).toBeHidden();

                // Fermeture avec Échap, focus rendu au bouton.
                await toggle.click();
                await expect(panel).toBeVisible();
                await page.keyboard.press("Escape");
                await expect(toggle).toHaveAttribute("aria-expanded", "false");
                await expect(panel).toBeHidden();
                await expect(toggle).toBeFocused();

                // Fermeture au clic à l'extérieur.
                await toggle.click();
                await expect(panel).toBeVisible();
                await page.locator("main").click({
                    position: { x: 2, y: 2 },
                    force: true,
                });
                await expect(panel).toBeHidden();
            });

            test("le menu hamburger permet de naviguer", async ({ page }) => {
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

            test("le menu Reiki est accessible dans le hamburger", async ({
                page,
            }) => {
                await page.goto("/accueil-reiki/", {
                    waitUntil: "networkidle",
                });

                await page.locator(".menu-toggle").click();

                await expect(
                    page.locator("#header-menu .menu-mobile-nav")
                ).toBeVisible();
                await expect(
                    page.locator("#header-menu .menu-mobile-nav a").first()
                ).toBeVisible();
            });
        }
    });
}

test.describe("Responsive — référence desktop 1440px", () => {
    test.use({ viewport: { width: 1440, height: 900 } });

    test("l'en-tête desktop est inchangé : pas de hamburger", async ({
        page,
    }) => {
        await page.goto("/accueil-guide-nature/", {
            waitUntil: "networkidle",
        });

        await expect(page.locator(".menu-toggle")).toBeHidden();
        await expect(page.locator("#header-menu")).toBeVisible();
        await expect(page.locator(".nature-menu")).toBeVisible();
        await expect(page.locator(".menu-mobile-nav")).toBeHidden();

        const { scrollWidth, clientWidth } = await measureOverflow(page);

        expect(scrollWidth).toBeLessThanOrEqual(clientWidth);
    });

    test("l'accueil garde deux univers côte à côte", async ({ page }) => {
        await page.goto("/", { waitUntil: "networkidle" });

        const boxes = await page
            .locator(".univers-box")
            .evaluateAll((elements) =>
                elements.map((element) => element.getBoundingClientRect())
            );

        expect(boxes).toHaveLength(2);
        expect(Math.abs(boxes[0].top - boxes[1].top)).toBeLessThan(2);
        expect(boxes[0].right).toBeLessThanOrEqual(boxes[1].left);
    });
});

