// This gets the button from the document as well as the body section
const toggle = document.getElementById('toggleMode');
const body = document.body;

// Listens out for when the button is clicked
toggle.addEventListener('click', () => {
    // Removes the dark mode from the items
    if (body.classList.contains('dark-mode')){ 
        body.classList.remove('dark-mode'); 
        localStorage.setItem('theme','light');
        location.reload();
    } else {
        // Adds the dark mode to the items
        main.classList.add('dark-mode');
        localStorage.setItem('theme','dark');
        location.reload();
    }
});

// Adds dark mode if the theme is set to dark
if (localStorage.getItem('theme') === 'dark'){
    body.classList.add('dark-mode');
}