<script src="js/popup.js"></script>
<script src="js/main.js"></script>
<script src="js/pass_validation.js"></script>

<script src="js/editTable.js"></script>
<script src="js/tableResizeable.js"></script>

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
                    .column(13)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Total over this page
                pageTotal = api
                    .column(13, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Update footer
                $(api.column(13).footer()).html('₱' + pageTotal + ' ( ₱' + total + ' total)');
            },
        });

        $('#{$projectsTrimedNames[$i]}').on('draw.dt', function() {
            $('#{$projectsTrimedNames[$i]}').Tabledit({
                url: 'action.php',
                dataType: 'json',
                hideIdentifier: true,
                editButton: true,
                deleteButton: true,
                saveButton: true,
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [2, 'approved', '{\"Pending\": \"Pending\", \"True\": \"True\", \"False\": \"False\"}'],
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
                    $('table tr td:nth-child(8) input').attr(\"type\", \"date\");
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
                        <form method=\"post\" action=\"insert.php?year={$activeYear}\">
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

echo "
<!-- Update Project Name Modal -->
<div class=\"modal fade\" id=\"{$projectsTrimedNames[$i]}UpdateProjectNameModal\" tabindex=\"-1\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"exampleModalLabel\">Update Project Name</h5>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"></button>
                    </div>
                    <div class=\"modal-body\">
                        <form method=\"post\" action=\"update_project_name.php?year={$activeYear}&project={$projects[$i]}\">
                                <input type=\"text\" class=\"form-control\" name=\"project\" value=\"{$projects[$i]}\">
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