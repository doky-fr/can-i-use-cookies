import "./public.css";

/**
 * When the DOM is ready
 */
document.addEventListener("DOMContentLoaded", () => {
    const cookieName = "cookie-consent"
    if (document.cookie.includes(`${cookieName}=yes`)) {
        return;
    }

    const popup = document.getElementById("can-i-use-cookies");
    const yesButton = document.getElementById("can-i-use-cookies-yes");
    const noButton = document.getElementById("can-i-use-cookies-no");
    if (!popup || !yesButton || !noButton) {
        return;
    }

    popup.style.display = null;

    // Add event listeners
    yesButton.addEventListener("click", () => {
        document.cookie = `${cookieName}=yes; path=/`;
        popup.style.display = "none";
    }, false);

    noButton.addEventListener("click", () => {
        document.cookie = `${cookieName}=no; path=/`;
        popup.style.display = "none";
    }, false);
});

