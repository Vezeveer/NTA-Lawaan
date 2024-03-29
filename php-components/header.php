<?php
header("Access-Control-Allow-Origin: *");
session_start();
// Check if last activity was set
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
    // last request was more than 15 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    header("Location: login.php"); // redirect to login page
}
$_SESSION['last_activity'] = time(); // update last activity time stamp
$_SESSION["enableContent"] = false;
$_SESSION['adminAccess'] = false;
?>
<!DOCTYPE html>
<html>

<head>
    <title>NTA Lawaan</title>
    <link rel="stylesheet" href="css-libs/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css-libs/buttons.dataTables.min.css">
    <link rel="stylesheet" href="css-libs/buttons.bootstrap4.min.css">

    <script src="js-libs/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="third-party/bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <script src="js-libs/jquery.dataTables.min.js"></script>
    <script src="js-libs/dataTables.buttons.min.js"></script>
    <script src="js-libs/jszip.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
    <script src="js-libs/pdfmake.min.js"></script> <!-- pdfmake 0.2.7 -->
    <script src="js-libs/vfs_fonts.js"></script>
    <script src="js-libs/buttons.html5.min.js"></script>
    <script src="js-libs/buttons.print.min.js"></script>
    <script src="js-libs/buttons.bootstrap4.min.js"></script>
    <script src="js-libs/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="css-libs/dataTables.bootstrap4.min.css">
    <script src="third-party/bootstrap-4.6.2-dist/js/bootstrap.min.js"></script>
    <script src="js/jquery.tabledit.js"></script>

    <style>
        table.dataTable tbody th,
        table.dataTable tbody td {
            white-space: nowrap;
        }
    </style>

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="third-party/fontawesome-free-5.15.4-web/css/all.min.css"> <!-- fontawesome 5.15.4 web -->
    <script src="third-party/fontawesome-free-5.15.4-web/js/all.min.js"></script> <!-- fontawesome 5.15.4 web -->

    <script src="js-libs/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="css-libs/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="css/login.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/priority.css">
    <link rel="stylesheet" href="css/popup.css"> -->
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/main_content.css">
    <link rel="stylesheet" href="css/threed.css">
    <link rel="stylesheet" href="css/pass_validation.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <?php
    include_once 'includes1/databasehandler.inc.php';
    include_once 'includes1/functions.inc.php';

    $activePage = basename($_SERVER['PHP_SELF'], ".php");
    $projects = array();
    $projectsTrimedNames = array();
    $activeYear;

    if (isset($_SESSION["usersname"])) {
        $items;

        // After action, update for next page
        if(isset($_GET['lastpage'])){
            if ($_GET['lastpage'] == 'current'){
                $_SESSION["activeYear"] = "noActive";
                $_SESSION["status"] = "no_active";
                $activeYear = $_SESSION["activeYear"];
            }
        }
        if(isset($_GET['newplan'])){
            if($_GET['newplan'] == 'yes'){
                $_SESSION["activeYear"] = getActiveYear($conn);
                $activeYear = $_SESSION["activeYear"];
                $_SESSION["status"] = "bdc_initializing";
            }
        }
        if(isset($_GET['userType'])){
            if($_GET['userType'] == "bo"){
                $_SESSION["activeYear"] = getActiveYear($conn);
                $activeYear = $_SESSION["activeYear"];
                $_SESSION["status"] = "bo_approved";
            }
            if($_GET['userType'] == "bdc"){
                if(isset($_GET['isArchived'])){
                    $_SESSION["activeYear"] = getActiveYear($conn);
                    $activeYear = $_SESSION["activeYear"];
                    $_SESSION["status"] = "no_active";
                } else {
                    $_SESSION["activeYear"] = getActiveYear($conn);
                    $activeYear = $_SESSION["activeYear"];
                    $_SESSION["status"] = "bc_finalizing";
                }
            }
            if($_GET['userType'] == "bc"){
                $_SESSION["activeYear"] = getActiveYear($conn);
                $activeYear = $_SESSION["activeYear"];
                $_SESSION["status"] = "pending_bo_approval";
            }
        }

        $_SESSION["activeYear"] = getActiveYear($conn);
        $activeYear = $_SESSION["activeYear"];
        
        echo "<script>console.log('Active year: {$activeYear}')</script>";
        $inactiveYears = getInactiveYears($conn, $activeYear);

        if ($_SESSION["usersname"] == null) {
            header("location: index.php");
            exit();
        } else {
            
        }

        // allow viewing of content
        if ($_SESSION['userType'] == 'bdc' && $_SESSION['status'] == 'bdc_initializing') {
            $_SESSION['enableContent'] = true;
        } else if ($_SESSION['userType'] == 'bc') {
            if($_SESSION['status'] != 'bdc_initializing'){
                $_SESSION['enableContent'] = true;
            }
        } else if ($_SESSION['userType'] == 'bo' && $_SESSION['status'] == 'pending_bo_approval') {
            $_SESSION['enableContent'] = true;
        } else if ($_SESSION['status'] == 'bo_approved') {
            $_SESSION['enableContent'] = true;
        }

        if ($_SESSION['userType'] == 'bdc'){
            $_SESSION['adminAccess'] = true;
        }

        $pTitleEditable = false;
        $showGo2plan = false;
        $EnableAddProj = false;
        $EnableFinalzPlan = false;
        $EnableMobiCurrPlanBtn = false;
        switch($_SESSION['status']){
            case 'bdc_initializing':
                switch($_SESSION['userType']){
                    case 'bdc':
                        $pTitleEditable = true;
                        $showGo2plan = true;
                        $EnableAddProj = true;
                        $EnableFinalzPlan = true;
                        $EnableMobiCurrPlanBtn = true;
                        break;
                    case 'bc':
                        break;
                    case 'bo':
                        break;
                    default:
                }
                break;
            case 'bc_finalizing':
                switch($_SESSION['userType']){
                    case 'bdc':
                        $showGo2plan = true;
                        $EnableMobiCurrPlanBtn = true;
                        break;
                    case 'bc':
                        $pTitleEditable = true;
                        $showGo2plan = true;
                        $EnableAddProj = true;
                        $EnableFinalzPlan = true;
                        $EnableMobiCurrPlanBtn = true;
                        break;
                    case 'bo':
                        break;
                    default:
                }
                break;
            case 'pending_bo_approval':
                switch($_SESSION['userType']){
                    case 'bdc':
                        $showGo2plan = true;
                        $EnableMobiCurrPlanBtn = true;
                        break;
                    case 'bc':
                        $showGo2plan = true;
                        $EnableMobiCurrPlanBtn = true;
                        break;
                    case 'bo':
                        $showGo2plan = true;
                        $EnableFinalzPlan = true;
                        $EnableMobiCurrPlanBtn = true;
                        break;
                    default:
                }
                break;
            default:
        }

        include_once 'navigation.php';
    } else {
        
    }
    

echo "
    ";