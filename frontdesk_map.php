<!doctype html>
<html>
<?php
include 'dbconnection.php';
$account_id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;

if ($account_id > 0) {

    $query = "SELECT * FROM tbl_accounts WHERE ACCOUNT_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {

        $account = $result->fetch_assoc();
    } else {
        echo "Account not found.";
        exit;
    }
} else {
    echo "Invalid account ID.";
    exit;
}


$stmt->close();
$conn->close();
?>
	<head>
		<title>Frontdesk Map</title>
		<link rel="stylesheet" href="frontdeskmap.css" type="text/css"/>
		<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
</head>
<!-- <div class="containermagni">
    <model-viewer id="myModelViewer" 
                  src="3dmodels/magnifyall.gltf" 
                  alt="A 3D model of a magnifying glass" 
                  shadow-intensity="3" 
				  camera-orbit="80deg 90deg 15m" 
                  class="magni">
    </model-viewer>
</div> -->

<model-viewer id="myModelViewer" src="3dmodels/frontdesklogo.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="0.5" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="providence3dlogo" camera-orbit="180deg 90deg 150m">
</model-viewer>
<div class="sidebackground">

</div>
<div class="rightbackground">

</div>

<model-viewer id="myModelViewer" src="3dmodels/FRONTDESKTEXT.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="admintext3d" camera-orbit="340deg 83deg 300m" camera-controls>
</model-viewer>
<body>
 <?php
 include "frontdeskaside.php";
 include "map.php";
 ?>
<!-- Generator: Adobe Illustrator 28.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->



</div>

<div id="messageBox" class="messageBox">
    <p id="messageText"></p>
</div>

<div class="searchline">


	<div class="search-container">
	<h1><img src="pictures/locatedecendent.png" ></h1>
		<div class="search-bar">
			<input type="text" id="search-input" placeholder="Enter the name of the interred decedent..." onkeyup="suggestSearch()">
			<div id="searchresult" class="searchresult"></div>
			<span> &nbsp;&nbsp;&nbsp;<ion-icon name="search-outline"></ion-icon> </span>
			<button class="locate" id="showocation">LOCATE</button>	
	</div>
	<h2><img src="pictures/decendentdetails.png" ></h2>

	<div class="white-box">
    		<p placeholder = "Decendent Details"></p>
	</div>

</div>
</div>





	<div class="legend">
			<div class="legend-item">
				<div class="legend-color st1piety-color"></div>
				<span>Piety Estates</span>
			</div>
			<div class="legend-item">
				<div class="legend-color st1reflection-color"></div>
				<span>Reflection Of Life</span>
			</div>
			<div class="legend-item">
				<div class="legend-color st1solace-color"></div>
				<span>Solace Estates</span>
			</div>
			<div class="legend-item">
				<div class="legend-color st1serenity-color"></div>
				<span>Court of Serenity</span>
			</div>
			<div class="legend-item">
				<div class="legend-color st1tranquility-color"></div>
				<span>Court of Tranquility</span>
			</div>
			<div class="legend-item">
				<div class="legend-color st1evergreen-color"></div>
				<span>Evergreen Memories</span>
			</div>
			<div class="legend-item">
				<div class="legend-color st1tapestry-color"></div>
				<span>Tapestry of Life</span>
			</div>

			<div class="legend-item">
			<div class="legend-color st1person-color"></div>
				<span>Start Location</span>
	</div>



</div>

