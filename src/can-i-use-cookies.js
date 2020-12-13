import './can-i-use-cookies.css';

document.addEventListener('DOMContentLoaded', () => {
    const cookieName = 'cookie-consent';
    if (document.cookie.includes(`${cookieName}=yes`)) {
        return;
    }

    const popup = document.getElementById('can-i-use-cookies');
    const yesButton = document.getElementById('can-i-use-cookies-yes');
    const noButton = document.getElementById('can-i-use-cookies-no');
    if (!popup || !yesButton || !noButton) {
        return;
    }

    popup.style.display = null;

    const expireDate = new Date();
    expireDate.setMonth(expireDate.getMonth() + 6);

    yesButton.addEventListener('click', () => {
        document.cookie = `${cookieName}=yes; expires=${expireDate.toUTCString()}; path=/`;
        popup.style.display = 'none';
    }, false);

    noButton.addEventListener('click', () => {
        document.cookie = `${cookieName}=no; expires=${expireDate.toUTCString()}; path=/`;
        popup.style.display = 'none';
    }, false);
});

