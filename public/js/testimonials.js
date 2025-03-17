document.addEventListener("DOMContentLoaded", function() {
    const track = document.getElementById("testimonials-track");
    const testimonials = document.querySelectorAll(".testimonial");
    const prevButton = document.getElementById("prevTestimonial");
    const nextButton = document.getElementById("nextTestimonial");
    let currentIndex = 1;
    
    function updateTestimonials() {
        const offset = -((currentIndex - 1) * (100 / testimonials.length)) + "%"; 
        track.style.transform = `translateX(${offset})`;
        
        testimonials.forEach((testimonial, index) => {
            testimonial.classList.toggle("active", index === currentIndex);
            testimonial.style.opacity = index === currentIndex ? "1" : "0.5";
        });
    }
    
    prevButton.addEventListener("click", function() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : testimonials.length - 1;
        updateTestimonials();
    });
    
    nextButton.addEventListener("click", function() {
        currentIndex = (currentIndex < testimonials.length - 1) ? currentIndex + 1 : 0;
        updateTestimonials();
    });
    
    updateTestimonials();
});