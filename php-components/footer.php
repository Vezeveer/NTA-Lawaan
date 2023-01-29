    <!-- CREATE NEW PROJECT PROMPT.modal -->
    <div class="modal fade" id="AddNewProject">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Project Name</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" <?php echo "action=\"/includes1/createProject.php?year=$activeYear\"" ?>>
                        <div class="form-group">
                            <input type="text" name="projectName" class="form-control input_proj" id="inputProjectName" placeholder="Project Name" required pattern="\S(.*\S)?" title="Make sure there are no spaces in front of text and at the end." maxlength="50">
                            <input type="text" name="items" class="form-control input_aipRefCode" placeholder="AIP Reference Code" maxlength="50" required>
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

    <!-- CREATE NEW BUDGET PLAN PROMPT.modal -->
    <div class="modal fade" id="NewPlan">
        <?php
        $currentYr = date("Y");
        $years = array();
        for ($i = 0; $i < 5; $i++) {
            array_push($years, ++$currentYr);
        }
        ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Annual Investment Plan</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" <?php echo "action=\"/includes1/create_table.php\"" ?>>
                        <div class="form-row align-items-center">
                            <div class="col-auto my-1">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">For Year:</label>
                                <select name="year" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <?php
                                    $currentYr = date("Y");
                                    echo "<option selected value=\"{$currentYr}\">{$currentYr}</option>";
                                    for ($i = 0; $i < 5; $i++) {
                                        $currentYr++;
                                        echo "
                                        <option value=\"{$currentYr}\">{$currentYr}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
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

    <!-- ARCHIVE PROJECT PROMPT.modal -->
    <div class="modal fade" id="ArchiveProject">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure you want to archive this project?</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" <?php echo "action=\"/includes1/update_status_archived.php?year=$activeYear\"" ?>>
                        <div class="form-group">

                        </div>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="newProject()">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> 
            </div> -->
            </div>
        </div>
    </div>

    <!-- BDC FINALIZE PROMPT.modal -->
    <div class="modal fade" id="FinalizeModalBack">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure you want to
                        <?php
                        if ($_SESSION["userType"] == "bo") {
                            echo "approve this plan as the Annual Budget Plan?";
                        } else if ($_SESSION["userType"] == "bdc") {
                            echo "send this plan to the Barangay Committee?";
                        } else if ($_SESSION["userType"] == "bc") {
                            echo "send this plan to the Budget Office for approval?";
                        }
                        ?></h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" <?php echo "action=\"/includes1/finalize.php?year={$activeYear}&userType={$_SESSION['userType']}\"" ?>>
                        <div class="form-group">
                        </div>
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!--ADDING NEW USER PROMPT.modal -->
    <div class="modal fade" id="UserModalBack">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New User</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form name="user_create" method="post" <?php echo "action=\"/includes1/new_user.php\"" ?>>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" name="fullName" class="form-control" placeholder="Full Name" aria-label="Full Name" aria-describedby="basic-addon1" pattern="\S(.*\S)?" maxlength="50" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="userEmail" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" pattern="\S(.*\S)?" maxlength="50" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="userName" class="form-control input_username" id="usrName" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" pattern="\S(.*\S)?" maxlength="50" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" name="userPsw" class="form-control" placeholder="Password" id="psw" aria-label="Password" aria-describedby="basic-addon1" pattern="\S(.*\S)?" maxlength="50" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" name="userPsw2" class="form-control" placeholder="Re-enter Password" id="confirm_password" aria-label="Re-enter Password" pattern="\S(.*\S)?" aria-describedby="basic-addon1" maxlength="50" required>
                        </div>
                        <fieldset class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Member</label>
                                </div>
                                <select name="userType" class="custom-select" id="inputGroupSelect01" required>
                                    <option selected value="bdc" selected>Barangay Development Council</option>
                                    <option value="bc">Barangay Committee</option>
                                    <option value="bo">Budget Office</option>
                                </select>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button id="user_submit" type="submit" class="btn btn-primary" onsubmit="validateForm()" disabled>Submit</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div id="message" class="alert alert-light d-none" role="alert">
                                <hr>
                                <h5 class="alert-heading">Password must contain the following:</h5>
                                <ul style="list-style: none;">
                                    <li id="letter" class="invalid1">A <b>lowercase</b> letter</li>
                                    <li id="capital" class="invalid1">A <b>capital (uppercase)</b> letter</li>
                                    <li id="number" class="invalid1">A <b>number</b></li>
                                    <li id="length" class="invalid1">Minimum <b>8 characters</b></li>
                                </ul>
                                <p>Please make sure username has no spaces in it, or special characters. Thank you.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div><!-- Main Col END -->
    </div><!-- body-row END -->

    <script src="js/main.js"></script>
    <script src="js/pass_validation.js"></script>

    </body>

    </html>
    <script>
        console.log(`Status: <?php echo isset($_SESSION["status"]) ? $_SESSION["status"] : "not set"; ?>, UserType: <?php echo isset($_SESSION["userType"]) ? $_SESSION["userType"] : "not set" ?>`);
    </script>
    <?php

    $editable = "
    [1, 'aipRefCode',],
[2, 'activityDesc'],
[3, 'impOffice'],
[4, 'startDate'],
[5, 'endDate'],
[6, 'expectedOutput'],
[7, 'fundingServices'],
[8, 'personalServices'],
[9, 'maint'],
[10, 'capitalOutlay'],
[11, 'total']";
    $modifiable = "editButton: false,
deleteButton: false,
saveButton: false,";
    $toggleBtn;
    $printMainContent = true;

    $hideCont = "<script>$('#main-content table').hide();</script>"; // hide all content
    $disableAddProjFinalizeBtns = "<script>
$(document).ready(function () {
    $('#btnFinalizePlan').prop('disabled', true);
    $('#btnAddProject').prop('disabled', true);
})
</script>
";

if(isset($_SESSION["usersname"])){
    switch ($_SESSION["userType"]) {
        case "bdc":
            if ($_SESSION["status"] == "bdc_initializing") {
                $toggleBtn = "enabled: true";
                $modifiable = "";
            } else {
                $toggleBtn = "enabled: false";
                $editable = "";
                echo $disableAddProjFinalizeBtns;
            }
            break;
        case "bc":
            if ($_SESSION["status"] == "bc_finalizing") {
                $toggleBtn = "enabled: true";
                $modifiable = "";
            } else {
                $toggleBtn = "enabled: false";
                $editable = "";
            }
            if ($_SESSION["status"] == "bdc_initializing") {
                $printMainContent = false;
                echo $hideCont;
            }
            break;
        case "bo":
            if ($_SESSION["status"] == "pending_bo_approval") {
                $toggleBtn = "enabled: false";
                $editable = "";
            } else {
                $toggleBtn = "enabled: false";
                $editable = "";
            }
            if ($_SESSION["status"] == "bdc_initializing") {
                $printMainContent = false;
                echo $hideCont;
            }
            if ($_SESSION["status"] == "bc_finalizing") {
                $printMainContent = false;
                echo $hideCont;
            }
            if ($_SESSION["status"] == "bo_approved") {
                //$printMainContent = false;
                //echo $hideCont;
                $toggleBtn = "enabled: false";
                $editable = "";
                echo $disableAddProjFinalizeBtns;
            }
            break;
        default:
    }

    function contentType($printMainContent, $projectsTrimedNames, $projects, $activeYear, $toggleBtn, $modifiable, $editable)
    {
        if ($printMainContent) {
            for ($i = 0; count($projectsTrimedNames) > $i; $i++) {
                echo "
<script type=\"text/javascript\" language=\"javascript\">
    $(document).ready(function() {

        var dataTable = $('#{$projectsTrimedNames[$i]}').DataTable({
            \"processing\": true,
            \"serverSide\": true,
            \"order\": [],
            \"ajax\": {
                url: \"includes1/fetch.php?projectName={$projects[$i]}&year={$activeYear}\",
                type: \"POST\"
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'New Entry',
                    action: function (e, node, config){
                        $('#{$projectsTrimedNames[$i]}myModal').modal('show')
                    },
                    {$toggleBtn}
                },
                {
                    text: 'Export',
                    extend: 'collection',
                    className: 'custom-html-collection',
                    buttons: [
                        'excel',
                        'pdf',
                        'csv',
                        'print',
                        'copy'
                    ]
                }
            ],
            scrollXinner: true,
            \"autoWidth\"  : false,
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();
     
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
     
                // Total over all pages
                total = api
                    .column(11)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Total over this page
                pageTotal = api
                    .column(11, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Update footer
                $(api.column(11).footer()).html('₱' + pageTotal + ' ( ₱' + total + ' total)');
            },
        });

        $('#{$projectsTrimedNames[$i]}').on('draw.dt', function() {
            $('#{$projectsTrimedNames[$i]}').Tabledit({
                url: 'includes1/action.php?year={$activeYear}',
                dataType: 'json',
                hideIdentifier: true,
                {$modifiable}
                columns: {
                    identifier: [0, 'id'],
                    editable: [ 
                        {$editable}
                    ]
                },
                restoreButton: false,
                onSuccess: function(data, textStatus, jqXHR) {
                    if (data.action == 'delete') {
                        $('#' + data.id).remove();
                        $('#{$projectsTrimedNames[$i]}').DataTable().ajax.reload();
                    }
                },
                onDraw: function() {
                    // Select all inputs of second column and apply datepicker each of them
                    $('table tr td:nth-child(2) input').attr(\"maxlength\", \"50\");
                    $('table tr td:nth-child(3) input').attr(\"maxlength\", \"50\");

                    $('table tr td:nth-child(4) input').attr(\"maxlength\", \"50\");
                    $('table tr td:nth-child(5) input').attr(\"type\", \"date\");
                    $('table tr td:nth-child(6) input').attr(\"type\", \"date\");
                    $('table tr td:nth-child(7) input').attr(\"maxlength\", \"50\");

                    $('table tr td:nth-child(8) input').attr(\"maxlength\", \"10\");
                    $('table tr td:nth-child(9) input').attr(\"maxlength\", \"10\");
                    $('table tr td:nth-child(10) input').attr(\"maxlength\", \"10\");
                    $('table tr td:nth-child(11) input').attr(\"maxlength\", \"10\");
                    $('table tr td:nth-child(12) input').attr(\"maxlength\", \"10\");
                    $('table tr td:nth-child(8) input').attr(\"type\", \"number\");
                    $('table tr td:nth-child(9) input').attr(\"type\", \"number\");
                    $('table tr td:nth-child(10) input').attr(\"type\", \"number\");
                    $('table tr td:nth-child(11) input').attr(\"type\", \"number\");
                    $('table tr td:nth-child(12) input').attr(\"type\", \"number\");
                    $('table tr td:nth-child(8) input').attr(\"oninput\", \"this.value=this.value.slice(0,this.maxLength)\");
                    $('table tr td:nth-child(9) input').attr(\"oninput\", \"this.value=this.value.slice(0,this.maxLength)\");
                    $('table tr td:nth-child(10) input').attr(\"oninput\", \"this.value=this.value.slice(0,this.maxLength)\");
                    $('table tr td:nth-child(11) input').attr(\"oninput\", \"this.value=this.value.slice(0,this.maxLength)\");
                    $('table tr td:nth-child(12) input').attr(\"oninput\", \"this.value=this.value.slice(0,this.maxLength)\");

                    // AipRefCode validation
                    $('table tr td:nth-child(2) input').bind(\"input\", function () {
                        var c = this.selectionStart,
                          r = /[^0-9 -]|\s/gi,
                          v = $(this).val();
                        if (r.test(v)) {
                          $(this).val(v.replace(r, \"\"));
                          c--;
                        }
                        this.setSelectionRange(c, c);
                      });
                  }
            });
        });
        dataTable.columns.adjust();
    });

    $(document).on('submit', '#addEntry', function(e) {
      e.preventDefault();
      var city = $('#addCityField').val();
      var username = $('#addUserField').val();
      var mobile = $('#addMobileField').val();
      var email = $('#addEmailField').val();
      if (city != '' && username != '' && mobile != '' && email != '') {
        $.ajax({
          url: \"add_user.php\",
          type: \"post\",
          data: {
            city: city,
            username: username,
            mobile: mobile,
            email: email
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                $('#{$projectsTrimedNames[$i]}').DataTable().ajax.reload();
                $('#{$projectsTrimedNames[$i]}myModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
</script>
";

                //<!-- Add Entry Prompt Modal -->
                echo "
<div class=\"modal fade\" id=\"{$projectsTrimedNames[$i]}myModal\" tabindex=\"-1\" aria-labelledby=\"newAipEntry\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"newAipEntry\">Add Entry</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"></button>
            </div>
            <div class=\"modal-body\">
                <form method=\"post\" action=\"includes1/insert.php?year={$activeYear}\">
                        <input type=\"text\" class=\"form-control\" name=\"project\" value=\"{$projects[$i]}\" readonly>
                        <hr>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\" id=\"basic-addon1\">AIP</span>
                            </div>
                            <input type=\"text\" class=\"form-control input_aipRefCode\" name=\"aipRefCode\" placeholder=\"AIP Reference Code\" aria-label=\"aipRefCode\" aria-describedby=\"basic-addon1\" maxlength=\"50\" required>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\" id=\"basic-addon1\"><i class=\"fas fa-info-circle\"></i></span>
                            </div>
                            <input type=\"text\" class=\"form-control\" name=\"activityDesc\" placeholder=\"Activity Description\" aria-label=\"actDesc\" aria-describedby=\"basic-addon1\" maxlength=\"50\" required>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\" id=\"basic-addon1\"><i class=\"fas fa-university\"></i></span>
                            </div>
                            <input type=\"text\" class=\"form-control\" name=\"impOffice\" placeholder=\"Implementing Office\" aria-label=\"actDesc\" aria-describedby=\"basic-addon1\" maxlength=\"50\" required>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\" id=\"basic-addon1\">start</span>
                            </div>
                            <input type=\"date\" class=\"form-control\" name=\"startDate\" aria-label=\"startDate\" aria-describedby=\"basic-addon1\" required>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\" id=\"basic-addon1\">end</span>
                            </div>
                            <input type=\"date\" class=\"form-control\" name=\"endDate\" aria-label=\"endDate\" aria-describedby=\"basic-addon1\" required>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\" id=\"basic-addon1\"><i class=\"fas fa-gem\"></i></span>
                            </div>
                            <input type=\"text\" class=\"form-control\" name=\"expectedOutput\" placeholder=\"Expected Output\" aria-label=\"expectedOutput\" aria-describedby=\"basic-addon1\" maxlength=\"50\" required>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\">₱</span>
                            </div>
                            <input type=\"number\" name=\"fundingServices\" class=\"form-control\" placeholder=\"Funding Services\" aria-label=\"Amount (to the nearest peso)\" maxlength=\"10\" oninput=\"this.value=this.value.slice(0,this.maxLength)\" required>
                            <div class=\"input-group-append\">
                                <span class=\"input-group-text\">.00</span>
                            </div>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\">₱</span>
                            </div>
                            <input type=\"number\" name=\"personalServices\" class=\"form-control\" placeholder=\"Personal Services\" aria-label=\"Amount (to the nearest peso)\" maxlength=\"10\" oninput=\"this.value=this.value.slice(0,this.maxLength)\" required>
                            <div class=\"input-group-append\">
                                <span class=\"input-group-text\">.00</span>
                            </div>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\">₱</span>
                            </div>
                            <input type=\"number\" name=\"maint\" class=\"form-control\" placeholder=\"Maintenance\" aria-label=\"Amount (to the nearest peso)\" maxlength=\"10\" oninput=\"this.value=this.value.slice(0,this.maxLength)\" required>
                            <div class=\"input-group-append\">
                                <span class=\"input-group-text\">.00</span>
                            </div>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\">₱</span>
                            </div>
                            <input type=\"number\" name=\"capitalOutlay\" class=\"form-control\" placeholder=\"Capital Outlay\" aria-label=\"Amount (to the nearest peso)\" maxlength=\"10\" oninput=\"this.value=this.value.slice(0,this.maxLength)\" required>
                            <div class=\"input-group-append\">
                                <span class=\"input-group-text\">.00</span>
                            </div>
                        </div>
                        <div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\">₱</span>
                            </div>
                            <input type=\"number\" name=\"total\" class=\"form-control\" placeholder=\"Total\" aria-label=\"Amount (to the nearest peso)\" maxlength=\"10\" oninput=\"this.value=this.value.slice(0,this.maxLength)\" required>
                            <div class=\"input-group-append\">
                                <span class=\"input-group-text\">.00</span>
                            </div>
                        </div>
                    <button type=\"submit\" class=\"btn btn-primary\">Submit</button>
                </form>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
            </div>
        </div>
    </div>
</div>
";

                //<!-- Update Project Name Modal -->
                echo "<div class=\"modal fade\" id=\"{$projectsTrimedNames[$i]}UpdateProjectNameModal\" >
        <div class=\"modal-dialog\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h4 class=\"modal-title\" id=\"newAipEntry\">Update Project Name</h4>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>
                </div>
                <div class=\"modal-body\">
                    <form method=\"post\" action=\"includes1/update_project_name.php?year={$activeYear}&project={$projects[$i]}\">
                        <div class=\"input-group mb-3\">
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\" id=\"basic-addon1\"><i class=\"fas fa-pencil-alt\"></i></span>
                            </div>
                            <input type=\"text\" name=\"project\" class=\"form-control input_proj\" placeholder=\"Name\" aria-label=\"Project Name\" aria-describedby=\"basic-addon1\" pattern=\"\S(.*\S)?\" title=\"Make sure there are no spaces in front of text and at the end.\" maxlength=\"50\" required>
                        </div>
                        <div class=\"form-group row\">
                            <div class=\"col-sm-10\">
                                <button type=\"submit\" class=\"btn btn-primary\">Submit</button>
                            </div>
                        </div>
                        <!-- <div id=\"message\" class=\"form-group row\">
                            <h5>Password must contain the following:</h3>
                                <p id=\"letter\" class=\"invalid1\">A <b>lowercase</b> letter</p>
                                <p id=\"capital\" class=\"invalid1\">A <b>capital (uppercase)</b> letter</p>
                                <p id=\"number\" class=\"invalid1\">A <b>number</b></p>
                                <p id=\"length\" class=\"invalid1\">Minimum <b>8 characters</b></p>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>";
            }
        }
    }
    if(isset($_GET['year'])){
        contentType($printMainContent, $projectsTrimedNames, $projects, $_GET['year'], "enabled: false", "editButton: false,
        deleteButton: false,
        saveButton: false,", "");

    } else {
        contentType($printMainContent, $projectsTrimedNames, $projects, $activeYear, $toggleBtn, $modifiable, $editable);
    }
}
    ?>
    