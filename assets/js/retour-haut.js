document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector(".retour-haut");

    if (!button) {
        return;
    }

    const updateButton = () => {
        const visible = window.scrollY > 350;

        button.classList.toggle("visible", visible);
        button.setAttribute("aria-hidden", String(!visible));
    };

    window.addEventListener("scroll", updateButton, { passive: true });

    button.addEventListener("click", () => {
        const reduceMotion = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        ).matches;

        window.scrollTo({
            top: 0,
            behavior: reduceMotion ? "auto" : "smooth"
        });
    });

    updateButton();
});