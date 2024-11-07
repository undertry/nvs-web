document.addEventListener("DOMContentLoaded", function () {
    const toggleTitles = document.querySelectorAll(".toggle-title");

    toggleTitles.forEach((title) => {
        title.addEventListener("click", function (event) {
            event.stopPropagation();

            const section = this.parentElement;

            document.querySelectorAll(".expanded").forEach(expandedSection => {
                if (expandedSection !== section) {
                    expandedSection.classList.remove("expanded");
                    expandedSection.querySelector(".arrow-icon").classList.remove("rotate");
                }
            });

            section.classList.toggle("expanded");
            this.querySelector(".arrow-icon").classList.toggle("rotate");
        });
    });
});