</div>


    <script>
        document.body.addEventListener('click', function(event) {
            var searchResult = document.getElementById('searchresult');
            if (!searchResult.contains(event.target)) {
                searchResult.style.display = 'none';
            }
        });

        function suggestSearch() {
            var input = document.getElementById('search-input');
            var filter = input.value.toUpperCase();
            var ul = document.getElementById("searchresult");
            ul.innerHTML = '';

            if (filter === '') {
                ul.style.display = 'none';
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    try {
                        var suggestions = JSON.parse(this.responseText);
                        suggestions.forEach(function(suggestion) {
                            var fullName = [suggestion.FIRSTNAME, suggestion.MIDDLENAME, suggestion.LASTNAME].filter(Boolean).join(' ');

                            var div = document.createElement('div');
                            div.textContent = fullName + " (Interment ID: " + suggestion.INTERMENTFORM_ID + ")"; // Show INTERMENTFORM_ID
                            div.addEventListener('click', function() {
                                input.value = fullName; // Set the input to the full name
                                fetchDetails(suggestion.INTERMENTFORM_ID); // Pass INTERMENTFORM_ID to fetchDetails
                                ul.style.display = 'none'; // Hide the suggestion list
                            });
                            ul.appendChild(div);
                        });
                        if (suggestions.length === 0) {
                            var div = document.createElement('div');
                            div.textContent = "No descendant found";
                            ul.appendChild(div);
                        }
                        ul.style.display = "block"; // Show the suggestion list
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                    }
                }
            };

            xhr.open("GET", "search.php?search=" + encodeURIComponent(filter), true);
            xhr.send();
        }

        // Function to fetch details based on INTERMENTFORM_ID
        function fetchDetails(intermentFormId) {
            console.log("Fetching details for Interment ID:", intermentFormId); // Debugging log
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    try {
                        var details = JSON.parse(this.responseText);
                        console.log("Details received:", details); // Debugging log
                        displayDetails(details);
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                    }
                }
            };

            xhr.open("GET", "fetch_details.php?INTERMENTFORM_ID=" + encodeURIComponent(intermentFormId), true);
            xhr.send();
        }
        // Function to highlight additional lots
        function highlightAdditionalLots(lots) {
            var svgContainer = document.getElementById("svgContainer");
            var svg = svgContainer.getElementsByTagName("svg")[0];

            // Log the lots being highlighted
            console.log("Highlighting lots:", lots);

            // Function to highlight a lot with delay
            function highlightLot(index) {
                if (index < lots.length) { // Check if there are more lots to highlight
                    var lotId = lots[index];
                    var element = svg.getElementById(lotId);
                    if (element) {
                        console.log("Adding glow to:", lotId);
                        element.classList.add("glow"); // Add glow class for highlighting

                        // Call the next highlight after a delay (e.g., 500ms)
                        setTimeout(function() {
                            highlightLot(index + 1); // Highlight the next lot
                        }, 500); // Adjust the delay as needed
                    } else {
                        console.log("Element with ID " + lotId + " not found."); // Log if element is not found
                        highlightLot(index + 1); // Continue to the next lot even if this one is not found
                    }
                }
            }

            highlightLot(0); // Start highlighting from the first lot
        }

        function highlightAdditionalLots(lots) {
            var svgContainer = document.getElementById("svgContainer");
            var svg = svgContainer.getElementsByTagName("svg")[0];

            lots.forEach(function(lotId) {
                var element = svg.getElementById(lotId);
                if (element) {
                    console.log("Adding glow to:", lotId);
                    element.classList.add("glow");
                } else {
                    console.log("Element with ID " + lotId + " not found.");
                }
            });
        }

        // Function to fetch additional lots based on location ID
        function fetchAdditionalLots(locationId) {
            return new Promise(function(resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'fetch_lots.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        try {
                            var response = JSON.parse(xhr.responseText);
                            resolve(response); // Resolve the promise with the response
                        } catch (error) {
                            reject("Error parsing JSON response."); // Handle JSON parsing error
                        }
                    } else {
                        reject("Error: " + xhr.status); // Handle HTTP error
                    }
                };
                xhr.onerror = function() {
                    reject("Request failed."); // Handle network error
                };
                xhr.send('location_id=' + encodeURIComponent(locationId)); // Send only the Location ID
            });
        }

        // Function to display details
        function displayDetails(details) {
            var whiteBox = document.querySelector('.white-box');
            whiteBox.innerHTML = ''; // Clear previous details

            if (details && details.length > 0) {
                var detail = details[0]; // Get the first detail
                var paragraph = document.createElement('p');
                paragraph.innerHTML = "Name: " + [detail.FIRSTNAME, detail.MIDDLENAME, detail.LASTNAME].filter(Boolean).join(' ') + "<br>" +
                    "Interment ID: " + detail.INTERMENTFORM_ID + "<br>" +
                    "Location ID: " + detail.LOCATION_ID + "<br>" +
                    "Date of Death: " + (detail.DATE_OF_DEATH || "N/A") + "<br>" +
                    "Type of Remain: Fresh Body <br>" +
                    "Grave Location: " + (detail.LOT1 || "N/A");
                whiteBox.appendChild(paragraph); // Append details to the white box

                // Fetch additional lots based on the Location ID
                const locationId = detail.LOCATION_ID; // Store the Location ID

                if (locationId) {
                    fetchAdditionalLots(locationId) // Fetch lots using the Location ID
                        .then(function(lots) {
                            console.log("Additional lots fetched:", lots);
                            // Optionally process and display the fetched lots
                            displayFetchedLots(lots); // Assuming you create a function to handle this
                            highlightAdditionalLots(lots); // Highlight the lots after fetching
                        })
                        .catch(function(error) {
                            console.error("Failed to fetch additional lots:", error); // Log any errors
                        });
                }
            } else {
                whiteBox.innerHTML = 'No details found.'; // Message for no details
            }
        }


        function extractGraveLocation(detailsText) {
            var graveLocation = detailsText.match(/Grave Location: (.+)/);
            if (graveLocation && graveLocation[1]) {
                return graveLocation[1].trim();
            } else {
                console.log("Grave location could not be extracted.");
                alert("Grave location could not be extracted.");
                return null;
            }
        }





        // Function to zoom into the grave location
        function zoomToGrave(svg, element) {
            var bbox = element.getBBox();
            var centerX = bbox.x + bbox.width / 2;
            var centerY = bbox.y + bbox.height / 2;
            var initialViewBox = svg.getAttribute("viewBox").split(" ").map(parseFloat);
            var targetViewBox = [(centerX - 100), (centerY - 100), 200, 200];
            var duration = 3000;
            var steps = 60;
            var dx = (targetViewBox[0] - initialViewBox[0]) / steps;
            var dy = (targetViewBox[1] - initialViewBox[1]) / steps;
            var dw = (targetViewBox[2] - initialViewBox[2]) / steps;
            var dh = (targetViewBox[3] - initialViewBox[3]) / steps;
            var step = 0;
            var intervalId = setInterval(function() {
                var viewBox = [
                    initialViewBox[0] + step * dx,
                    initialViewBox[1] + step * dy,
                    initialViewBox[2] + step * dw,
                    initialViewBox[3] + step * dh
                ].join(" ");
                svg.setAttribute("viewBox", viewBox);
                step++;
                if (step >= steps) {
                    clearInterval(intervalId);
                }
            }, duration / steps);
        }

        // Function to create a path from start to grave location
        function createPath(svg, graveLocation, element) {
            var centerX = element.getBBox().x + element.getBBox().width / 2;
            var centerY = element.getBBox().y + element.getBBox().height / 2;

            // Determine pathId based on graveLocation
            var pathId;
            if (graveLocation.startsWith("COS-SEC1")) {
                pathId = "courtofserenetypathway";
            } else if (graveLocation.startsWith("EVGM-SEC3")) {
                pathId = "evergreensection3pathway";
            }else if (graveLocation.match(/^EVGM-SEC2-[A-Z]\d*$/))  {
                pathId = "evergreensection2pathway";
            }
            else if (graveLocation.match(/^EVGM-SEC1-[A-Z]\d*$/)) {
                pathId = "evergreensection1pathway";
            } 
        else if (graveLocation.startsWith("EVGM-SEC4")) {
			pathId = "evergreensection4pathway";
		} else if (graveLocation.startsWith("EVGM-SEC5")) {
			pathId = "evergreensection5pathway";
		} 
        
        ////////baliktad to
        else if (graveLocation.startsWith("EVGM-SEC6")) {
			pathId = "evergreensection6pathway";


        
		} else if (graveLocation.startsWith("EVGM-SEC7")) {
			pathId = "evergreensection7pathway";
		} else if (graveLocation.startsWith("EVGM-SEC8")) {
			pathId = "evergreensection8pathway";
		} 
        ////////baliktad to
        else if (graveLocation.startsWith("EVGM-SEC9")) {
			pathId = "evergreensection9pathway";


        }else if (graveLocation.match(/^EVGM-SEC10-[A-Z]\d*$/)) {
			pathId = "evergreensection10pathway";
		} 
        

        
        else if (graveLocation.startsWith("EVGM-SEC11")) {
			pathId = "evergreensection11pathway";
		} else if (graveLocation.startsWith("EVGM-SEC12")) {
			pathId = "evergreensection12pathway";
		} else if (graveLocation.startsWith("EVGM-SEC13")) {
			pathId = "evergreensection13pathway";
		} else if (graveLocation.startsWith("EVGM-SEC14")) {
			pathId = "evergreensection14pathway";
		} else if (graveLocation.startsWith("EVGM-SEC15")) {
			pathId = "evergreensection15pathway";
		} else if (graveLocation.startsWith("EVGM-SEC16")) {
			pathId = "evergreensection16pathway";
		} else if (graveLocation.startsWith("EVGM-SEC17")) {
			pathId = "evergreensection17pathway";
		} else if (graveLocation.startsWith("EVGM-SEC18")) {
			pathId = "evergreensection18pathway";
		} else if (graveLocation.startsWith("EVGM-SEC19")) {
			pathId = "evergreensection21pathway";
		} else if (graveLocation.startsWith("EVGM-SEC20")) {
			pathId = "evergreensection20pathway";
		} 
		else if (graveLocation.startsWith("EVGM-SEC21")) {
			pathId = "evergreensection21pathway";
		}
		else if (graveLocation.startsWith("PE-SEC3-C")) {
			pathId = "pietyestatessec3_DC_pathway";
		}
		else if (graveLocation.startsWith("PE-SEC3-D")) {
			pathId = "pietyestatessec3_DC_pathway";
		}
		else if (graveLocation.startsWith("PE-SEC3-A")) {
			pathId = "pietyestatessec3_AB_pathway";
		}
		else if (graveLocation.startsWith("PE-SEC3-B")) {
			pathId = "pietyestatessec3_AB_pathway";
		}
		else if (graveLocation.startsWith("PE-SEC4")) {
			pathId = "pietyestatessec4_pathway";
		}
		else if (graveLocation.startsWith("TOL-SEC12")) {
			pathId = "tolsection12pathway";
		}




        else if (graveLocation.startsWith("TOL-SEC1-A")) {
			pathId = "tolsec0pathway";
		}
        else if (graveLocation.startsWith("TOL-SEC1-B")) {
			pathId = "tolsec0pathway";
		}
else if (graveLocation.match(/^TOL-SEC1-[A-Z]\d*$/)) {
    pathId = "tolsec1pathway";
}

else if (graveLocation.match(/^TOL-SEC2-[A-Z](1[11]|20)$/)) { 
    pathId = "tolsec1pathway"; // Matches numbers 10 to 20
} else if (graveLocation.match(/^TOL-SEC2-[A-Z]([1-9]|10)$/)) { 
    pathId = "tolsec2pathway"; // Matches numbers 1 to 10
}

else if (graveLocation.match(/^TOL-SEC3-[E-K]\d*$/)) {
    pathId = "tolsec2pathway";
} 

else if (graveLocation.match(/^TOL-SEC3-[A-D]\d*$/)) {
    pathId = "tolsec3pathway";
}
else if (graveLocation.match(/^TOL-SEC4-[K-T]\d*$/)) {
    pathId = "tolsec3pathway";
} 
///////////////////////////////PROBLEM HERE THE PATH IS BALIKTAD TOLSE4PATHWAY
else if (graveLocation.match(/^TOL-SEC4-[A-J]\d*$/)) {
    pathId = "tolsec4pathway";
} 
else if (graveLocation.match(/^TOL-SEC5-[J-T]\d*$/)) {
    pathId = "tolsec4pathway";
} 
else if (graveLocation.match(/^TOL-SEC5-[A-I]\d*$/)) {
    pathId = "tolsec5pathway";
} 

else if (graveLocation.match(/^TOL-SEC6-[J-S]\d*$/)) {
    pathId = "tolsec5pathway";
} 
else if (graveLocation.match(/^TOL-SEC6-[A-I]\d*$/)) {
    pathId = "tolsec6pathway";
} 

else if (graveLocation.match(/^TOL-SEC7-[J-S]\d*$/)) {
    pathId = "tolsec6pathway";
} 
else if (graveLocation.match(/^TOL-SEC7-[A-I]\d*$/)) {
    pathId = "tolsec7pathway";
} 

else if (graveLocation.match(/^TOL-SEC8-[J-T]\d*$/)) {
    pathId = "tolsec7pathway";
} 
else if (graveLocation.match(/^TOL-SEC8-[A-I]\d*$/)) {
    pathId = "tolsec8pathway";
} 

else if (graveLocation.match(/^TOL-SEC9-[J-T]\d*$/)) {
    pathId = "tolsec8pathway";
} 
else if (graveLocation.match(/^TOL-SEC9-[A-I]\d*$/)) {
    pathId = "tolsec9pathway";
} 

else if (graveLocation.match(/^TOL-SEC10-[L-Q]\d*$/)) {
    pathId = "tolsec11pathway";
} 
else if (graveLocation.match(/^TOL-SEC10-[A-L]\d*$/)) {
    pathId = "tolsec10pathway";
} 


else if (graveLocation.match(/^TOL-SEC11-[A-D]\d*$/)) {
    pathId = "tolsec11pathway";
} 
else if (graveLocation.match(/^TOL-SEC11-[E-H]\d*$/)) {
    pathId = "tolsec13pathway";
} 


else if (graveLocation.match(/^COS-SEC4-[A-D]\d*$/)) {
    pathId = "tolsec13pathway";
} 
else if (graveLocation.match(/^COS-SEC4-[E-H]\d*$/)) {
    pathId = "cossec4pathway";
} 
else if (graveLocation.match(/^COS-SEC3-[A-Z]\d*$/)) {
    pathId = "cossec3pathway";
} 










					else if (graveLocation.startsWith("SOL-SEC1")) {
                pathId = "solacesectiion1pathway";
            } else {
                console.log("No matching path ID for graveLocation:", graveLocation);
                alert("No matching path ID for graveLocation.");
                return;
            }
            // Clear any existing path with the ID "pathway"
            var existingPath = svg.getElementById("pathway");
            if (existingPath) {
                svg.removeChild(existingPath);
            }

            var pathElement = svg.getElementById(pathId);
            if (pathElement) {
                var pathLength = pathElement.getTotalLength();
                var closestPointOnPath = pathElement.getPointAtLength(0);
                var closestLength = 0;
                var minDistance = Infinity;

                for (var i = 0; i <= pathLength; i += 1) {
                    var point = pathElement.getPointAtLength(i);
                    var distance = Math.sqrt(Math.pow(point.x - centerX, 2) + Math.pow(point.y - centerY, 2));
                    if (distance < minDistance) {
                        minDistance = distance;
                        closestPointOnPath = point;
                        closestLength = i;
                    }
                }

                var pathD = `M${pathElement.getPointAtLength(0).x},${pathElement.getPointAtLength(0).y} `;
                for (var i = 0; i <= closestLength; i += 1) {
                    var point = pathElement.getPointAtLength(i);
                    pathD += `L${point.x},${point.y} `;
                }
                pathD += `L${centerX},${centerY}`;

                console.log("Path Data (d attribute):", pathD);

                var newPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
                newPath.setAttribute("id", "pathway");
                newPath.setAttribute("d", pathD);
                newPath.setAttribute("stroke", "red");
                newPath.setAttribute("stroke-width", "2");
                newPath.setAttribute("fill", "none");
                svg.appendChild(newPath);

                var totalPathLength = newPath.getTotalLength();
                newPath.style.strokeDasharray = totalPathLength;
                newPath.style.strokeDashoffset = totalPathLength;

                newPath.animate([{
                    strokeDashoffset: totalPathLength
                }, {
                    strokeDashoffset: 0
                }], {
                    duration: 4000,
                    easing: 'linear'
                }).onfinish = function() {
                    newPath.style.strokeDashoffset = 0;
                };
            } else {
                console.log("Predefined path not found for " + pathId);
                alert("Predefined path not found.");
            }
        }


        document.getElementById("showocation").addEventListener("click", function() {
            var whiteBox = document.querySelector('.white-box p');
            if (!whiteBox) {
                alert("No grave details found.");
                return;
            }

            var detailsText = whiteBox.innerHTML;
            var graveLocation = extractGraveLocation(detailsText);

            if (graveLocation) {
                var svgContainer = document.getElementById("svgContainer");
                var svg = svgContainer.getElementsByTagName("svg")[0];
                var elements = svg.querySelectorAll("polygon, rect");
                elements.forEach(function(element) {
                    element.classList.remove("glow");
                });

                var element = svg.getElementById(graveLocation);
                if (element) {
                    element.classList.add("glow");

                    var locationIdMatch = detailsText.match(/Location ID: (.+)/);
                    if (locationIdMatch && locationIdMatch[1]) {
                        var locationId = locationIdMatch[1].trim();

                        fetchAdditionalLots(locationId)
                            .then(function(response) {
                                let lotsToHighlight = [];

                                // Check TYPE_OF_LOT and populate lotsToHighlight array accordingly
                                switch (response.TYPE_OF_LOT) {
                                    case 'court4':
                                        lotsToHighlight = [response.LOT2, response.LOT3, response.LOT4];
                                        break;
                                    case 'court8':
                                        lotsToHighlight = [response.LOT2, response.LOT3, response.LOT4, response.LOT5, response.LOT6, response.LOT7, response.LOT8];
                                        break;
                                    case 'estate12':
                                        lotsToHighlight = [
                                            response.LOT2, response.LOT3, response.LOT4, response.LOT5, response.LOT6,
                                            response.LOT7, response.LOT8, response.LOT9, response.LOT10, response.LOT11,
                                            response.LOT12
                                        ];
                                        break;
                                    case 'estate24':
                                        lotsToHighlight = [
                                            response.LOT2, response.LOT3, response.LOT4, response.LOT5, response.LOT6,
                                            response.LOT7, response.LOT8, response.LOT9, response.LOT10, response.LOT11,
                                            response.LOT12, response.LOT13, response.LOT14, response.LOT15, response.LOT16,
                                            response.LOT17, response.LOT18, response.LOT19, response.LOT20, response.LOT21,
                                            response.LOT22, response.LOT23, response.LOT24
                                        ];
                                        break;
                                    default:
                                        console.log("Unknown TYPE_OF_LOT:", response.TYPE_OF_LOT);
                                        break;
                                }

                                if (lotsToHighlight.length > 0) {
                                    highlightAdditionalLots(lotsToHighlight);
                                }

                                // Call createPath with the correct graveLocation and element
                                createPath(svg, graveLocation, element);

                                // Optionally zoom to the grave location
                                zoomToGrave(svg, element);
                            })
                            .catch(function(error) {
                                console.error("Error fetching additional lots:", error);
                            });

                    } else {
                        alert("Location ID could not be extracted.");
                    }
                } else {
                    alert("Element with grave location " + graveLocation + " not found.");
                }
            } else {
                alert("Grave location could not be extracted.");
            }
        });
    </script>


</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="customermap.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>


</html>