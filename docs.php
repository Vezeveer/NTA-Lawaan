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

$enableUploadBtn = "disabled";
$enableDeleteBtn = "disabled";
switch($_SESSION['status']){
    case 'bdc_initializing':
        switch($_SESSION['userType']){
            case 'bdc':
                if($activeYear != $_GET['year']){

                } else {
                    $enableUploadBtn = "";
                    $enableDeleteBtn = "";
                }
                break;
        }
        break;
    case 'bc_finalizing':
        switch($_SESSION['userType']){
            case 'bc':
                if($activeYear != $_GET['year']){

                } else {
                    $enableUploadBtn = "";
                    $enableDeleteBtn = "";
                }
                break;
        }
        break;
    case 'pending_bo_approval':
        break;
    case 'bo_approved':
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
                    <?php
                        echo '<button type="button" class="btn btn-secondary" data-target="#AddDocs" data-toggle="modal" data-backdrop="static" data-keyboard="false" '.$enableUploadBtn.'>Upload</button>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
$disablePrint = "disabled";
$sql = "SELECT * FROM docs WHERE img_year={$_GET['year']} AND img_type='{$imgType}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) { 
        //results are empty, do something here 
        echo "<hr>";
        echo "<p>There are no documents to show.</p>";
     } else { 
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            $img_ext = substr($row['img_name'], -3);
            

            echo "<div class=\"card\" >";
            if($img_ext == "jpg" || $img_ext == "png" || $img_ext == "gif"){
                $disablePrint = "";
                echo '<img id="imgDoc'.$count.'" class="loading card-img-top" src="data:image/png;base64,'.base64_encode($row['img_data']).'"/>';
            } else {
                echo '<i style="width:100%;padding:5px;" class="fas fa-file-alt fa-10x"></i>';
            }
            echo "<div class=\"card-body\">";
            echo '<p class="card-text">File Name: '.$row['img_name'].'</p>';
            echo "<button id=\"btnDeleteDoc\" type=\"button\" class=\"btn btn-danger\" 
            data-target=\"#DeleteDoc\" data-toggle=\"modal\" data-backdrop=\"static\" 
            data-keyboard=\"false\" ";
            echo $_SESSION['status'] == 'bc_finalizing' ? "" : ($_SESSION['status'] == 'pending_bo_approval' ? "disabled" : ($_SESSION['status'] == 'bo_approved' ? "disabled" : ""));
            echo " ".$enableDeleteBtn.">Delete Doc</button>";
            echo '<button class="btn btn-secondary dl-btn" ><a style="text-decoration: none !important; color: white !important;" href="data:image/png;base64,'.base64_encode($row['img_data']).'" download="'.$row['img_name'].'">Download</a></button>';
            echo "<button class=\"btn btn-primary\" onclick=\"printImg('data:image/png;base64,"; echo base64_encode($row['img_data']); echo "')\" $disablePrint>Print</button>";
            echo "</div>
          </div>";
            // echo '<img src="data:image/png;base64,'.base64_encode($row['img_data']).'"/>';
              $docType = $row['img_type'];
              echo "<br>";
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