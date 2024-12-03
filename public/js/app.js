document.addEventListener("DOMContentLoaded", function() {
    // Get all the navigation links
    const options = document.querySelectorAll('.dash-nav .option');
    // Get all the title and content sections
    const titles = document.querySelectorAll('.title-section');
    const contents = document.querySelectorAll('.content-section');

    // Function to reset all to inactive state
    function resetActiveState() {
        // Set all background colours to light grey
        options.forEach(option => {
            option.style.backgroundColor = 'rgba(254, 204, 66, 0.3)'; 
        });
        // Don't diplay any titles
        titles.forEach(title => {
            title.style.display = 'none'; 
        });
        // Don't diplay any content
        contents.forEach(content => {
            content.style.display = 'none'; 
        });
    }

    // Function to set the active state based on the button pressed
    function setActiveState(id) {
        resetActiveState();
        const activeOption = document.querySelector(`#${id}`);
        const activeTitle = document.querySelector(`#${id}Title`);
        const activeContent = document.querySelector(`#${id}Content`);

        activeOption.style.backgroundColor = '#fecc42'; 
        activeTitle.style.display = 'block'; 
        activeContent.style.display = 'grid'; 
    }

    // Set the default active state to "orders"
    setActiveState('orders');

    // Add click event listeners to each option
    options.forEach(option => {
        option.addEventListener('click', function() {
            const id = this.id;
            setActiveState(id);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Get all the navigation links
    const choices = document.querySelectorAll('.admin-buttons .choice');
    // Get all the content sections
    const sections = document.querySelectorAll('.admin-content .admin-section');

    // Function to reset all to inactive state
    function resetActiveState() {
        // Reset all links' styles
        choices.forEach(choice => {
            choice.style.color = 'rgba(255, 255, 255,0.7)';
        });
        // Hide all content sections
        sections.forEach(section => {
            section.style.display = 'none';
        });
    }

    // Function to set the active state based on the button pressed
    function setActiveState(id) {
        resetActiveState();
        const activeChoice = document.querySelector(`#${id}`);
        const activeSection = document.querySelector(`#${id}Content`);

        if (activeChoice && activeSection) {
            activeChoice.style.color = '#fecc42';
            activeChoice.style.transform = 'translateY(0)'; 
            activeSection.style.display = 'grid';
        } else {
            console.warn(`No matching elements found for ID: ${id}`);
        }
    }

    // Check the query parameter to set the initial active state
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');

    if (tab) {
        setActiveState(tab);
    } else {
        // Default to "home" tab if no query parameter is provided
        setActiveState('home');
    }

    // Add click event listeners to each choice
    choices.forEach(choice => {
        choice.addEventListener('click', function () {
            const id = this.id;
            setActiveState(id);

            // Update the URL without refreshing the page
            const newUrl = `${window.location.pathname}?tab=${id}`;
            window.history.replaceState(null, '', newUrl);
        });
    });
});

// Request a fresh CSRF token
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
