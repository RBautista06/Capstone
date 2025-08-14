<?php
include 'dbconnection.php';
$interment_id = isset($_GET['interment_id']) ? intval($_GET['interment_id']) : 0;
$account_id = isset($_GET['account_id']) ? intval($_GET['account_id']) : 0;
if ($interment_id > 0) {
    // First query to get interment details
    $query = "SELECT * FROM transfer_of_rights WHERE ID = $interment_id";
    $result = $conn->query($query);
    $details = $result->fetch_assoc();
    if ($details) {
        // Fetch the invoice file from tbl_transactions
        $transaction_query = "SELECT TOR_PDF FROM transfer_of_rights WHERE ID = $interment_id";
        $transaction_result = $conn->query($transaction_query);
        $transaction = $transaction_result->fetch_assoc();
        $invoice_file = $transaction['TOR_PDF'] ?? ''; // Use an empty string if no invoice file is found
        // Display interment details in tables
        echo "<table class='interment-details-table-header'>";
        echo "<tr><th colspan='2' style='text-align: center;'>Transfer Of Rights Details</th></tr>";
        echo "</table>";
        echo "<table class='interment-details-table-top'>";
        echo "<tr><td style='text-align: right; color: #266529;'><strong>TOR ID:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['ID']) . "</td></tr>";
        echo "<tr><td style='text-align: right; color: #266529;'><strong>Date of Transfer:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['DATE_OF_TRANSFER']) . "</td></tr>";
        echo "<tr><td style='text-align: right; color: #266529;'><strong>Time if Transfer:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['TIME_OF_TRANSFER']) . "</td></tr>";
        echo "</table>";
        echo "<table class='interment-details-table'>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Transferor Name:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['TRANSFEROR_NAME'])."</td></tr>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Transferee Name</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['TRANSFEREE_NAME']) . "</td></tr>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Contract Number:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['LOCATION_ID']) . "</td></tr>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Type of Lot:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['TYPE_OF_LOT']) . "</td></tr>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Lot Description:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['LOT_DESCRIPTION']) . "</td></tr>";
        // Clickable row for more details
        echo "<tr>";
        echo "<td style='text-align: left; color: #266529;'><strong>More Details:</strong></td>";
        echo "<td style='border-bottom: 1px solid #328636;'>";
        echo "<a class=moredetails href='notification_intermentdetails.php?id=" . $details['ID'] . "&account_id=" . $account_id . "' style='text-decoration: none; color: #eeeef2;'>Click for more details</a>";
        echo "</td>";
        echo "</tr>";
        // Invoice link, if available
        if ($invoice_file) {
            echo "<tr><td style='text-align: left; color: #266529;'><strong>Transfer of Right Details:</strong></td>";
            echo "<td style='border-bottom: 1px solid #328636;'><a href='" . htmlspecialchars($invoice_file) . "' target='_blank' class='document-link'><ion-icon name='document'></ion-icon></a></td></tr>";
        }
        echo "</table>"; ?>
<?php
    } else {
        echo "<p>No details found for this interment.</p>";
    }
} else {
    echo "<p>Invalid interment ID.</p>";
}
?>
