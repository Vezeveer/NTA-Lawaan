<?php
	include_once 'header.php';
    include_once 'includes/databasehandler.inc.php';
    include_once 'includes/functions.inc.php';

    $aipRefCode;
	if($_SESSION["usersname"] == null){
		header("location: index.php");
		exit();
	} else {
        $aipRefCode = getItems($conn);
    }

    
?>
	<!-- TO DO's -->
    <!-- Create database with year 2016 -->
	<!-- Create fake items for show -->
    <!-- When entering main.php, get items form db and show them -->
    <!-- When there are no projects, click new project allow to type in name -->
    <!-- Allow fields to be edited and saved to db -->

	<div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">[Options/Search]<div id="sidebarToggleContainer"><span class="tooltiptext">hide/show</span><button class="btn" id="sidebarToggle"><img src="img/CaretLeft.svg"/></button></div></div>
                
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">2016</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">2017</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">2018</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <h2>National Tax Allocation Management and Information</h2>
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="../includes/logout.inc.php">Logout</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" href="#!">Link</a></li> -->
                                <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../includes/logout.inc.php">Logout</a>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid" id="content-main">
                    <h1 class="mt-4">2016</h1>
                    <h6>Health and Sanitation Services</h6>
                    <table id="table1">
                        <tr>
                            <th><input type="checkbox" id="checkAll" onclick="showItemOptions()"><span class="resize-handle"></span></th>
                            <th data-type="text-short">AIP Reference Code<span class="resize-handle"></span></th>
                            <th data-type="text-short">Activity Description<span class="resize-handle"></span></th>
                            <th data-type="text-short">Implementing Office<span class="resize-handle"></span></th>
                            <th data-type="text-short">Start Date<span class="resize-handle"></span></th>
                            <th data-type="text-short">End Date<span class="resize-handle"></span></th>
                            <th data-type="text-short">Expected Output<span class="resize-handle"></span></th>
                            <th data-type="text-short">Funding Services<span class="resize-handle"></span></th>
                            <th data-type="text-short">Personal Services<span class="resize-handle"></span></th>
                            <th data-type="text-short">Maintenance & Other Operating Expenses<span class="resize-handle"></span></th>
                            <th data-type="text-short">Capital Outlay<span class="resize-handle"></span></th>
                            <th data-type="text-short">Total<span class="resize-handle"></span></th>
                        </tr>

                        <?php 
                            for($i = 0; count($aipRefCode) > $i; $i++){
                                echo "<tr>
                                <td><input type=\"checkbox\" name=\"item1\" value=\"item1\"></td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['aipRefCode']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['activityDescription']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['implementingOffice']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['startDate']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['endDate']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['expectedOutput']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['fundingServices']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['personalServices']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['maintAndOtherOperatingExpenses']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['capitalOutlay']}</td>
                                <td data-type=\"text-short\">{$aipRefCode[$i]['total']}</td>
                            </tr>";
                            }
                        ?>
                        <tr>
                            <td><input type="checkbox" disabled></td>
                            <td>
                                <form action="/" onsubmit="AddRow()">
                                    <input type="text" name="firstname" placeholder="+Add Item">
                                </form>
                            </td>
                        </tr>
                    </table>
                    <!-- <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
                    <p>
                        Make sure to keep all page content within the
                        <code>#page-content-wrapper</code>
                        . The top navbar is optional, and just for demonstration. Just create an element with the
                        <code>#sidebarToggle</code>
                        ID which will toggle the menu when clicked.
                    </p> -->
                    <div class="addNewProj"><button onclick="newProject()">+ Add New Project/Program</button></div>
                </div>
                
                <div id="itemOptionsContainer">
                    <p class="itemsSelected">1</p>
                    <p class="itemsSelectedTxt">Items Selected</p>
                    <div>
                        <a href="#"><img src="img/xls.svg" /></a>
                        <p>Export</p>
                    </div>
                    <div>
                        <a href="#"><img src="img/printer.svg" /></a>
                        <p>Print</p>
                    </div>
                    <div>
                        <a href="#"><img src="img/trash.svg" /></a>
                        <p>Delete</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/sidebar.js"></script>

	<?php
		if(isset($_SESSION["usersname"])){
			echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
		}
	?>

    

<?php
	include_once 'footer.php';
?>