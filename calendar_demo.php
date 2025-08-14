<?php
include "dbconnection.php";
function getNotifications($conn, $year, $month) {
    $stmt = $conn->prepare("
        SELECT INTERMENTFORM_ID, DATE_OF_INTERMENT
        FROM interment_forms
        WHERE STATUS = ?
        AND YEAR(DATE_OF_INTERMENT) = ?
        AND MONTH(DATE_OF_INTERMENT) = ?
    ");
    $status = 'scheduled';
    $stmt->bind_param("sii", $status, $year, $month);
    $stmt->execute();
    $result = $stmt->get_result();
    $notifications = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $notifications;
}
$currentYear = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$currentMonth = isset($_GET['month']) ? intval($_GET['month']) : date('n');
if ($currentMonth < 1 || $currentMonth > 12) {
    $currentMonth = date('n');
}
if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
    header('Content-Type: application/json');
    $notifications = getNotifications($conn, $currentYear, $currentMonth);
    echo json_encode($notifications);
    exit;
}
$notifications = getNotifications($conn, $currentYear, $currentMonth);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="calendar_demo.css">
</head>
<body>
<div id="month-selector">
    <button onclick="changeMonth(-1)">Previous</button>
    <select id="month-dropdown"></select>
    <button onclick="changeMonth(1)">Next</button>
</div>
<div id="calendar-container"></div>
<script>
    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    let currentYear = <?php echo $currentYear; ?>;
    let currentMonth = <?php echo $currentMonth - 1; ?>;  // JS month is 0-indexed
    let notifications = <?php echo json_encode($notifications); ?>;
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
            updateCalendar();
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
                if (notification.DATE_OF_INTERMENT === notificationDate) {
                    const notificationDiv = document.createElement('div');
                    notificationDiv.className = 'notification';
                    notificationDiv.textContent = `Interment ID: ${notification.INTERMENTFORM_ID}`;
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
        // Update the URL and reload the page
        updateCalendar();
    }
    function updateCalendar() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `?year=${currentYear}&month=${currentMonth + 1}&ajax=true`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                notifications = JSON.parse(xhr.responseText);
                generateCalendar(currentYear, currentMonth);
                document.getElementById('month-dropdown').value = currentMonth;
                window.history.pushState(null, '', `?year=${currentYear}&month=${currentMonth + 1}`);
            }
        };
        xhr.send();
    }
    // Populate the month dropdown and generate the initial calendar
    populateMonthDropdown();
    generateCalendar(currentYear, currentMonth);
    // Debugging
    console.log('Current Year:', currentYear);
    console.log('Current Month:', currentMonth);
    console.log('Notifications:', notifications);
</script>
</body>
</html>
