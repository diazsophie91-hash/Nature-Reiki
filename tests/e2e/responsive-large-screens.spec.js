const { test, expect } = require("@playwright/test");

/*
 * Très grands écrans desktop : vérifications structurelles uniquement
 * (pas de comparaison visuelle au pixel près).
 */

const largeViewports = [
    { width: 1280, height: 720 },
    { width: 1366, height: 768 },
    { width: 1440, height: 900 },
    { width: 1600, height: 900 },
    { width: 1920, height: 1080 },
    { width: 2560, height: 1440 },
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
 * Liste les éléments visibles de l'en-tête et du contenu principal qui
 * dépassent horizontalement du viewport (hors conteneurs qui masquent
 * leur débordement, comme le carrousel).
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
 * Mesure le bas de l'en-tête et le haut du premier titre.
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

for (const { width, height } of largeViewports) {
    test.describe(`Grands écrans — ${width}×${height}`, () => {
        test.use({ viewport: { width, height } });

        for (const url of pages) {
            test(`structure correcte sur ${url}`, async ({ page }) => {
                await page.goto(url, { waitUntil: "networkidle" });

                // Ouvre les accordéons pour mesurer leur contenu.
                await page.evaluate(() => {
                    document.querySelectorAll("details").forEach((item) => {
                        item.open = true;
                    });
                });

                const label = `sur ${url} à ${width}×${height}`;

                // Aucun débordement horizontal.
                const overflow = await page.evaluate(() => ({
                    html: document.documentElement.scrollWidth,
                    body: document.body.scrollWidth,
                    client: document.documentElement.clientWidth,
                }));

                expect(
                    overflow.html,
                    `documentElement.scrollWidth ${label}`
                ).toBeLessThanOrEqual(overflow.client);
                expect(
                    overflow.body,
                    `body.scrollWidth ${label}`
                ).toBeLessThanOrEqual(overflow.client);

                // Aucun élément important ne dépasse du viewport.
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

                // Hamburger absent ; panneau d'en-tête visible.
                await expect(page.locator(".menu-toggle")).toBeHidden();
                await expect(page.locator(".menu-mobile-nav")).toBeHidden();
                await expect(page.locator("#header-menu")).toBeVisible();

                // Menu desktop présent. L'accueil des univers (/) n'a que
                // le switch Nature/Reiki, sans menu de navigation.
                if (url === "/") {
                    await expect(page.locator(".switch-univers")).toBeVisible();
                } else {
                    await expect(
                        page.locator(".nature-menu, .reiki-menu").first()
                    ).toBeVisible();
                }
            });
        }

        test("l'accueil garde les deux univers côte à côte", async ({
            page,
        }) => {
            await page.goto("/", { waitUntil: "networkidle" });

            const boxes = await page.locator(".univers-box").evaluateAll(
                (elements) =>
                    elements.map((element) => {
                        const rect = element.getBoundingClientRect();

                        return {
                            left: rect.left,
                            right: rect.right,
                            top: rect.top,
                        };
                    })
            );

            expect(boxes).toHaveLength(2);
            expect(Math.abs(boxes[0].top - boxes[1].top)).toBeLessThan(2);
            expect(boxes[0].left).toBeGreaterThanOrEqual(0);
            expect(boxes[0].right).toBeLessThanOrEqual(boxes[1].left + 1);
            expect(boxes[1].right).toBeLessThanOrEqual(width);
        });
    });
}

