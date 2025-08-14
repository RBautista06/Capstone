<aside class="sidebar">
	<div class="logo">
    <?php
    if(empty($account['PROFILE'])) {
        $default_profile_photo = "defaultprofile.jpeg";
        echo '<img src="profilepics/' . $default_profile_photo . '" alt="logo">';
    } else {
        echo '<img src="profilepics/' . htmlspecialchars($account['PROFILE']) . '" alt="logo">';
    }
    ?>
    <h2><?php echo htmlspecialchars($account['LASTNAME'] . ', ' . $account['FIRSTNAME']); ?></h2>

</div>
        <div class="wrapper">
		<ul class="links">
            <ul>
                <h4>Tabs</h4>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                    <a href="customermap.php?Id=<?php echo urlencode($account_id); ?>">Providence Map</a>
                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="document-outline"></ion-icon></span>
                    <a href="intermentform.php?Id=<?php echo urlencode($account_id); ?>">Interment Form</a>

                </li>

                <li>
                    <span class="material-symbols-outlined"><ion-icon name="send-outline"></ion-icon></span>
                    <a href="transferownership.php?Id=<?php echo urlencode($account_id); ?>">Transfer Ownership</a>

                </li>
                <h4>Payment</h4>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="cash-outline"></ion-icon></span>
                    <a href="customerintermentpayment.php?Id=<?php echo urlencode($account_id); ?>">Order Payment</a>

                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="calendar-number-outline"></ion-icon></span>
                    <a href="customer_reschedule_intermentpayment.php?Id=<?php echo urlencode($account_id); ?>">Reschedule Payment</a>
                </li>
                <h4>Declined Request</h4>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="alert-outline"></ion-icon></span>
                    <a href="customer_declinedinterment.php?Id=<?php echo urlencode($account_id); ?>">Declined Orders</a>

                </li>

                <li>
                    <span class="material-symbols-outlined"><ion-icon name="file-tray-full-outline"></ion-icon></span>
                    <a href="customertransaction.php?Id=<?php echo urlencode($account_id); ?>">My Transactions</a>

                </li>
                <h4>Main-menu</h4>
                <li>
				<span class="material-symbols-outlined"><ion-icon name="settings-outline"></ion-icon></span>
                    <a href="accountsettings.php?Id=<?php echo urlencode($account_id); ?>">Settings</a>
                </li>
                <li class="logout-link">
				<span class="material-symbols-outlined"><ion-icon name="log-out-outline"></ion-icon></span>
                    <a href="index.php">Logout</a>
                </li>
            </ul>
        </div>
    </aside>