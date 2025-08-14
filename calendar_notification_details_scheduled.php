<?php
include 'dbconnection.php';
$interment_id = isset($_GET['interment_id']) ? intval($_GET['interment_id']) : 0;
$account_id = isset($_GET['account_id']) ? intval($_GET['account_id']) : 0;
if ($interment_id > 0) {
    $query = "SELECT * FROM interment_forms WHERE INTERMENTFORM_ID = $interment_id";
    $result = $conn->query($query);
    $details = $result->fetch_assoc();
    if ($details) {
        $transaction_query = "SELECT INVOICE_FILE FROM tbl_transaction WHERE ORDER_ID = $interment_id";
        $transaction_result = $conn->query($transaction_query);
        $transaction = $transaction_result->fetch_assoc();
        $invoice_file = $transaction['INVOICE_FILE'] ?? '';
        echo "<table class='interment-details-table-header'>";
        echo "<tr><th colspan='2' style='text-align: center;'>Interment Details</th></tr>";
        echo "</table>";
        echo "<table class='interment-details-table-top'>";
        echo "<tr><td style='text-align: right; color: #266529;'><strong>ID:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['INTERMENTFORM_ID']) . "</td></tr>";
        echo "<tr><td style='text-align: right; color: #266529;'><strong>Date:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['DATE_OF_INTERMENT']) . "</td></tr>";
        echo "<tr><td style='text-align: right; color: #266529;'><strong>Time:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['TIME']) . "</td></tr>";
        echo "</table>";
        echo "<table class='interment-details-table'>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Deceased Name:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['FIRSTNAME']) . ' ' . htmlspecialchars($details['MIDDLENAME']) . ' ' . htmlspecialchars($details['LASTNAME']) . "</td></tr>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Funeral Service:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['FUNERAL_SERVICE']) . "</td></tr>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Remains Type:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['REMAINS_TYPE']) . "</td></tr>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Vault Type:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['VAULT_TYPE']) . "</td></tr>";
        echo "<tr><td style='text-align: left; color: #266529;'><strong>Special Instructions:</strong></td><td style='border-bottom: 1px solid #328636;'>" . htmlspecialchars($details['SPECIAL_INSTRUCTIONS']) . "</td></tr>";
        echo "<tr>";
        echo "<td style='text-align: left; color: #266529;'><strong>More Details:</strong></td>";
        echo "<td style='border-bottom: 1px solid #328636;'>";
        echo "<a class=moredetails href='notification_intermentdetails.php?id=" . $details['INTERMENTFORM_ID'] . "&account_id=" . $account_id . "' style='text-decoration: none; color: #eeeef2;'>Click for more details</a>";
        echo "</td>";
        echo "</tr>";
        if ($invoice_file) {
            echo "<tr><td style='text-align: left; color: #266529;'><strong>Interment Order Form:</strong></td>";
            echo "<td style='border-bottom: 1px solid #328636;'><a href='" . htmlspecialchars($invoice_file) . "' target='_blank' class='document-link'><ion-icon name='document'></ion-icon></a></td></tr>";
        }
        echo "</table>"; ?>
<div class="buttonbg">
    <form action="calendar_mark_as_done.php" method="POST">
        <input type="hidden" name="interment_id" value="<?php echo htmlspecialchars($details['INTERMENTFORM_ID']); ?>">
        <button type="submit" class="btnLogin-popup">Mark as Done</button>
    </form>
    <!-- <button type="button" class="btnLogin-popup1"></button> -->
    <form action="<?php echo 'calendar_reschedule.php?id=' . $details['INTERMENTFORM_ID'] . '&account_id=' . $account_id; ?>" method="POST">
        <button type="submit" class="btnLogin-popup">Reschedule</button>
    </form>
</div>
<?php
    } else {
        echo "<p>No details found for this intermentssss.</p>";
    }
} else {
    echo "<p>Invalid interment ID.</p>";
}
?>
