<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><?php echo $_COOKIE['hoa_username']; ?></a>
                <a class="navbar-brand hidden" href="./">Admin</a>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_hostels.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_hostels.php"> <i class="menu-icon fa fa-tag"></i>New Hostel Applications</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_hostels_approved.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_hostels_approved.php"> <i class="menu-icon fa fa-tag"></i>Approved Application</a>
                    </li>
					<?php
					$menuselect="";
					if(basename($_SERVER['PHP_SELF'])=="list_hostels_rejected.php"){
						$menuselect="active";
					}
					?>
                    <li class="<?php echo $menuselect; ?>">
                        <a href="list_hostels_rejected.php"> <i class="menu-icon fa fa-tag"></i>Rejected Application</a>
                    </li>
					
					<li>
                        <a href="../logout_process.php"> <i class="menu-icon fa fa-tag"></i>Logout</a>
                    </li>
				</ul>
            </div>
        </nav>
    </aside>