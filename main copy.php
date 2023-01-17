<?php
	include_once 'header.php';
    include_once 'includes/databasehandler.inc.php';
    include_once 'includes/functions.inc.php';

    $aipRefCode;
    $year = "year_2017"; //placeholder data, to be redefined
    
	if($_SESSION["usersname"] == null){
		header("location: index.php");
		exit();
	} else {
        $aipRefCode = getItems($conn, $year);
    }

    // get project names
    $projects = array();
    for($i = 0; count($aipRefCode) > $i; $i++){
        array_push($projects, $aipRefCode[$i]['project']);
    }
    $projects = array_values(array_unique($projects));

    
?>
	<!-- TO DO's -->
    <!-- Create database with year 2016 -->
	<!-- Create fake items for show -->
    <!-- When entering main.php, get items form db and show them -->
    <!-- When there are no projects, click new project allow to type in name -->
    <!-- Allow fields to be edited and saved to db -->

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
                <a class="nav-link" href="#top">Finalize <span class="sr-only">(current)</span></a>
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
                    <a class="dropdown-item" href="#top">hjsahgjsa</a>
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
                    <span class="fa fa-dashboard fa-fw mr-3"></span>
                    <span class="menu-collapsed">Dashboard</span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Chahgag</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Reports</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Tables</span>
                </a>
            </div>
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-history fa-fw mr-3"></span>
                    <span class="menu-collapsed">History</span>
                    <span class="submenu-icon ml-auto"></span>
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
                    <span class="fa fa-envelope-o fa-fw mr-3"></span>
                    <span class="menu-collapsed">Search <span class="badge badge-pill badge-primary ml-2">..</span></span>
                </div>
            </a>
            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Other</span>
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
        <h1 class="display-5">Active Budget</h1>
        <div class="card" id="content-main">
        <?php
            for($j = 0; count($projects) > $j; $j++){
                if(isset($projects[$j])){
                echo "
                <h5 class=\"card-header font-weight-light\">"; echo $projects[$j]; echo "</h5>
                <div class=\"card-body\">
                    <div class=\"container-fluid\">
                        <table id=\"\" class=\"project-table table table-striped table-bordered table-sm\" cellspacing=\"0\"width=\"100%\">
                            <thead>
                                <tr>
                                    <th><input type=\"checkbox\" id=\"checkAll\" onclick=\"showItemOptions()\"></th>
                                    <th class=\"text-center text-nowrap align-middle\">AIP Reference Code</th>
                                    <th class=\"align-middle text-nowrap\">Activity Description</th>
                                    <th class=\"align-middle text-nowrap\">Implementing Office</th>
                                    <th class=\"align-middle text-nowrap\">Start Date</th>
                                    <th class=\"align-middle text-nowrap\">End Date</th>
                                    <th >Expected Output</th>
                                    <th >Funding Services</th>
                                    <th >Personal Services</th>
                                    <th class=\"align-middle text-nowrap\">Maintenance & Other Operating Expenses</th>
                                    <th >Capital Outlay</th>
                                    <th >Total</th>
                                    <th >ID</th>
                                </tr>
                            </thead>

                            
                            
                            <tbody >";
                            for($i = 0; count($aipRefCode) > $i; $i++){
                                if($projects[$j] == $aipRefCode[$i]['project']){
                                echo "
                                <tr class=\"project-d-row\">
                                    <td><input type=\"checkbox\" name=\"item1\" value=\"item1\"></td>
                                    <td >{$aipRefCode[$i]['aipRefCode']}</td>
                                    <td >{$aipRefCode[$i]['activityDesc']}</td>
                                    <td >{$aipRefCode[$i]['impOffice']}</td>
                                    <td class=\"align-middle text-nowrap\">{$aipRefCode[$i]['startDate']}</td>
                                    <td class=\"align-middle text-nowrap\">{$aipRefCode[$i]['endDate']}</td>
                                    <td >{$aipRefCode[$i]['expectedOutput']}</td>
                                    <td >{$aipRefCode[$i]['fundingServices']}</td>
                                    <td >{$aipRefCode[$i]['personalServices']}</td>
                                    <td >{$aipRefCode[$i]['maint']}</td>
                                    <td >{$aipRefCode[$i]['capitalOutlay']}</td>
                                    <td >{$aipRefCode[$i]['total']}</td>
                                    <td >{$aipRefCode[$i]['id']}</td>
                                </tr>
                            ";}
                            }
                        
                            echo "
                                <tr>
                                    <td><input type=\"checkbox\" disabled></td>
                                    <td>
                                        <form id=\"add-item-input-f\" action=\"/\">
                                            <input type=\"text\" name=\"aipRefCode\" placeholder=\"+Add Item\">
                                        </form>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                ";}
            }
            ?>
        </div>
        <button id="btnAddProject" type="button" class="btn btn-primary" data-target="#MymodalBack" data-toggle="modal" data-backdrop="static" data-keyboard="false">Add Project</button>
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
    </div><!-- Main Col END -->
</div><!-- body-row END -->

	<!-- <?php
		if(isset($_SESSION["usersname"])){
			echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
		}
	?> -->

    

<?php
	include_once 'footer.php';
?>