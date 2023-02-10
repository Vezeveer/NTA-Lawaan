<?php include_once 'php-components/header.php';
if (!isset($_SESSION['usersname']))
{
    header("Location: index.php");
    die();
}
echo "<!-- MAIN -->
<div class=\"col p-4 overflow-auto\" id=\"main-content\">";
?>

<div class="card bg-light mb-3" style="width: 18rem;">
  <div class="card-header text-center"><img class="card-img-top" style="width: 50%; margin: auto;" src="img/project-status.png" alt="Card image cap"></div>
  <div class="card-body">
    <h5 class="card-title"><i class="far fa-money-check"></i> STATUS</h5>
    <?php 
    // $hide = $_SESSION['enableContent'] or $_SESSION['userType'] == 'bdc' ? "" : "d-none";
    $hide = $showGo2plan ? "" : "d-none";
    $bdc_init = "<p class=\"card-text\">Barangay Development Council is currently initializing the Annual Investment Plan {$activeYear}.</p>";
    $bc_finalize = "<p class=\"card-text\">Barangay Committee is currently adjusting the Annual Investment Plan {$activeYear}.</p>";
    $bo_waiting = "<p class=\"card-text\">Waiting for Budget Office to approve the Annual Investment Plan {$activeYear}.</p>";
    $bo_approved = "<p class=\"card-text\">Budget Office has approved the Annual Investment Plan and is now the Annual Budget Plan {$activeYear}.</p>";
    $no_active = "<p class=\"card-text\">There is currently no active Annual Investment Plan.</p>";
    if($_SESSION["status"] == "bdc_initializing"){
        echo $bdc_init;
    } else if($_SESSION["status"] == "bc_finalizing") {
        echo $bc_finalize;
    } else if($_SESSION["status"] == "pending_bo_approval"){
        if($_SESSION['userType'] == 'bo'){
            $hide = "";
        }
        echo $bo_waiting;
    } else if($_SESSION["status"] == "bo_approved"){
        echo $bo_approved;
    } else {
        echo $no_active;
    }
    if($_SESSION["status"] == "no_active"){
        if($_SESSION['userType'] == 'bc' or $_SESSION['userType'] == 'bo'){

        } else {
            echo "<button id=\"NewProject\" type=\"button\" class=\"btn btn-primary dashboard_btn\" style=\"color: #EDF5E1 !important;\" data-target=\"#NewPlan\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\">Create New Plan</a>";
        }
    } else {
        echo "<a href=\"main.php\" class=\"btn btn-primary dashboard_btn {$hide}\" style=\"color: #EDF5E1 !important;\" disable>Go To Plan</a>";
    }
    ?>
  </div>
</div>

<?php include_once 'php-components/footer.php'?>