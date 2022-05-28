window.onload = () => {
    const logoutBtn = document.querySelector(".logout-btn");

    const clearLocalStorageOnLogout = () => window.localStorage.clear();

    logoutBtn.addEventListener("click", clearLocalStorageOnLogout);
};
