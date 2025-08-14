<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automated Pathway with Dynamic Redirection</title>
    <style>
        svg {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<svg id="cemeteryMap" width="800" height="600" xmlns="http://www.w3.org/2000/svg">
    <!-- Define roads in the SVG -->
    <path id="road1" d="M100,100 C200,100 300,200 400,200" stroke="black" stroke-width="2" fill="none"/>
    <path id="road2" d="M400,200 C500,200 600,300 700,300" stroke="black" stroke-width="2" fill="none"/>
    <!-- Define graves as circles -->
    <circle id="grave1" cx="450" cy="250" r="10" fill="green"/>
    <circle id="grave2" cx="300" cy="200" r="10" fill="green"/>
    <!-- Pathway that will follow the road -->
    <path id="pathway" d="" stroke="red" stroke-width="4" fill="none"/>
</svg>
<!-- Buttons to trigger different pathways -->
<button onclick="connectToGrave('grave1')">Connect to Grave 1</button>
<button onclick="connectToGrave('grave2')">Connect to Grave 2</button>
<script>
    window.onload = function() {
        // Initial setup for connecting to a default grave
        connectToGrave('grave1');
    };
    function connectToGrave(graveId) {
        // Get the road paths
        const road1 = document.getElementById('road1');
        const road2 = document.getElementById('road2');
        const grave = document.getElementById(graveId);
        const pathway = document.getElementById('pathway');
        // Get the grave coordinates
        const graveX = grave.getAttribute('cx');
        const graveY = grave.getAttribute('cy');
        // Create a new path up to the point closest to the grave on the road
        let pathData = `M100,100`;
        // Get road1 path segment up to the closest point to the grave
        const road1Length = road1.getTotalLength();
        let closestPointOnRoad1 = road1.getPointAtLength(road1Length);
        for (let i = 0; i <= road1Length; i += 1) {
            const point = road1.getPointAtLength(i);
            if (getDistance(point, grave) < getDistance(closestPointOnRoad1, grave)) {
                closestPointOnRoad1 = point;
            }
        }
        // If the closest point on road1 is close to the grave, cut the path there and connect to the grave
        if (getDistance(closestPointOnRoad1, grave) < 50) {
            pathData += ` L${closestPointOnRoad1.x},${closestPointOnRoad1.y} L${graveX},${graveY}`;
        } else {
            // Otherwise, continue along road2 before connecting
            pathData += ` C200,100 300,200 ${closestPointOnRoad1.x},${closestPointOnRoad1.y}`;
            const road2Length = road2.getTotalLength();
            let closestPointOnRoad2 = road2.getPointAtLength(road2Length);
            for (let i = 0; i <= road2Length; i += 1) {
                const point = road2.getPointAtLength(i);
                if (getDistance(point, grave) < getDistance(closestPointOnRoad2, grave)) {
                    closestPointOnRoad2 = point;
                }
            }
            pathData += ` L${closestPointOnRoad2.x},${closestPointOnRoad2.y} L${graveX},${graveY}`;
        }
        // Set the new path data to the pathway element
        pathway.setAttribute('d', pathData);
        // Animate the pathway
        const length = pathway.getTotalLength();
        pathway.style.strokeDasharray = length;
        pathway.style.strokeDashoffset = length;
        pathway.animate([
            { strokeDashoffset: length },
            { strokeDashoffset: 0 }
        ], {
            duration: 4000,
            easing: 'linear'
        });
    }
    function getDistance(point, grave) {
        const graveX = parseFloat(grave.getAttribute('cx'));
        const graveY = parseFloat(grave.getAttribute('cy'));
        return Math.sqrt(Math.pow(point.x - graveX, 2) + Math.pow(point.y - graveY, 2));
    }
</script>
</body>
</html>
