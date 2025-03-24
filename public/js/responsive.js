document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".hamburger");
    const sidebar = document.querySelector(".sidebar");
    const currencySelector = document.querySelector("#hb-currency-selector");

    // Open sidebar when hamburger is clicked
    hamburger.addEventListener("click", function () {
        hamburger.classList.toggle("active");
        sidebar.classList.toggle("active");
    });

    // Close sidebar when a link is clicked
    document.querySelectorAll(".sidebar a").forEach((link) => {
        link.addEventListener("click", function () {
            hamburger.classList.remove("active");
            sidebar.classList.remove("active");
        });
    });

    // Keep sidebar open when clicking the currency select
    currencySelector.addEventListener("click", function (event) {
        event.stopPropagation(); 
    });

    // Close sidebar only when a currency is selected
    currencySelector.addEventListener("change", function () {
        setTimeout(() => {
            hamburger.classList.remove("active");
            sidebar.classList.remove("active");
        }, 300); 
    });

    // Close sidebar if the user clicks anywhere outside the sidebar
    body.addEventListener("click", function (event) {
        if (!sidebar.contains(event.target) && !hamburger.contains(event.target)) {
            hamburger.classList.remove("active");
            sidebar.classList.remove("active");
        }
    });
});
