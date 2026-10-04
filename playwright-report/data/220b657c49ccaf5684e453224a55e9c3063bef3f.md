# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: site.spec.js >> Nature & Reiki — fonctionnement du site >> les deux univers sont accessibles depuis l'accueil
- Location: tests\e2e\site.spec.js:54:5

# Error details

```
Error: page.goto: net::ERR_NAME_NOT_RESOLVED at https://nature-reiki.be/
Call log:
  - navigating to "https://nature-reiki.be/", waiting until "load"

```

# Test source

```ts
  1   | const { test, expect } = require("@playwright/test");
  2   | 
  3   | test.describe("Nature & Reiki — fonctionnement du site", () => {
  4   |     test("la page d'accueil fonctionne", async ({ page }) => {
  5   |         const consoleErrors = [];
  6   |         const pageErrors = [];
  7   |         const failedResponses = [];
  8   | 
  9   |         page.on("console", (message) => {
  10  |             if (message.type() === "error") {
  11  |                 consoleErrors.push(message.text());
  12  |             }
  13  |         });
  14  | 
  15  |         page.on("pageerror", (error) => {
  16  |             pageErrors.push(error.message);
  17  |         });
  18  | 
  19  |         page.on("response", (response) => {
  20  |             const request = response.request();
  21  | 
  22  |             if (
  23  |                 request.resourceType() === "document" &&
  24  |                 response.status() >= 400
  25  |             ) {
  26  |                 failedResponses.push(
  27  |                     `${response.status()} ${response.url()}`
  28  |                 );
  29  |             }
  30  |         });
  31  | 
  32  |         const response = await page.goto("/", {
  33  |             waitUntil: "networkidle",
  34  |         });
  35  | 
  36  |         expect(response).not.toBeNull();
  37  |         expect(response.status()).toBeLessThan(400);
  38  | 
  39  |         await expect(page.locator("h1")).toHaveText("VOTRE UNIVERS");
  40  | 
  41  |         await expect(
  42  |             page.getByRole("link", { name: /Explorer la nature/i })
  43  |         ).toBeVisible();
  44  | 
  45  |         await expect(
  46  |             page.getByRole("link", { name: /Découvrir le Reiki/i })
  47  |         ).toBeVisible();
  48  | 
  49  |         expect(pageErrors).toEqual([]);
  50  |         expect(consoleErrors).toEqual([]);
  51  |         expect(failedResponses).toEqual([]);
  52  |     });
  53  | 
  54  |     test("les deux univers sont accessibles depuis l'accueil", async ({
  55  |         page,
  56  |     }) => {
> 57  |         await page.goto("/");
      |                    ^ Error: page.goto: net::ERR_NAME_NOT_RESOLVED at https://nature-reiki.be/
  58  | 
  59  |         await page
  60  |             .getByRole("link", { name: /Explorer la nature/i })
  61  |             .click();
  62  | 
  63  |         await expect(page).toHaveURL(/\/accueil-guide-nature\/?$/);
  64  |         await expect(page.locator("h1")).toHaveText("Guide-Nature");
  65  | 
  66  |         await page.goto("/");
  67  | 
  68  |         await page
  69  |             .getByRole("link", { name: /Découvrir le Reiki/i })
  70  |             .click();
  71  | 
  72  |         await expect(page).toHaveURL(/\/accueil-reiki\/?$/);
  73  |         await expect(page.locator("h1")).toHaveText("Reiki");
  74  |     });
  75  | 
  76  |     test("les deux contextes de la FAQ affichent le bon univers", async ({
  77  |         page,
  78  |     }) => {
  79  |         await page.goto("/faq/?univers=nature");
  80  | 
  81  |         await expect(
  82  |             page.locator(".faq-univers").first().locator("h2")
  83  |         ).toHaveText("Guide-Nature");
  84  | 
  85  |         await page.goto("/faq/?univers=reiki");
  86  | 
  87  |         await expect(
  88  |             page.locator(".faq-univers").first().locator("h2")
  89  |         ).toHaveText("Reiki");
  90  |     });
  91  | 
  92  |     test("les accordéons fonctionnent", async ({ page }) => {
  93  |         await page.goto("/soins-reiki/");
  94  | 
  95  |         const accordion = page.locator(
  96  |             "details.soins-reiki-accordeon"
  97  |         ).first();
  98  | 
  99  |         const summary = accordion.locator("summary");
  100 | 
  101 |         await expect(accordion).not.toHaveAttribute("open", "");
  102 | 
  103 |         await summary.click();
  104 | 
  105 |         await expect(accordion).toHaveAttribute("open", "");
  106 |     });
  107 | 
  108 |     test("le carrousel Nature fonctionne", async ({ page }) => {
  109 |         await page.goto("/balades/");
  110 | 
  111 |         const carrousel = page.locator(
  112 |             "[data-nature-carrousel]"
  113 |         ).first();
  114 | 
  115 |         await expect(carrousel).toBeVisible();
  116 | 
  117 |         const diapositives = carrousel.locator(
  118 |             "[data-nature-carrousel-diapositive]"
  119 |         );
  120 | 
  121 |         const boutonSuivant = carrousel.locator(
  122 |             "[data-nature-carrousel-suivant]"
  123 |         );
  124 | 
  125 |         expect(await diapositives.count()).toBeGreaterThan(1);
  126 | 
  127 |         await boutonSuivant.click();
  128 | 
  129 |         await expect(diapositives.nth(0)).toHaveAttribute(
  130 |             "aria-hidden",
  131 |             "true"
  132 |         );
  133 | 
  134 |         await expect(
  135 |             diapositives.nth(1)
  136 |         ).not.toHaveAttribute("aria-hidden", "true");
  137 |     });
  138 | 
  139 |     test("les liens de navigation Nature répondent", async ({ page, request }) => {
  140 |         await page.goto("/accueil-guide-nature/");
  141 | 
  142 |         const links = await page
  143 |             .locator(".nature-menu a")
  144 |             .evaluateAll((anchors) =>
  145 |                 anchors.map((anchor) => anchor.href)
  146 |             );
  147 | 
  148 |         for (const url of links) {
  149 |             const response = await request.get(url);
  150 | 
  151 |             expect(
  152 |                 response.status(),
  153 |                 `Lien invalide : ${url}`
  154 |             ).toBeLessThan(400);
  155 |         }
  156 |     });
  157 | 
```