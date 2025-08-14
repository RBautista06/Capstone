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
                <h4>Tabs</h4>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="bar-chart-outline"></ion-icon></span>
                    <a href="frontdeskdashboard.php?Id=<?php echo urlencode($_GET['Id']); ?>">Dashboard</a>

                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="location-outline"></ion-icon></span>
                    <a href="frontdesk_map.php?Id=<?php echo urlencode($_GET['Id']); ?>">Providence Map</a>

                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="calendar-outline"></ion-icon></span>
                    <a href="frontdesk_calendar.php?Id=<?php echo urlencode($_GET['Id']); ?>">Providence <br>Calendar</a>

                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="file-tray-stacked-outline"></ion-icon></span>
                    <a href="frontdeskintermentorder.php?Id=<?php echo urlencode($_GET['Id']); ?>">Interment Orders</a>

                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="send-outline"></ion-icon></span>
                    <a href="frondesk_transferorrights.php?Id=<?php echo urlencode($_GET['Id']); ?>">Transfer of Rights <br>Orders</a>
                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                        <a href="frontdesk_transaction.php?Id=<?php echo urlencode($_GET['Id']); ?>">
                     Transactions</a>
                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="cash-outline"></ion-icon></span>
                    <a href="frontdeskpayment.php?Id=<?php echo urlencode($_GET['Id']); ?>">Order Payments</a>

                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="cash-outline"></ion-icon></span>
                    <a href="frontdesk_reschdule_payment.php?Id=<?php echo urlencode($_GET['Id']); ?>">Reschedule Payments</a>

                </li>

                <br>

                <h4>Main-menu</h4>
                <li>
				<span class="material-symbols-outlined"><ion-icon name="settings-outline"></ion-icon></span>
                    <a href="frontdeskaccountsettings.php?Id=<?php echo urlencode($_GET['Id']); ?>">Settings</a>
                </li>
                <li class="logout-link">
				<span class="material-symbols-outlined"><ion-icon name="log-out-outline"></ion-icon></span>
                    <a href="index.php">Logout</a>
                </li>
            </ul>
        </div>
    </aside>