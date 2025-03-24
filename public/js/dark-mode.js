document.addEventListener("DOMContentLoaded", () => {
// This gets the button from the document as well as the body section
    const body = document.body;

    // Toggles whether darkmode is toggled on or not
    function setDarkMode(enabled){
        body.classList.toggle('dark-mode');
        localStorage.setItem('toggled', enabled);
    }

    // Checks what mode is saved (true means dark mode )
    if (localStorage.getItem('toggled') === 'true') {
        setDarkMode(true);
    }

    // Listens out for when the button is clicked
    document.getElementById('toggleMode').addEventListener('click', () => {
        const isToggled = body.classList.contains('dark-mode');
        setDarkMode(!isToggled);
    });

    // Same listening but for the toggle button in the hamburger menu
    document.getElementById('hb-toggleMode').addEventListener('click', () => {
        const isToggled = body.classList.contains('dark-mode');
        setDarkMode(!isToggled);
    });
});

