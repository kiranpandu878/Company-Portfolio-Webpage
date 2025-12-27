document.addEventListener("DOMContentLoaded", function() {
    const navbarLinks = document.querySelectorAll(".nav-link");
    const navbarCollapse = document.querySelector(".navbar-collapse");

    // Loop through each link
    navbarLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            const targetId = this.getAttribute("href"); // Get target section ID

            // Smooth scroll to target section
            document.querySelector(targetId).scrollIntoView({
                behavior: "smooth",
                block: "start" // Align the top of the section with the top of the viewport
            });

            if (navbarCollapse.classList.contains("show")) {
                navbarCollapse.classList.remove("show"); // Close the navbar for mobile view
            }
        });
    });
});