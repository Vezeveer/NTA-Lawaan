<?php
include_once 'php-components/header.php';
$docType = "";
echo "<!-- MAIN -->
<div class=\"col p-4 overflow-auto\" id=\"main-content\">";
echo "<h1 class=\"display-5\">Annual Budget Plan {$_GET['year']}</h1><div class=\"panel panel-default\">";


if ($_SESSION['enableContent'] or $_SESSION['userType'] == 'bdc') {
    
} else {
    header("location: dashboard.php");
}

if (isset($_GET['filesuccess'])){
    if($_GET['filesuccess'] == "yes"){
        echo "
        <div class=\"modal fade\" id=\"SuccessDocs\">
            <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h4 class=\"modal-title\">Supporting Documents</h4>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>
                    </div>
                    <div class=\"modal-body\">
                        <p>Successfully uploaded.</p>
                    </div>
                </div>
            </div>
        </div>
        <script>$(\"#SuccessDocs\").modal('show');</script>
        ";
    } else if($_GET['filesuccess'] == "no"){
        echo "
        <div class=\"modal fade\" id=\"SuccessDocs\">
            <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h4 class=\"modal-title\">Supporting Documents</h4>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>
                    </div>
                    <div class=\"modal-body\">
                        <p>Failed to uploaded.</p>
                    </div>
                </div>
            </div>
        </div>
        <script>$(\"#SuccessDocs\").modal('show');</script>
        ";
    }
}

$imgType = "";
if(isset($_POST['imgType'])){
    $imgType = $_POST['imgType'];
} else {
    $imgType = $_GET['imgType'];
}

$tl = "";
$robdp = "";
$rataip = "";
switch($imgType){
    case 'tl':
        $tl = "selected";
        break;
    case 'robdp':
        $robdp = "selected";
        break;
    case 'rataip':
        $rataip = "selected";
        break;
    default:
}

?>

<form name="user_create" method="post" <?php echo "action=\"../docs.php?year={$_GET['year']}&imgType={$imgType}\"" ?>>
    <div class="form-group row">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <select name="imgType" class="custom-select" id="inputGroupSelect01" required>
                        <option selected value="tl" <?php echo $tl ?>>Transmittal Letter</option>
                        <option value="robdp" <?php echo $robdp ?>>Resolution of Barangay Development Plan</option>
                        <option value="rataip" <?php echo $rataip ?>>Resolution Approving the Annual Investment Plan</option>
                    </select>
                <hr>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">View</button>
                    <button type="button" class="btn btn-secondary" data-target="#AddDocs" data-toggle="modal" data-backdrop="static" data-keyboard="false">Upload</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
if(isset($_POST['imgType'])){
    $sql = "SELECT * FROM docs WHERE img_year={$_GET['year']} AND img_type='{$_POST['imgType']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) { 
        //results are empty, do something here 
        echo "<hr>";
        echo "<p>There are no documents to show.</p>";
     } else { 
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class=\"card\" >";
            echo '<img class="card-img-top" src="data:image/png;base64,'.base64_encode($row['img_data']).'"/>';
            echo "<div class=\"card-body\">";
              if($activeYear != $_GET['year']){

            } else {
              echo "<button id=\"btnDeleteDoc\" type=\"button\" class=\"btn btn-danger\" 
              data-target=\"#DeleteDoc\" data-toggle=\"modal\" data-backdrop=\"static\" 
              data-keyboard=\"false\" ";
              echo $_SESSION['status'] == 'bc_finalizing' ? "disabled" : ($_SESSION['status'] == 'pending_bo_approval' ? "disabled" : ($_SESSION['status'] == 'bo_approved' ? "disabled" : ""));
              echo " >Delete Doc</button>";
                echo '<button class="btn btn-secondary dl-btn" ><a style="text-decoration: none !important; color: white !important;" href="data:image/png;base64,'.base64_encode($row['img_data']).'" download="'.$row['img_name'].'">Download</a></button>';
                echo "<button class=\"btn btn-primary\" onclick=\"printImg('data:image/png;base64,"; echo base64_encode($row['img_data']); echo "')\">Print</button>";
            }
            echo "</div>
          </div>";
            // echo '<img src="data:image/png;base64,'.base64_encode($row['img_data']).'"/>';
              $docType = $row['img_type'];
              echo "<br>";
          }
     } 
} else {
    $sql = "SELECT * FROM docs WHERE img_year={$_GET['year']} AND img_type='{$_GET['imgType']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) { 
        //results are empty, do something here 
        echo "<hr>";
        echo "<p>There are no documents to show.</p>";
     } else { 
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<img src="data:image/png;base64,'.base64_encode($row['img_data']).'"/>';
              $docType = $row['img_type'];
              echo "<hr>";
              if($activeYear != $_GET['year']){

              } else {
                echo "<button id=\"btnDeleteDoc\" type=\"button\" class=\"btn btn-danger\" 
                data-target=\"#DeleteDoc\" data-toggle=\"modal\" data-backdrop=\"static\" 
                data-keyboard=\"false\" ";
                echo $_SESSION['status'] == 'bc_finalizing' ? "disabled" : ($_SESSION['status'] == 'pending_bo_approval' ? "disabled" : ($_SESSION['status'] == 'bo_approved' ? "disabled" : ""));
                echo " >Delete Doc</button>";
              }
          }
     } 
}

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
?>
<!-- DELETE DOCUMENT PROMPT.modal -->
<div class="modal fade" id="DeleteDoc">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">DELETE</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <form method="post" <?php echo "action=\"/includes1/delete_doc.php?year={$_SESSION['activeYear']}&docType={$docType}\"" ?>>
                    <div class="form-group">
                    <p>Are you sure you want to delete this document?</p>
                    </div>
                    <button type="submit" class="btn btn-primary hoverable">Yes</button>
                    <button type="button" class="btn btn-secondary hoverable" data-dismiss="modal">Cancel</button>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="newProject()">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> 
            </div> -->
        </div>
    </div>
</div>

<?php include 'php-components/footer.php'; ?>