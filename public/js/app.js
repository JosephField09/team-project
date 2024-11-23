document.addEventListener("DOMContentLoaded", function() {
    // Get all the navigation links
    const options = document.querySelectorAll('.dash-nav .option');
    // Get all the title and content sections
    const titles = document.querySelectorAll('.title-section');
    const contents = document.querySelectorAll('.content-section');

    // Function to reset all to inactive state
    function resetActiveState() {
        options.forEach(option => {
            option.style.backgroundColor = 'rgba(254, 204, 66, 0.3)'; 
        });
        titles.forEach(title => {
            title.style.display = 'none'; 
        });
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

        activeOption.style.backgroundColor = 'rgb(254, 204, 66)'; 
        activeTitle.style.display = 'block'; 
        activeContent.style.display = 'block'; 
    }

    // Set the initial active state to "orders"
    setActiveState('orders');

    // Add click event listeners to each option
    options.forEach(option => {
        option.addEventListener('click', function() {
            const id = this.id;
            setActiveState(id);
        });
    });
});