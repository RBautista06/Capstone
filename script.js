document.addEventListener("DOMContentLoaded", function() {
    const graves = document.querySelectorAll(".grave");
  
    graves.forEach(grave => {
      grave.addEventListener("mouseover", function() {
        const graveId = this.getAttribute("id");
        fetchGraveData(graveId);
      });
      grave.addEventListener("mouseout", function() {
        hideGraveDetails();
      });
    });
  
    function fetchGraveData(graveId) {
      fetch(`get_grave_data.php?grave_id=${graveId}`)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            showGraveDetails(data.name, data.date_of_death);
          } else {
            hideGraveDetails();
            console.error("Failed to fetch grave data");
          }
        })
        .catch(error => {
          hideGraveDetails();
          console.error("Error fetching grave data:", error);
        });
    }
  
    function showGraveDetails(name, dateOfDeath) {
      const graveDetails = document.getElementById("grave-details");
      graveDetails.innerHTML = `<strong>Name:</strong> ${name}<br><strong>Date of Death:</strong> ${dateOfDeath}`;
      graveDetails.style.display = "block";
    }
  
    function hideGraveDetails() {
      const graveDetails = document.getElementById("grave-details");
      graveDetails.style.display = "none";
    }
  });