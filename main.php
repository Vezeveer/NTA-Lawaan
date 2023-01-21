<?php include_once 'header.php' ?>

<h1 class="display-5">Annual Investment Plan</h1>
<div class="panel panel-default">
    <?php
    for ($j = 0; count($projects) > $j; $j++) {
        if (isset($projects[$j])) {
            echo "
                    <a href=\"#\" class=\"\" data-target=\"#{$projectsTrimedNames[$j]}UpdateProjectNameModal\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\"><h5 class=\"panel-heading\">";
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
    ?>

    <button id="btnAddProject" type="button" class="btn btn-primary" data-target="#MymodalBack" data-toggle="modal" data-backdrop="static" data-keyboard="false">Add Project</button>
    <button id="btnFinalizePlan" type="button" class="btn btn-success" data-target="#FinalizeModalBack" data-toggle="modal" data-backdrop="static" data-keyboard="false">Finalize Plan</button>
    <!-- Add a modal button for sending to BO -->
    <!-- Add a modal button for BO approval -->
    <br>
    <br>
    <br>
    <br>
    <!-- .modal -->
    <div class="modal fade" id="MymodalBack">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Project Name</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" <?php echo "action=\"/includes/createProject.php?year=$activeYear\"" ?>>
                        <div class="form-group">
                            <input type="text" name="projectName" class="form-control input_proj" id="inputProjectName" placeholder="Project Name" required  pattern="\S(.*\S)?" title="Make sure there are no spaces in front of text and at the end.">
                            <input type="text" name="items" class="form-control input_aipRefCode" placeholder="AIP Reference Code" required>
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

    <!-- .modal -->
    <div class="modal fade" id="FinalizeModalBack">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure you want to approve this plan to the Barangay Committee?</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" <?php echo "action=\"/includes/finalize.php?year={$activeYear}&userType={$_SESSION['userType']}\"" ?>>
                        <div class="form-group">
                        </div>
                        <button type="submit" class="btn btn-primary">Approve</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> 
                    </form>
                </div>
                <div class="modal-footer">
                
                </div>
            </div>
        </div>
    </div>

    <!-- .modal -->
    <div class="modal fade" id="UserModalBack">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New User</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <!-- <form method="post" <?php echo "action=\"new_user.php\"" ?>>
                                <div class="form-group">
                                    <input id="usrname" type="text" name="userName" class="form-control" placeholder="User Name" required>
                                    <input id="psw" type="password" name="userPass" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    <input id="confirm_password" type="password" name="userPass2" class="form-control" placeholder="Re-enter Password" required>
                                    <span id='message1'></span>
                                    <label for="userType">User Type:</label>
                                    <select id="userTypeSelect" name="userType">
                                    <option value="bdc" selected>Barangay Development Council</option>
                                    <option value="bc">Barangay Committee</option>
                                    <option value="bo">Budget Office</option>
                                    </select>
                                </div>
                                <div id="message">
                                    <h5>Password must contain the following:</h3>
                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                    <p id="number" class="invalid">A <b>number</b></p>
                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                </div>
                                <button id="user_submit" type="submit" class="btn btn-primary">Submit</button>
                            </form> -->

                    <form method="post" <?php echo "action=\"new_user.php\"" ?>>
                        <div class="form-group row">
                            <label for="usrName" class="col-sm-4 col-form-label">User Name</label>
                            <div class="col-sm-8">
                                <input name="userName" type="text" class="form-control" id="usrName" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="psw" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="psw" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="col-sm-4 col-form-label">Re-enter Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="confirm_password" placeholder="Re-enter Password">
                                <span id='message1'></span>
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">User Type:</legend>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="bdc" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Barangay Development Council
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="bc">
                                        <label class="form-check-label" for="gridRadios2">
                                            Barangay Committee
                                        </label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="bo">
                                        <label class="form-check-label" for="gridRadios3">
                                            Budget Office
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button id="user_submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <div id="message" class="form-group row">
                            <h5>Password must contain the following:</h3>
                                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                <p id="number" class="invalid">A <b>number</b></p>
                                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'footer.php' ?>