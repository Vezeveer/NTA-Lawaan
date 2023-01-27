<?php 
include_once 'php-components/header.php'; 

if ($_SESSION["status"] == "bo_approved") {
                            echo "<h1 class=\"display-5\">Annual Budget Plan</h1><div class=\"panel panel-default\">";
                        } else {
                            echo "<h1 class=\"display-5\">Annual Investment Plan</h1><div class=\"panel panel-default\">";
                        } 
    
    if ($_SESSION['enableContent'] or $_SESSION['userType'] == 'bdc') {
        for ($j = 0; count($projects) > $j; $j++) {
            if (isset($projects[$j])) {
                echo "
                    <a href=\"#\" class=\""; echo $_SESSION['adminAccess'] ? ($_SESSION['status'] == "bo_approved" ? "btn disabled" : "") : ($_SESSION['status'] == 'bc_finalizing' ? "" : "btn disabled"); echo "\" data-target=\"#{$projectsTrimedNames[$j]}UpdateProjectNameModal\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\"><h5 class=\"panel-heading\">";
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
        if($_SESSION['userType'] == 'bo'){

        }else{
            echo "<button id=\"btnAddProject\" type=\"button\" class=\"btn btn-primary\" data-target=\"#AddNewProject\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" "; echo $_SESSION['status']=='bo_approved' ? "disabled" : "" ; echo " >Add Project</button>";
        }
        echo "<button id=\"btnFinalizePlan\" type=\"button\" class=\"btn btn-success\" data-target=\"#FinalizeModalBack\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" "; echo $_SESSION['status']=='bo_approved' ? "disabled" : "" ; echo ">Finalize Plan</button>";
        
        if($_SESSION['userType'] == 'bdc'){
            echo "<button id=\"btnArchiveProject\" type=\"button\" class=\"btn btn-secondary\" data-target=\"#ArchiveProject\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" "; echo $_SESSION['status']=='bo_approved' ? "" : "disabled" ; echo " >Archive</button>";
        }
        
        echo "<!-- Add a modal button for sending to BO -->
        <!-- Add a modal button for BO approval -->
        <br>
        <br>
        <br>
        <br></div>";
    } else {
        exit(header("location: dashboard.php"));
    }
    
    include 'php-components/footer.php';