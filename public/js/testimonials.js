document.addEventListener("DOMContentLoaded", function() {
    const track = document.getElementById("testimonials-track");
    const dots = document.querySelectorAll(".dot");
    const testimonials = document.querySelectorAll(".testimonial");

    // Sets the width of the track
    track.style.width = `${testimonials.length * 100}%`;

    // Makes the dots move the track
    dots.forEach((dot,index) => {
        dot.addEventListener("click", () =>{
            track.style.transform = `translateX(-${index * (100 / testimonials.length)}%)`;
            dots.forEach(d => d.classList.remove("active"));
            dot.classList.add("active");
        });
    });

    track.style.transform = "translateX(0)";
    dots[0].classList.add("active");
});