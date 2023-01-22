<!-- Bootstrap NavBar -->
<nav class="navbar navbar-expand-md navbar-dark bg-success nav-bg-color">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img src="img\nta_logo_small.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <span class="menu-collapsed">NTA Lawaan</span>
    </a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-sm-block d-md-none active">
                <a class="nav-link" href="#top"><i class="fas fa-home"></i> Dashboard<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item d-sm-block d-md-none">
                <a class="nav-link" href="#top"><i class="fas fa-sign-out-alt"></i> History</a>
            </li>
            <li class="nav-item d-sm-block d-md-none">
                <a class="nav-link" href="#top"><i class="fas fa-tasks"></i> Current Plan</a>
            </li>
            <li class="nav-item d-sm-block d-md-none">
                <a class="nav-link" href="#top"><i class="fas fa-calendar"></i> Logs</a>
            </li>
            <li class="nav-item d-sm-block d-md-none">
                <a class="nav-link" href="#top"><i class="fas fa-search"></i> Search</a>
            </li>
            <li class="nav-item d-sm-block d-md-none">
                <a class="nav-link" href="#top"><i class="fas fa-user-plus"></i> Create User</a>
            </li>
            <li class="nav-item d-sm-block d-md-none">
                <a class="nav-link" href="includes/logout.inc.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#top">Pricing</a>
            </li> -->
            <!-- This menu is hidden in bigger devices with d-sm-none. 
           The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
            <!-- <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </a>
                <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                    <a class="dropdown-item" href="includes/logout.inc.php">Sign Out</a>
                    <a class="dropdown-item" href="#top">Profile</a>
                    <a class="dropdown-item" href="#top">Tasks</a>
                    <a class="dropdown-item" href="#top">Etc ...</a>
                </div>
            </li> -->
            <!-- Smaller devices menu END -->
        </ul>
    </div>
</nav><!-- NavBar END -->
<!-- Bootstrap row -->
<div class="row overflow-auto" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <img class="menu-collapsed" id="logo" src="img/nta_logo_small.png" alt="NTA Logo" srcset="">
            <?php
                if($_SESSION["userType"] == "bdc"){
                    echo "<small class=\"logo_title menu-collapsed\">Barangay Development Council</small>";
                } else if($_SESSION["userType"] == "bc"){
                    echo "<small class=\"logo_title menu-collapsed\">Barangay Committee</small>";
                } else if($_SESSION["userType"] == "bo"){
                    echo "<small class=\"logo_title menu-collapsed\">Budget Office</small>";
                }
                echo "<small class=\"logo_title menu-collapsed\"><i class=\"fas fa-user\"></i> {$_SESSION["usersname"]}</small>";
                echo "<small class=\"logo_title menu-collapsed\"><i class=\"\"></i>Status: {$_SESSION["status"]}</small>";
            ?>
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>MAIN MENU</small>
            </li>
            <!-- /END Separator -->
            <!-- Menu with submenu -->
            <!-- <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3"></span>
                    <span class="menu-collapsed">Dashboard</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a> -->
            <a href="dashboard.php" class="<?= ($activePage == 'dashboard') ? 'active_page ':''; ?> bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-columns fa-fw mr-3"></span>
                    <span class="menu-collapsed">Dashboard</span>
                </div>
            </a>
            <!-- Submenu content -->
            <!-- <div id='submenu1' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Chahgag</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Reports</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Tables</span>
                </a>
            </div> -->
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="<?php if ($page_name=="history_") {echo "active"; } else  {echo "noactive";}?> bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-history fa-fw mr-3"></span>
                    <span class="menu-collapsed">History</span>
                    <span class="fa fa-caret-down ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu">
                <?php 
                foreach($inactiveYears as $yrs){
                    echo "<a href=\"#\" class=\"list-group-item list-group-item-action bg-dark text-white\">
                    <span class=\"menu-collapsed\">{$yrs}</span>
                </a>"; 
                }?>
                
            </div>
            <a href="main.php" class="<?= ($activePage == 'main') ? 'active_page ':''; ?> bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">Current Plan</span>
                </div>
            </a>
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPTIONS</small>
            </li>
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3"></span>
                    <span class="menu-collapsed">Logs</span>
                </div>
            </a>
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-search fa-fw mr-3"></span>
                    <span class="menu-collapsed">Search <span class="badge badge-pill badge-primary ml-2">..</span></span>
                </div>
            </a>
            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action" data-target="#UserModalBack" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-user-plus fa-fw mr-3"></span>
                    <span class="menu-collapsed">Create User</span>
                </div>
            </a>
            <a href="includes/logout.inc.php" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-sign-out-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Sign Out</span>
                </div>
            </a>
            <a href="#top" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Collapse</span>
                </div>
            </a>
        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->