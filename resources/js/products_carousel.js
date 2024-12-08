let currentIndex = 0; // Track the current index of the first visible product
const productsContainer = document.querySelector('.products-container');
const totalProducts = document.querySelectorAll('.product-box').length;
const productsToShow = 3; // Number of products to show at a time

// Update the carousel on left arrow click
document.querySelector('.left-arrow').addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex -= 1; // Move left by one product
        updateCarousel();
    }
});

// Update the carousel on right arrow click
document.querySelector('.right-arrow').addEventListener('click', () => {
    if (currentIndex < totalProducts - productsToShow) {
        currentIndex += 1; // Move right by one product
        updateCarousel();
    }
});

// Function to update the carousel display
function updateCarousel() {
    const offset = -currentIndex * (100 / productsToShow); // Calculate the offset
    productsContainer.style.transform = `translateX(${offset}%)`; // Apply the offset
}