<?php
include_once 'header.php';
include_once 'includes/databasehandler.inc.php';
include_once 'includes/functions.inc.php';

$projectsTrimedNames = array();
$aipRefCode;
$year = "year_2017"; //placeholder data, to be redefined

if ($_SESSION["usersname"] == null) {
    header("location: index.php");
    exit();
} else {
    $aipRefCode = getItems($conn, $year);
}

// get project names
$projects = array();
for ($i = 0; count($aipRefCode) > $i; $i++) {
    array_push($projects, $aipRefCode[$i]['project']);
}

$projects = array_values(array_unique($projects));

// get trimmed project names for ID html placement
for ($i = 0; count($projects) > $i; $i++) {
    array_push($projectsTrimedNames, str_replace(' ', '', $projects[$i]));
}
?>

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
            <li class="nav-item active">
                <a class="nav-link" href="#top">... <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#top">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#top">Pricing</a>
            </li> -->
            <!-- This menu is hidden in bigger devices with d-sm-none. 
           The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
            <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </a>
                <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                    <a class="dropdown-item" href="includes/logout.inc.php">Sign Out</a>
                    <a class="dropdown-item" href="#top">Profile</a>
                    <a class="dropdown-item" href="#top">Tasks</a>
                    <a class="dropdown-item" href="#top">Etc ...</a>
                </div>
            </li><!-- Smaller devices menu END -->
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
            <a href="#" class="bg-dark list-group-item list-group-item-action">
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
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-history fa-fw mr-3"></span>
                    <span class="menu-collapsed">History</span>
                    <span class="fa fa-caret-down ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">2016</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">2017</span>
                </a>
            </div>
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">Current</span>
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
    <!-- MAIN -->
    <div class="col p-4 overflow-auto" id="main-content">
        <h1 class="display-5">Annual Investment Plan<?php echo $_SESSION["status"]; ?></h1>
        <div class="panel panel-default">
            <?php
            for ($j = 0; count($projects) > $j; $j++) {
                if (isset($projects[$j])) {
                    echo "
                    <a href=\"#\" class=\"\" data-target=\"#{$projectsTrimedNames[$j]}UpdateProjectNameModal\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\"><h5 class=\"panel-heading\">";
                    echo $projects[$j];
                    echo "</h5></a>
                <div class=\"panel-body\">
                    <div class=\"table-responsive\">
                        <table id=\"";
                    echo $projectsTrimedNames[$j];
                    echo "\"";
                    echo " class=\"table table-bordered table-striped display nowrap\" width=\"100%\">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Project</th>
                                    <th>Approved</th>
                                    <th>AIP Reference Code</th>
                                    <th>Activity Description</th>
                                    <th>Implementing Office</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Expected Output</th>
                                    <th>Funding Services</th>
                                    <th>Personal Services</th>
                                    <th>Maintenance</th>
                                    <th>Capital Outlay</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody >";
                    echo "
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan=\"4\" style=\"text-align:right\">Total:></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <br>";
                }
            } 
            ?>

            <button id="btnAddProject" type="button" class="btn btn-primary" data-target="#MymodalBack" data-toggle="modal" data-backdrop="static" data-keyboard="false">Add Project</button>
            <button id="btnFinalizePlan" type="button" class="btn btn-success">Finalize Plan</button>
            <br>
            <br>
            <br>
            <br>
            <!-- .modal -->
            <div class="modal fade" id="MymodalBack">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Project Name</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <form method="post" <?php echo "action=\"/includes/createProject.php?year=$year\"" ?>>
                                <div class="form-group">
                                    <input type="text" name="projectName" class="form-control" id="inputProjectName" placeholder="Project Name" required>
                                    <input type="text" name="aipRefCode" class="form-control" placeholder="AIP Reference Code" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="newProject()">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> 
            </div> -->
                    </div>
                </div>
            </div>

            <!-- .modal -->
            <div class="modal fade" id="UserModalBack">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">New User</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <!-- <form method="post" <?php echo "action=\"new_user.php\"" ?>>
                                <div class="form-group">
                                    <input id="usrname" type="text" name="userName" class="form-control" placeholder="User Name" required>
                                    <input id="psw" type="password" name="userPass" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    <input id="confirm_password" type="password" name="userPass2" class="form-control" placeholder="Re-enter Password" required>
                                    <span id='message1'></span>
                                    <label for="userType">User Type:</label>
                                    <select id="userTypeSelect" name="userType">
                                    <option value="bdc" selected>Barangay Development Council</option>
                                    <option value="bc">Barangay Committee</option>
                                    <option value="bo">Budget Office</option>
                                    </select>
                                </div>
                                <div id="message">
                                    <h5>Password must contain the following:</h3>
                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                    <p id="number" class="invalid">A <b>number</b></p>
                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                </div>
                                <button id="user_submit" type="submit" class="btn btn-primary">Submit</button>
                            </form> -->

                            <form method="post" <?php echo "action=\"new_user.php\"" ?>>
                                <div class="form-group row">
                                    <label for="usrName" class="col-sm-4 col-form-label">User Name</label>
                                    <div class="col-sm-8">
                                    <input name="userName" type="text" class="form-control" id="usrName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="psw" class="col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                    <input type="password" class="form-control" id="psw" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirm_password" class="col-sm-4 col-form-label">Re-enter Password</label>
                                    <div class="col-sm-8">
                                    <input type="password" class="form-control" id="confirm_password" placeholder="Re-enter Password">
                                    <span id='message1'></span>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                    <legend class="col-form-label col-sm-4 pt-0">User Type:</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="bdc" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                        Barangay Development Council
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="bc">
                                        <label class="form-check-label" for="gridRadios2">
                                        Barangay Committee
                                        </label>
                                        </div>
                                        <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="bo">
                                        <label class="form-check-label" for="gridRadios3">
                                        Budget Office
                                        </label>
                                        </div>
                                    </div>
                                    </div>
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                    <button id="user_submit" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <div id="message" class="form-group row">
                                    <h5>Password must contain the following:</h3>
                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                    <p id="number" class="invalid">A <b>number</b></p>
                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div><!-- Main Col END -->
</div><!-- body-row END -->

<!-- <?php
        if (isset($_SESSION["usersname"])) {
            echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
        }
        ?> -->



<?php
include_once 'footer.php';
?>