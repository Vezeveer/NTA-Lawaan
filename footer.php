



<!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="js/sidebarDropdown.js"></script> -->

<script src="js/popup.js"></script>
<script src="js/main.js"></script>
<script src="js/pass_validation.js"></script>



<script src="js/editTable.js"></script>
<script src="js/tableResizeable.js"></script>
<!-- <script src="js/data.js"></script> -->

</body>
</html>
<?php
for($i = 0; count($projectsTrimedNames) > $i; $i++){
echo "
<script type=\"text/javascript\" language=\"javascript\">
    $(document).ready(function() {

        var dataTable = $('#{$projectsTrimedNames[$i]}').DataTable({
            \"processing\": true,
            \"serverSide\": true,
            \"order\": [],
            \"ajax\": {
                url: \"fetch.php?projectName={$projects[$i]}\",
                type: \"POST\"
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'New Entry',
                    action: function (e, node, config){
                        $('#{$projectsTrimedNames[$i]}myModal').modal('show')
                    }
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
                    .column(12)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Total over this page
                pageTotal = api
                    .column(12, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Update footer
                $(api.column(12).footer()).html('₱' + pageTotal + ' ( ₱' + total + ' total)');
            },
        });

        $('#{$projectsTrimedNames[$i]}').on('draw.dt', function() {
            $('#{$projectsTrimedNames[$i]}').Tabledit({
                url: 'action.php',
                dataType: 'json',
                hideIdentifier: true,
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [2, 'approved'],
                        [3, 'aipRefCode',],
                        [4, 'activityDesc'],
                        [5, 'impOffice'],
                        [6, 'startDate'],
                        [7, 'endDate'],
                        [8, 'expectedOutput'],
                        [9, 'fundingServices'],
                        [10, 'personalServices'],
                        [11, 'maint'],
                        [12, 'capitalOutlay'],
                        [13, 'total']
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
                    $('table tr td:nth-child(7) input').attr(\"type\", \"date\");
                    $('table tr td:nth-child(8) input').each(function() {
                        $(this).datepicker({
                          format: 'yyyy-mm-dd',
                          todayHighlight: false
                        });
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

echo "
<!-- Add user Modal -->
<div class=\"modal fade\" id=\"{$projectsTrimedNames[$i]}myModal\" tabindex=\"-1\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"exampleModalLabel\">Add Entry</h5>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"></button>
                    </div>
                    <div class=\"modal-body\">
                        <form method=\"post\" action=\"insert.php?year={$year}\">
                                <input type=\"text\" class=\"form-control\" name=\"project\" value=\"{$projects[$i]}\" readonly>
                                <input type=\"text\" class=\"form-control\" name=\"aipRefCode\" placeholder=\"AIP Reference Code\" required>
                                <input type=\"text\" class=\"form-control\" name=\"activityDesc\" placeholder=\"Activity Description\" required>
                                <input type=\"text\" class=\"form-control\" name=\"impOffice\" placeholder=\"Implementing Office\" required>
                                <input type=\"date\" class=\"form-control\" name=\"startDate\" placeholder=\"Start Date\" required>
                                <input type=\"date\" class=\"form-control\" name=\"endDate\" placeholder=\"End Date\" required>
                                <input type=\"text\" class=\"form-control\" name=\"expectedOutput\" placeholder=\"Expected Output\" required>
                                <input type=\"number\" class=\"form-control\" name=\"fundingServices\" placeholder=\"Funding Services\" required>
                                <input type=\"number\" class=\"form-control\" name=\"personalServices\" placeholder=\"Personal Services\" required>
                                <input type=\"number\" class=\"form-control\" name=\"maint\" placeholder=\"Maintenance\" required>
                                <input type=\"number\" class=\"form-control\" name=\"capitalOutlay\" placeholder=\"Capital Outlay\" required>
                                <input type=\"number\" class=\"form-control\" name=\"total\" placeholder=\"Total\" required>
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
}
?>
<script>
$('table tr td:nth-child(4) input').each(function() {
    $(this).datepicker({
        format: 'dd/mm/yyyy',
        endDate: '+0d',
        todayHighlight: true,
        autoclose: true
    });
});
</script>
<!-- Add user Modal -->
<!-- <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEntry" action="">
                        <div class="mb-3 row">
                        <label for="addUserField" class="col-md-3 form-label">Project Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addUserField" name="name" value=>
                        </div>
                        </div>
                        <div class="mb-3 row">
                        <label for="addEmailField" class="col-md-3 form-label">sdfdsfd</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control" id="addEmailField" name="email">
                        </div>
                        </div>
                        <div class="mb-3 row">
                        <label for="addMobileField" class="col-md-3 form-label">sdfdf</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addMobileField" name="mobile">
                        </div>
                        </div>
                        <div class="mb-3 row">
                        <label for="addCityField" class="col-md-3 form-label">dfdd</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addCityField" name="City">
                        </div>
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div> -->