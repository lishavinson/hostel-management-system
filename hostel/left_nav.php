<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><?php echo $_COOKIE['hoa_username']; ?></a>
                <a class="navbar-brand hidden" href="./">Hostel</a>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_hostelrooms.php" || basename($_SERVER['PHP_SELF'])=="manage_hostelrooms.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_hostelrooms.php"> <i class="menu-icon fa fa-tag"></i>Hostel Rooms</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_hostelroombeds_step_1.php" || basename($_SERVER['PHP_SELF'])=="list_hostelroombeds_step_2.php" || basename($_SERVER['PHP_SELF'])=="manage_hostelroombeds.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_hostelroombeds_step_1.php"> <i class="menu-icon fa fa-tag"></i>Room Beds</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_admissionregister.php" || basename($_SERVER['PHP_SELF'])=="manage_admissionregister.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_admissionregister.php"> <i class="menu-icon fa fa-tag"></i>Admission Register</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_inout.php" ){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_inout.php"> <i class="menu-icon fa fa-tag"></i>IN / OUT Register</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_hostelalerts.php" || basename($_SERVER['PHP_SELF'])=="manage_hostelalerts.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_hostelalerts.php"> <i class="menu-icon fa fa-tag"></i>Alerts</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_feedbacks.php" || basename($_SERVER['PHP_SELF'])=="list_readfeedback.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_feedbacks.php"> <i class="menu-icon fa fa-tag"></i>Feedbacks</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="manage_attandance_date.php" || basename($_SERVER['PHP_SELF'])=="list_attendance.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="manage_attandance_date.php"> <i class="menu-icon fa fa-tag"></i>Attendance</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="manage_bill.php" || basename($_SERVER['PHP_SELF'])=="list_bill.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="manage_bill.php"> <i class="menu-icon fa fa-tag"></i>Prepare Hostel Bill</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_attendance_report_step_1.php" 
					|| basename($_SERVER['PHP_SELF'])=="list_attendance_report_step_2.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_attendance_report_step_1.php"> <i class="menu-icon fa fa-tag"></i>Attendance Report</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_bill_1.php" 
					|| basename($_SERVER['PHP_SELF'])=="list_bill_collection.php"
					|| basename($_SERVER['PHP_SELF'])=="list_bill_balance.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_bill_1.php"> <i class="menu-icon fa fa-tag"></i>Hostel Bill Reports</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_in_report.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_in_report.php"> <i class="menu-icon fa fa-tag"></i>IN Students Report</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_out_report.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_out_report.php"> <i class="menu-icon fa fa-tag"></i>OUT Students Report</a>
                    </li>
					<li>
                        <a href="../logout_process.php"> <i class="menu-icon fa fa-tag"></i>Logout</a>
                    </li>
				</ul>
            </div>
        </nav>
    </aside>