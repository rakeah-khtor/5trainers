document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".icon-list-item.tab");
    const contents = document.querySelectorAll(".course-tab-content");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();

            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove("active"));
            // Add active to clicked tab
            tab.classList.add("active");

            // Hide all tab contents
            contents.forEach(c => c.classList.remove("active"));
            // Show the selected tab content
            contents[index].classList.add("active");
        });
    });

    // Set default: first tab active
    tabs[0].classList.add("active");
    contents[0].classList.add("active");
});