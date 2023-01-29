<?php
include_once 'php-components/header.php';
$items = getItems($conn, "year_" . $activeYear);
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
if ($_SESSION["status"] == "bo_approved") {
    echo "<h1 class=\"display-5\">Annual Budget Plan {$activeYear}</h1><div class=\"panel panel-default\">";
} else {
    echo "<h1 class=\"display-5\">Annual Investment Plan {$activeYear}</h1><div class=\"panel panel-default\">";
}

if ($_SESSION['enableContent'] or $_SESSION['userType'] == 'bdc') {
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
    echo "<hr>";
    if ($_SESSION['userType'] == 'bo') {
    } else {
        echo "<button id=\"btnAddProject\" type=\"button\" class=\"btn btn-primary\" data-target=\"#AddNewProject\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" ";
        echo $_SESSION['status'] == 'bo_approved' ? "disabled" : "";
        echo " >Add Project</button>";
    }
    echo "<button id=\"btnFinalizePlan\" type=\"button\" class=\"btn btn-success\" data-target=\"#FinalizeModalBack\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" ";
    echo $_SESSION['status'] == 'bo_approved' ? "disabled" : "";
    echo $_SESSION['userType'] == 'bo' ? ">Approve Plan" : ">Finalize Plan";
    echo "</button>";

    if ($_SESSION['userType'] == 'bdc') {
        echo "<button id=\"btnArchiveProject\" type=\"button\" class=\"btn btn-secondary\" data-target=\"#ArchiveProject\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" ";
        echo $_SESSION['status'] == 'bo_approved' ? "" : "disabled";
        echo " >Archive</button>";
    }

    echo "
        <br>
        <br>
        <br>
        <br></div>";
} else {
    exit(header("location: dashboard.php"));
}
?>

<?php include 'php-components/footer.php'; ?>