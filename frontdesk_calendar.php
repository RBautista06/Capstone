<?php
include 'dbconnection.php';
// Function to retrieve account details
function getAccount($conn, $account_id) {
    $query = "SELECT * FROM tbl_accounts WHERE ACCOUNT_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $account = $result->fetch_assoc();
    $stmt->close();
    return $account;
}
function getNotifications($conn, $year, $month) {
    // Query for interment forms with "Mark as Done" or "Scheduled" status
    $stmt1 = $conn->prepare("
        SELECT 'interment' as type, INTERMENTFORM_ID as ID, DATE_OF_INTERMENT as date, STATUS
        FROM interment_forms
        WHERE YEAR(DATE_OF_INTERMENT) = ?
        AND MONTH(DATE_OF_INTERMENT) = ?
        AND (STATUS = 'Mark as Done' OR STATUS = 'Scheduled')
    ");
    $stmt1->bind_param("ii", $year, $month);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $interment_notifications = $result1->fetch_all(MYSQLI_ASSOC);
    $stmt1->close();
    // Query for transfer of rights with "Mark as Done" or "Scheduled" status
    $stmt2 = $conn->prepare("
        SELECT 'transfer' as type, ID, DATE_OF_TRANSFER as date, STATUS
        FROM transfer_of_rights
        WHERE YEAR(DATE_OF_TRANSFER) = ?
        AND MONTH(DATE_OF_TRANSFER) = ?
        AND (STATUS = 'Mark as Done' OR STATUS = 'Scheduled')
    ");
    $stmt2->bind_param("ii", $year, $month);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $transfer_notifications = $result2->fetch_all(MYSQLI_ASSOC);
    $stmt2->close();
    // Merge both sets of notifications
    $notifications = array_merge($interment_notifications, $transfer_notifications);
    return $notifications;
}
// Retrieve account details if 'Id' is present
$account_id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;
$account = null;
if ($account_id > 0) {
    $account = getAccount($conn, $account_id);
    if (!$account) {
        echo json_encode(['error' => 'Account not found.']);
        exit;
    }
}
// Retrieve notifications if 'year' and 'month' are present
$currentYear = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$currentMonth = isset($_GET['month']) ? intval($_GET['month']) : date('n'); // Use month directly (1-12)
// Ensure month is within valid range
if ($currentMonth < 1 || $currentMonth > 12) {
    $currentMonth = date('n');
}
// Check if the request is AJAX
if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
    header('Content-Type: application/json');
    $notifications = getNotifications($conn, $currentYear, $currentMonth);
    echo json_encode($notifications);
    exit;
}
// Retrieve notifications for the current month and year
$notifications = getNotifications($conn, $currentYear, $currentMonth);
// Close the connection
$conn->close();
?>
<?php
if (isset($_GET['success'])) {
    echo "<script>alert('" . htmlspecialchars($_GET['success']) . "');</script>";
} elseif (isset($_GET['error'])) {
    echo "<script>alert('" . htmlspecialchars($_GET['error']) . "');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Frontdesk Calendar</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="frontdesk_calendar.css">
</head>
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
<!-- <model-viewer id="myModelViewer" src="3dmodels/statsprovidence.gltf" alt="A 3D model of a walking character"
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5"
    class="stats3dlogo" camera-orbit="120deg 83deg 10m">
</model-viewer> -->
<body>
<?php
include "frontdeskaside.php";
?>
<div class="internmentform">
<h1><img src="pictures/providencecalendar.png" alt=""></h1>
<div class="detailstable">
<div class="white-box" id="details-box">
    <div class="close-button" onclick="closeDetailsBox()">✖</div>
    <div class="details" id="details-content"></div>
</div>
<div id="month-selector">
    <button onclick="changeMonth(-1)">Previous</button>
    <select id="month-dropdown"></select>
    <button onclick="changeMonth(1)">Next</button>
</div>
<div id="calendar-container"></div>
</div>
</div>
<!-- calendar  script-->
<script>
    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    let currentDateInPhilippines = new Date();
    let currentYear = currentDateInPhilippines.getFullYear();
    let currentMonth = currentDateInPhilippines.getMonth(); // JS month is 0-indexed
    let notifications = <?php echo json_encode($notifications); ?>;
    let accountId = <?php echo json_encode($account_id); ?>; // Retrieve account_id from PHP
    function populateMonthDropdown() {
        const monthDropdown = document.getElementById('month-dropdown');
        monthDropdown.innerHTML = '';
        months.forEach((month, index) => {
            const option = document.createElement('option');
            option.value = index;
            option.textContent = month;
            if (index === currentMonth) option.selected = true;
            monthDropdown.appendChild(option);
        });
        monthDropdown.addEventListener('change', () => {
            currentMonth = parseInt(monthDropdown.value);
            updateCalendar(); // Fetch notifications for the selected month
        });
    }
    function generateCalendar(year, month) {
    const calendarContainer = document.getElementById('calendar-container');
    calendarContainer.innerHTML = '';
    const table = document.createElement('table');
    const caption = document.createElement('caption');
    caption.textContent = `${months[month]} ${year}`;
    table.appendChild(caption);
    const headerRow = document.createElement('tr');
    daysOfWeek.forEach(day => {
        const th = document.createElement('th');
        th.textContent = day;
        headerRow.appendChild(th);
    });
    table.appendChild(headerRow);
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    let row = document.createElement('tr');
    for (let i = 0; i < firstDay; i++) {
        row.appendChild(document.createElement('td'));
    }
    for (let day = 1; day <= daysInMonth; day++) {
        if (row.children.length === 7) {
            table.appendChild(row);
            row = document.createElement('tr');
        }
        const cell = document.createElement('td');
        cell.className = 'day';
        cell.textContent = day;
        const today = new Date();
        if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
            cell.classList.add('today');
        }
        const notificationContainer = document.createElement('div');
        notificationContainer.className = 'notification-container';
        cell.appendChild(notificationContainer);
        const notificationDate = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
        notifications.forEach(notification => {
            if (notification.date === notificationDate) {
                const notificationDiv = document.createElement('div');
                notificationDiv.className = 'notification';
                // Distinguish between interment and transfer notifications
                if (notification.type === 'interment') {
        if (notification.STATUS.trim().toLowerCase() === 'mark as done') {
            notificationDiv.classList.add('done-notification');
        }
        notificationDiv.textContent = `Interment ID: ${notification.ID}`;
        // Pass the notification type and status to showDetailsBox
        notificationDiv.addEventListener('click', function() {
            showDetailsBox(notification.ID, accountId, notification.STATUS, null, 'interment');
        });
    } else if (notification.type === 'transfer') {
        // Check the status for transfer notifications
        if (notification.STATUS.trim().toLowerCase() === 'mark as done') {
            notificationDiv.classList.add('done-notification'); // Use a different class for "mark as done"
        } else {
            notificationDiv.classList.add('transfer-notification'); // Default class for scheduled
        }
        notificationDiv.textContent = `Transfer ID: ${notification.ID}`;
        // Pass the notification type and transfer status to showDetailsBox
        notificationDiv.addEventListener('click', function() {
            showDetailsBox(notification.ID, accountId, null, notification.STATUS, 'transfer');
        });
    }
                notificationDiv.setAttribute('data-id', notification.ID);
                // Add event listener for the click to show details
                notificationDiv.addEventListener('click', function() {
                    showDetailsBox(notification.ID, accountId, notification.STATUS, notification.type);
                });
                // Append the notification to the container
                notificationContainer.appendChild(notificationDiv);
            }
        });
        row.appendChild(cell);
    }
    while (row.children.length < 7) {
        row.appendChild(document.createElement('td'));
    }
    table.appendChild(row);
    calendarContainer.appendChild(table);
}
    function changeMonth(direction) {
        currentMonth += direction;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        } else if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        updateCalendar();
    }
    function updateCalendar() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `frontdesk_calendar.php?year=${currentYear}&month=${currentMonth + 1}&ajax=true&Id=${encodeURIComponent(accountId)}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    notifications = JSON.parse(xhr.responseText);
                    generateCalendar(currentYear, currentMonth);
                    document.getElementById('month-dropdown').value = currentMonth;
                    window.history.pushState(null, '', `frontdesk_calendar.php?Id=${encodeURIComponent(accountId)}&year=${currentYear}&month=${currentMonth + 1}`);
                } catch (e) {
                    console.error('Failed to parse JSON response:', e);
                    console.error('Response:', xhr.responseText);
                }
            } else {
                console.error('Failed to fetch notifications. Status:', xhr.status);
            }
        };
        xhr.onerror = function() {
            console.error('An error occurred while sending the AJAX request.');
        };
        xhr.send();
    }
    function showDetailsBox(notificationId, accountId, status = null, transferStatus = null, notificationType = '') {
    let phpFile;
    // Check based on notification type
    if (notificationType === 'transfer') {
        // Handle transfer notifications
        if (transferStatus) {
            if (transferStatus.toLowerCase() === 'mark as done') {
                phpFile = 'transfer_rights_notification_done.php';
            } else if (transferStatus.toLowerCase() === 'scheduled') {
                phpFile = 'transfer_rights_notification_scheduled.php';
            } else {
                console.error('Unrecognized transfer status:', transferStatus);
                return;
            }
        } else {
            console.error('No valid transfer status provided.');
            return;
        }
    } else if (notificationType === 'interment') {
        // Handle interment notifications
        if (status) {
            if (status.toLowerCase() === 'mark as done') {
                phpFile = 'calendar_notification_details_done.php';
            } else if (status.toLowerCase() === 'scheduled') {
                phpFile = 'calendar_notification_details_scheduled.php';
            } else {
                console.error('Unrecognized interment status:', status);
                return;
            }
        } else {
            console.error('No valid interment status provided.');
            return;
        }
    } else {
        console.error('Unrecognized notification type:', notificationType);
        return;
    }
    // Send the AJAX request to the appropriate PHP file
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${phpFile}?interment_id=${notificationId}&account_id=${accountId}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const detailsContent = document.getElementById('details-content');
            detailsContent.innerHTML = xhr.responseText;
            const detailsBox = document.getElementById('details-box');
            detailsBox.style.display = 'block';
            void detailsBox.offsetWidth;
            detailsBox.classList.add('show');
        } else {
            console.error('Failed to fetch notification details. Status:', xhr.status);
        }
    };
    xhr.onerror = function() {
        console.error('An error occurred while fetching notification details.');
    };
    xhr.send();
}
function closeDetailsBox() {
    const detailsBox = document.getElementById('details-box');
    detailsBox.classList.remove('show');
    setTimeout(() => {
        detailsBox.style.display = 'none';
    }, 300);
}
    populateMonthDropdown();
    updateCalendar();  // Fetch notifications and generate calendar on initial load
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.49.1/apexcharts.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>
