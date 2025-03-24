document.addEventListener("DOMContentLoaded", () => {
  const maxSlots = 5;
  const track = document.getElementById("testimonials-track");
  const testimonials = Array.from(track.querySelectorAll(".testimonial"));
  const count = testimonials.length;
  
  // Add a centering class if the number of testimonials 
  track.classList.toggle("odd-testimonials", count % 2 === 1);

  // Make the middle testimonial active by default
  let currentIndex = Math.floor(count / 2);
  
  // Find out how many empty spaces (spacers) are needed on each side
  const leftSlots = Math.floor((maxSlots - count) / 2);
  const rightSlots = maxSlots - count - leftSlots;
  
  // If there are fewer testimonials than slots, add empty spacers to center them
  if (count < maxSlots) {
    track.innerHTML = "";
    if (leftSlots > 0) {
      const leftSpacer = document.createElement("div");
      leftSpacer.className = "testimonial-spacer";
      leftSpacer.style.flex = `0 0 ${(leftSlots * 100) / maxSlots}%`;
      track.appendChild(leftSpacer);
    }
    testimonials.forEach(t => track.appendChild(t));
    if (rightSlots > 0) {
      const rightSpacer = document.createElement("div");
      rightSpacer.className = "testimonial-spacer";
      rightSpacer.style.flex = `0 0 ${(rightSlots * 100) / maxSlots}%`;
      track.appendChild(rightSpacer);
    }
  }

  // Create navigation dots for each testimonial and add click handlers
  const dotsContainer = document.getElementById("testimonial-dots");
  testimonials.forEach((_, index) => {
    const dot = document.createElement("span");
    dot.className = "dot";
    dot.dataset.index = index;
    dot.addEventListener("click", () => {
      currentIndex = index;
      updateTestimonials();
      resetAutoScroll();
    });
    dotsContainer.appendChild(dot);
  });

  // Function to update which testimonial and dot is active
  function updateTestimonials() {
    const centerSlot = Math.floor(maxSlots / 2);
    const activeSlot = leftSlots + currentIndex;
    track.style.transform = `translateX(${-((activeSlot - centerSlot) * (100 / maxSlots))}%)`;
    
    // Set the active testimonial with full opacity and others with lower opacity
    testimonials.forEach((t, i) => {
      t.classList.toggle("active", i === currentIndex);
      t.style.opacity = i === currentIndex ? "1" : "0.5";
    });
    
    // Update which dot is active
    dotsContainer.querySelectorAll(".dot").forEach((dot, i) =>
      dot.classList.toggle("active", i === currentIndex)
    );
  }
  
  updateTestimonials();
  
  // Auto-switch testimonials every 3 seconds
  let autoScrollInterval = setInterval(autoScroll, 3000);
  function autoScroll() {
    currentIndex = (currentIndex + 1) % count;
    updateTestimonials();
  }
  
  // Reset auto-scroll when the user clicks a dot
  function resetAutoScroll() {
    clearInterval(autoScrollInterval);
    autoScrollInterval = setInterval(autoScroll, 3000);
  }
});

