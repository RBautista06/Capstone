document.addEventListener("DOMContentLoaded", function() {
    const st1piety = document.querySelector(".st1piety");
    const pietyEstates = document.getElementById("piety_estates");

    st1piety.addEventListener("mouseover", function() {
        pietyEstates.querySelectorAll(".st2").forEach(function(element) {
            element.style.fill = "rgb(255, 255, 255)";
        });
    });

    st1piety.addEventListener("mouseout", function() {
        pietyEstates.querySelectorAll(".st2").forEach(function(element) {
            element.style.fill = "coral";
        });
    });
});
