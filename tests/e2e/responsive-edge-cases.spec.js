const { test, expect } = require("@playwright/test");

/*
 * Cas limites responsive : frontières exactes des media queries, tailles
 * d'écran réalistes (dont téléphones en paysage) et scénarios ciblés.
 * Complète responsive.spec.js sans le dupliquer.
 */

const boundaryWidths = [
    599, 600, 601, 799, 800, 801, 859, 860, 861, 1023, 1024, 1025,
];
const mobileBreakpoint = 800;

const allPages = [
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

// Ces pages restent couvertes par les tests de frontières ci-dessus.
const coveredByBoundaryTests = [
    "/reserver/",
    "/prendre-rendez-vous-reiki/",
    "/page-qui-n-existe-pas-pour-les-tests/",
];
const realisticPages = allPages.filter(
    (url) => !coveredByBoundaryTests.includes(url)
);

const realisticViewports = [
    { width: 320, height: 568 },
    { width: 375, height: 667 },
    { width: 430, height: 932 },
    { width: 667, height: 375 },
    { width: 812, height: 375 },
    { width: 844, height: 390 },
    { width: 1024, height: 768 },
];

/**
 * Charge une page et ouvre tous les <details> pour mesurer leur contenu.
 *
 * @param {import("@playwright/test").Page} page Page Playwright.
 * @param {string} url URL à ouvrir.
 * @return {Promise<void>}
 */
async function openPageWithDetails(page, url) {
    await page.goto(url, { waitUntil: "networkidle" });

    await page.evaluate(() => {
        document.querySelectorAll("details").forEach((item) => {
            item.open = true;
        });
    });
}

/**
 * Mesure le débordement horizontal de la page.
 *
 * @param {import("@playwright/test").Page} page Page Playwright.
 * @return {Promise<{htmlScrollWidth: number, bodyScrollWidth: number, clientWidth: number}>} Largeurs mesurées.
 */
async function measureOverflow(page) {
    return page.evaluate(() => ({
        htmlScrollWidth: document.documentElement.scrollWidth,
        bodyScrollWidth: document.body.scrollWidth,
        clientWidth: document.documentElement.clientWidth,
    }));
}

/**
 * Vérifie l'absence de débordement horizontal (html et body).
 *
 * @param {import("@playwright/test").Page} page Page Playwright.
 * @param {string} label Contexte affiché en cas d'échec.
 * @return {Promise<void>}
 */
async function expectNoHorizontalOverflow(page, label) {
    const { htmlScrollWidth, bodyScrollWidth, clientWidth } =
        await measureOverflow(page);

    expect(
        htmlScrollWidth,
        `documentElement.scrollWidth ${label}`
    ).toBeLessThanOrEqual(clientWidth);
    expect(bodyScrollWidth, `body.scrollWidth ${label}`).toBeLessThanOrEqual(
        clientWidth
    );
}

/**
 * Liste les éléments visibles de l'en-tête et du contenu principal qui
 * dépassent horizontalement du viewport. Les éléments situés dans un
 * conteneur qui masque son débordement (carrousel, etc.) sont ignorés.
 *
 * @param {import("@playwright/test").Page} page Page Playwright.
 * @return {Promise<string[]>} Description des éléments fautifs.
 */
async function findElementsOutsideViewport(page) {
    return page.evaluate(() => {
        const viewportWidth = document.documentElement.clientWidth;
        const isClipped = (element) => {
            let parent = element.parentElement;

            while (parent && parent !== document.body) {
                if (getComputedStyle(parent).overflowX !== "visible") {
                    return true;
                }

                parent = parent.parentElement;
            }

            return false;
        };
        const offenders = [];

        document.querySelectorAll("header *, main *").forEach((element) => {
            const style = getComputedStyle(element);
            const rect = element.getBoundingClientRect();

            if (
                style.display === "none" ||
                style.visibility === "hidden" ||
                rect.width === 0 ||
                rect.height === 0
            ) {
                return;
            }

            if (
                (rect.right > viewportWidth + 1 || rect.left < -1) &&
                !isClipped(element)
            ) {
                offenders.push(
                    `${element.tagName.toLowerCase()}.${String(
                        element.className
                    )} [${Math.round(rect.left)} → ${Math.round(rect.right)}]`
                );
            }
        });

        return offenders.slice(0, 10);
    });
}

/**
 * Mesure la position du bas de l'en-tête et du haut du premier titre.
 * Renvoie null si la page n'a pas d'en-tête de site ou pas de titre.
 *
 * @param {import("@playwright/test").Page} page Page Playwright.
 * @return {Promise<{headerBottom: number, titleTop: number}|null>} Positions ou null.
 */
async function measureHeaderTitle(page) {
    return page.evaluate(() => {
        const header = document.querySelector(".accueil-header");
        const title = document.querySelector("main h1, h1");

        if (!header || !title || header.contains(title)) {
            return null;
        }

        return {
            headerBottom: header.getBoundingClientRect().bottom,
            titleTop: title.getBoundingClientRect().top,
        };
    });
}

for (const width of boundaryWidths) {
    test.describe(`Frontières media queries — ${width}px`, () => {
        test.use({ viewport: { width, height: 800 } });

        for (const url of allPages) {
            test(`aucun débordement horizontal sur ${url}`, async ({
                page,
            }) => {
                await openPageWithDetails(page, url);
                await expectNoHorizontalOverflow(
                    page,
                    `sur ${url} à ${width}px`
                );
            });
        }

        test("le hamburger bascule exactement à la frontière de 800px", async ({
            page,
        }) => {
            await page.goto("/accueil-guide-nature/", {
                waitUntil: "networkidle",
            });

            const toggle = page.locator(".menu-toggle");

            if (width <= mobileBreakpoint) {
                await expect(toggle).toBeVisible();
                await expect(page.locator(".nature-menu")).toBeHidden();
            } else {
                await expect(toggle).toBeHidden();
                await expect(page.locator(".nature-menu")).toBeVisible();
            }
        });
    });
}


for (const { width, height } of realisticViewports) {
    test.describe(`Tailles réalistes — ${width}×${height}`, () => {
        test.use({ viewport: { width, height } });

        for (const url of realisticPages) {
            test(`mise en page correcte sur ${url}`, async ({ page }) => {
                await openPageWithDetails(page, url);

                const label = `sur ${url} à ${width}×${height}`;

                await expectNoHorizontalOverflow(page, label);

                // Aucun élément principal ne dépasse du viewport.
                expect(
                    await findElementsOutsideViewport(page),
                    `Éléments hors viewport ${label}`
                ).toEqual([]);

                // L'en-tête ne chevauche pas le premier titre.
                const positions = await measureHeaderTitle(page);

                if (positions) {
                    expect(
                        positions.titleTop,
                        `Chevauchement en-tête / titre ${label}`
                    ).toBeGreaterThanOrEqual(positions.headerBottom - 1);
                }

                // Le panneau hamburger, s'il existe, reste dans l'écran.
                const toggle = page.locator(".menu-toggle");

                if (await toggle.isVisible()) {
                    await toggle.click();

                    const panel = page.locator("#header-menu");

                    await expect(panel).toBeVisible();

                    const box = await panel.boundingBox();

                    expect(box, `Panneau hamburger ${label}`).not.toBeNull();
                    expect(box.x).toBeGreaterThanOrEqual(0);
                    expect(box.x + box.width).toBeLessThanOrEqual(width);

                    await expectNoHorizontalOverflow(
                        page,
                        `avec le menu ouvert ${label}`
                    );
                }
            });
        }
    });
}

test.describe("Hamburger — téléphone en paysage 667×375", () => {
    test.use({ viewport: { width: 667, height: 375 } });

    test("le menu s'ouvre, reste dans l'écran et se ferme avec Échap", async ({
        page,
    }) => {
        await page.goto("/accueil-guide-nature/", {
            waitUntil: "networkidle",
        });

        const toggle = page.locator(".menu-toggle");
        const panel = page.locator("#header-menu");

        await expect(toggle).toBeVisible();
        await expect(panel).toBeHidden();

        await toggle.click();
        await expect(toggle).toHaveAttribute("aria-expanded", "true");
        await expect(panel).toBeVisible();

        const box = await panel.boundingBox();

        expect(box).not.toBeNull();
        expect(box.x).toBeGreaterThanOrEqual(0);
        expect(box.x + box.width).toBeLessThanOrEqual(667);

        await expect(
            panel.getByRole("link", { name: "Balades" })
        ).toBeVisible();

        await page.keyboard.press("Escape");
        await expect(toggle).toHaveAttribute("aria-expanded", "false");
        await expect(panel).toBeHidden();
        await expect(toggle).toBeFocused();
    });
});


const reikiBannerWidths = [320, 375, 430, 600, 601, 768, 800, 801, 1024];

for (const width of reikiBannerWidths) {
    test.describe(`Bannières Reiki — ${width}px`, () => {
        test.use({ viewport: { width, height: 800 } });

        test("les boutons sont visibles, dans l'écran et ne recouvrent pas leur texte", async ({
            page,
        }) => {
            await page.goto("/accueil-reiki/", { waitUntil: "networkidle" });

            for (const index of [1, 2, 3]) {
                const button = page.locator(`.reiki-banniere-${index}-bouton`);
                const text = page.locator(`.reiki-banniere-${index}-contenu p`);

                await button.scrollIntoViewIfNeeded();
                await expect(button).toBeVisible();
                await expect(text).toBeVisible();

                const buttonBox = await button.boundingBox();

                expect(buttonBox, `Bouton ${index}`).not.toBeNull();
                expect(buttonBox.x).toBeGreaterThanOrEqual(0);
                expect(buttonBox.x + buttonBox.width).toBeLessThanOrEqual(
                    width
                );

                // On compare le bouton aux lignes de texte réellement
                // rendues (et non à la boîte du paragraphe, qui peut
                // contenir de l'espace vide sous le bouton).
                const overlap = await text.evaluate((paragraph, rect) => {
                    const range = document.createRange();

                    range.selectNodeContents(paragraph);

                    return [...range.getClientRects()].some(
                        (line) =>
                            line.width > 0 &&
                            !(
                                rect.x + rect.width <= line.left ||
                                rect.x >= line.right ||
                                rect.y + rect.height <= line.top ||
                                rect.y >= line.bottom
                            )
                    );
                }, buttonBox);

                expect(
                    overlap,
                    `Le bouton ${index} recouvre le texte de son paragraphe à ${width}px`
                ).toBe(false);
            }
        });
    });
}

for (const width of [320, 375, 768]) {
    test.describe(`Carte de visite Reiki — ${width}px`, () => {
        test.use({ viewport: { width, height: 800 } });

        test("la carte Reiki s'agrandit dans l'écran et se ferme", async ({
            page,
        }) => {
            await page.goto("/me-contacter/?univers=reiki", {
                waitUntil: "networkidle",
            });

            const link = page.locator("[data-carte-visite-lightbox]").first();

            await expect(link).toHaveCount(1);

            const dialog = page.locator("[data-carte-visite-dialog]");
            const image = page.locator(".carte-visite-lightbox-image");

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
    });
}

test.describe("prefers-reduced-motion", () => {
    test.use({ viewport: { width: 375, height: 667 } });

    test("le carrousel Nature reste utilisable sans animation", async ({
        page,
    }) => {
        await page.emulateMedia({ reducedMotion: "reduce" });
        await page.goto("/balades/", { waitUntil: "networkidle" });

        const carrousel = page.locator("[data-nature-carrousel]").first();
        const next = carrousel.locator("[data-nature-carrousel-suivant]");
        const slides = carrousel.locator("[data-nature-carrousel-diapositive]");

        await carrousel.scrollIntoViewIfNeeded();
        await expect(carrousel).toBeVisible();
        await expect(next).toBeVisible();

        await next.click();
        await expect(slides.nth(0)).toHaveAttribute("aria-hidden", "true");
        await expect(slides.nth(1)).not.toHaveAttribute("aria-hidden", "true");

        await expectNoHorizontalOverflow(page, "avec reduced-motion");
    });

    test("le menu hamburger reste utilisable sans animation", async ({
        page,
    }) => {
        await page.emulateMedia({ reducedMotion: "reduce" });
        await page.goto("/accueil-guide-nature/", {
            waitUntil: "networkidle",
        });

        const toggle = page.locator(".menu-toggle");
        const panel = page.locator("#header-menu");

        await expect(toggle).toBeVisible();
        await toggle.click();
        await expect(panel).toBeVisible();
        await expect(panel.getByRole("link", { name: "Balades" })).toBeVisible();
        await expectNoHorizontalOverflow(page, "avec reduced-motion");

        await page.keyboard.press("Escape");
        await expect(panel).toBeHidden();
    });
});

