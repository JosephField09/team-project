document.addEventListener("DOMContentLoaded", function() {
    // Get all the navigation links
    const options = document.querySelectorAll('.dash-nav .option');
    // Get all the title and content sections
    const titles = document.querySelectorAll('.title-section');
    const contents = document.querySelectorAll('.content-section');

    // Function to reset all to inactive state
    function resetChosenDashNav() {
        // Set all background colours to light grey
        options.forEach(option => {
            option.style.backgroundColor = 'rgba(254, 204, 66, 0.3)'; 
        });
        // Don't display any titles
        titles.forEach(title => {
            title.style.display = 'none'; 
        });
        // Don't display any content
        contents.forEach(content => {
            content.style.display = 'none'; 
        });
    }

    // Function to set the active state based on the button pressed
    function setChosenDashNav(id) {
        resetChosenDashNav();
        const activeOption = document.querySelector(`.dash-buttons #${id}`);
        const activeTitle = document.querySelector(`#${id}Title`);
        const activeContent = document.querySelector(`#${id}Content`);
    
        if (activeOption) activeOption.style.backgroundColor = '#fecc42';
        if (activeTitle) activeTitle.style.display = 'block';
        if (activeContent) activeContent.style.display = 'grid';
    }

    // Check for a query parameter to set the initial state
    const params = new URLSearchParams(window.location.search);
    const tab = params.get('tab');

    // If a query parameter exists, use it; otherwise, default to "orders"
    const defaultTab = tab || 'orders';
    setChosenDashNav(`dash-${defaultTab}`); // Prefix dashboard tabs
    // Add click event listeners to each option
    options.forEach(option => {
        option.addEventListener('click', function() {
            const id = this.id;
            setChosenDashNav(id);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll('.admin-content .admin-section');
    const titles = document.querySelectorAll('.adminTitle'); // ← Collect all the titles

    // Hide all sections and titles immediately on page load
    sections.forEach(section => section.style.display = 'none');
    titles.forEach(title => title.style.display = 'none');

    function resetChosenAdminNav() {
        // Hide all sections
        sections.forEach(section => section.style.display = 'none');
        // Hide all titles
        titles.forEach(title => title.style.display = 'none');
    }

    function setChosenAdminNav(id, updateURL = true) {
        resetChosenAdminNav();

        const activeChoice = document.querySelector(`.admin-buttons #${id}`);
        const activeSection = document.querySelector(`#${id}Content`);
        const activeTitle = document.querySelector(`#${id}Title`); // Find the matching title

        if (activeChoice && activeSection) {
            activeChoice.style.color = '#fecc42';
            activeChoice.style.transform = 'translateY(0)';
            activeSection.style.display = 'grid';

            // Show the matching title if it exists
            if (activeTitle) {
                activeTitle.style.display = 'block';
            }

            // Update URL without refreshing the page
            if (updateURL) {
                const newTab = id.replace('admin-', ''); // Remove "admin-" for cleaner URLs
                const newUrl = `${window.location.pathname}?tab=${newTab}`;
                window.history.replaceState(null, '', newUrl);
            }
        } else {
            console.warn(`No matching elements found for ID: ${id}`);
        }
    }

    // Get tab from URL
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');

    if (tab) {
        setChosenAdminNav(`admin-${tab}`, false); // Don't update URL on page load
    } else {
        setChosenAdminNav('admin-home', false); // Default tab without updating URL
    }

    // Click events
    choices.forEach(choice => {
        choice.addEventListener('click', function () {
            setChosenAdminNav(this.id); // Calls function and updates URL
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const admin = document.querySelector(".admin-main");
    const hamburger = document.querySelector(".admin-hamburger");
    const sidebar = document.querySelector("#admin-nav");

    // Open sidebar when hamburger is clicked
    hamburger.addEventListener("click", function () {
        admin.classList.toggle("inactive");
        hamburger.classList.toggle("inactive");
        sidebar.classList.toggle("inactive");
    });
});

function editCell(cell, user_id, fieldName) {
    // Check if an input is already present
    if (cell.querySelector('input')) return;

    // Get the current text content
    const currentValue = cell.textContent.trim();

    // Save the original value for restoration in case of failure
    cell.dataset.originalValue = currentValue;

    // Create an input element
    const input = document.createElement('input');
    input.type = 'text';
    input.value = currentValue;
    input.style.width = '100%';

    // Replace the cell content with the input
    cell.textContent = '';
    cell.appendChild(input);

    // Focus the input
    input.focus();

    // Save the value on blur or pressing Enter
    input.addEventListener('blur', () => saveCellValue(cell, input.value, user_id, fieldName));
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') saveCellValue(cell, input.value, user_id, fieldName);
    });
}

function saveCellValue(cell, newValue, user_id, fieldName) {
    // Check if the new value is empty
    if (!newValue.trim()) {
        alert('Value cannot be empty.');
        cell.textContent = cell.dataset.originalValue; // Restore the original value
        return;
    }

    // Send the updated value to the server using fetch
    fetch(`/profile/${user_id}/updateField`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ [fieldName]: newValue })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the cell with the new value
            cell.textContent = newValue;
        } else {
            alert('Failed to update. Please try again.');
            cell.textContent = cell.dataset.originalValue; // Restore the original value on failure
        }
    })
    .catch(error => {
        console.error('Error:', error);
        cell.textContent = cell.dataset.originalValue; // Restore the original value on error
    });
}

// Function to edit the category name
function editCategoryName(cell, id) {
    // Find the elements inside the cell: the display span and the input field
    const span = cell.querySelector('.category-name'); 
    const input = cell.querySelector('.edit-input'); 

    // Hide the span that shows the category name
    span.style.display = 'none';

    // Show the input field for editing and focus on it
    input.style.display = 'block';
    input.focus();
}

// Function to save the updated category name
function saveCategoryName(input, id) {
    // Find the span element and value from input
    const span = input.parentElement.querySelector('.category-name');
    const newValue = input.value.trim();

    // Validation to make sure the category name isn't left empty
    if (newValue === "") {
        alert('Category name cannot be empty!');
        input.focus(); 
        return;
    }

    // Send an AJAX request to the server to update the category name
    fetch(`/category/update/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        },
        body: JSON.stringify({ name: newValue }) 
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // If the update is successful, update the UI,change the span text and hide the input field 
            span.textContent = newValue;
            span.style.display = 'block';
            input.style.display = 'none';
        } else {
            // Tell the user if there is as an error
            alert('Failed to update category name.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the category.');
    });
}

function toggleFilterDropdown() {
    const dropdown = document.getElementById('filter-dropdown');
    dropdown.classList.toggle('hidden');
}

// Request a fresh CSRF token
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
