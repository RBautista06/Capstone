
document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById("category");
    const tableContainer = document.querySelector(".table-container");

    // Event listener for category selection change
    categorySelect.addEventListener("change", function () {
        const selectedCategory = categorySelect.value;

        // Use AJAX or fetch to retrieve data based on the selected category and update the table
        // Example: You can make an AJAX request to a PHP file with the selected category as a parameter

        // For now, let's just console log the selected category
        console.log("Selected Category:", selectedCategory);
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const btnPopups = document.querySelectorAll('.btnLogin-popup');

    btnPopups.forEach(btnPopup => {
        btnPopup.addEventListener('click', () => {
            const tableId = btnPopup.getAttribute('data-table-id');
            const wrapper = document.getElementById('wrapper1_' + tableId);

            if (wrapper) {
                wrapper.classList.add('active-popup');
            }
        });
    });

    // Assuming you want to close the popup when the close icon is clicked
    const iconCloses = document.querySelectorAll('.iconclose');

    iconCloses.forEach(iconClose => {
        iconClose.addEventListener('click', () => {
            const wrapper = iconClose.closest('.wrapper1');
            if (wrapper) {
                wrapper.classList.remove('active-popup');
            }
        });
    });
});
