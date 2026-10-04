# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: site.spec.js >> Nature & Reiki — fonctionnement du site >> la page 404 fonctionne
- Location: tests\e2e\site.spec.js:177:5

# Error details

```
Error: page.goto: net::ERR_NAME_NOT_RESOLVED at https://nature-reiki.be/page-qui-n-existe-pas-pour-les-tests/
Call log:
  - navigating to "https://nature-reiki.be/page-qui-n-existe-pas-pour-les-tests/", waiting until "networkidle"

```

# Test source

```ts
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
  158 |     test("les liens de navigation Reiki répondent", async ({ page, request }) => {
  159 |         await page.goto("/accueil-reiki/");
  160 | 
  161 |         const links = await page
  162 |             .locator(".reiki-menu a")
  163 |             .evaluateAll((anchors) =>
  164 |                 anchors.map((anchor) => anchor.href)
  165 |             );
  166 | 
  167 |         for (const url of links) {
  168 |             const response = await request.get(url);
  169 | 
  170 |             expect(
  171 |                 response.status(),
  172 |                 `Lien invalide : ${url}`
  173 |             ).toBeLessThan(400);
  174 |         }
  175 |     });
  176 | 
  177 |     test("la page 404 fonctionne", async ({ page }) => {
> 178 |         const response = await page.goto(
      |                                     ^ Error: page.goto: net::ERR_NAME_NOT_RESOLVED at https://nature-reiki.be/page-qui-n-existe-pas-pour-les-tests/
  179 |             "/page-qui-n-existe-pas-pour-les-tests/",
  180 |             {
  181 |                 waitUntil: "networkidle",
  182 |             }
  183 |         );
  184 | 
  185 |         expect(response).not.toBeNull();
  186 |         expect(response.status()).toBe(404);
  187 | 
  188 |         await expect(page.locator("h1")).toHaveText(
  189 |             "Page introuvable"
  190 |         );
  191 |     });
  192 | });
```