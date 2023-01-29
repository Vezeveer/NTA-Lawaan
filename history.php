<?php 
include_once 'php-components/header.php'; 
$yearH = $_GET['year'];
$items = getItems($conn, "year_" . $_GET['year']);
if ($items == '') {

} else {
    // get project names
    for ($i = 0; count($items) > $i; $i++) {
        array_push($projects, $items[$i]['project']);
    }

    $projects = array_values(array_unique($projects));
    echo "<script>console.log('{$projects[0]}')</script>";
    // get trimmed project names for ID html placement
    for ($i = 0; count($projects) > $i; $i++) {
        array_push($projectsTrimedNames, str_replace(' ', '', $projects[$i]));
    }
}
echo "<!-- MAIN -->
<div class=\"col p-4 overflow-auto\" id=\"main-content\">";
echo "<h1 class=\"display-5\">Annual Budget Plan {$yearH}</h1><div class=\"panel panel-default\">";
    
    
        for ($j = 0; count($projects) > $j; $j++) {
            if (isset($projects[$j])) {
                echo "
                <div class=\"card text-center\">
                    <div class=\"card-header\">
                        <ul class=\"nav nav-tabs card-header-tabs\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link active\" href=\"#\">Table</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"#\">Graph</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link disabled\" href=\"#\">Bar</a>
                        </li>
                        </ul>
                    </div>
                    <div class=\"card-body\">";
                    // Table Title Starts
                    echo "<a href=\"#\" class=\"card-title ";
                    echo $_SESSION['adminAccess'] ? ($_SESSION['status'] == "bo_approved" ? "btn disabled" : ($_SESSION['status'] == "pending_bo_approval" ? "btn disabled" : "")) : ($_SESSION['status'] == 'bc_finalizing' ? "" : "btn disabled");
                    echo "\" data-target=\"#{$projectsTrimedNames[$j]}UpdateProjectNameModal\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\"><h5 class=\"panel-heading\">";
                    echo "$projects[$j]</h5></a>";
                    // Table Title Ends
                    echo "
                    <div class=\"panel-body card-text\">
                        <div class=\"table-responsive\">
                            <table id=\"";
                echo $projectsTrimedNames[$j];
                echo "\"";
                echo " class=\"table table-bordered table-striped display nowrap\" width=\"100%\">
                                <thead>
                                    <tr>
                                        <th>ID</th>
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
                                        <th>Project</th>
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
                                        <th colspan=\"4\" style=\"text-align:right\">Total:></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    ";
                    echo "</div>
                </div>
                <br>";
            }
        }
        echo "<br>";
        echo "<hr>";
        echo "<button id=\"btnDeletePlan\" type=\"button\" class=\"btn btn-danger\" data-target=\"#DeletePlan\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" ";
        echo " >Delete Plan</button>";
        echo "<br><br><br>";
    
    include 'php-components/footer.php'; ?>

<!-- DELETE PLAN PROMPT.modal -->
<div class="modal fade" id="DeletePlan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure you want to delete this plan?</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" <?php echo "action=\"/includes1/delete_plan.php?year={$_GET['year']}\"" ?>>
                        <div class="form-group">
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="newProject()">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> 
            </div> -->
            </div>
        </div>
    </div>