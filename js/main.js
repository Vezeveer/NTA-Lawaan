// Hide submenus
$("#body-row .collapse").collapse("hide");

// Collapse/Expand icon
$("#collapse-icon").addClass("fa-angle-double-left");

// Collapse click
$("[data-toggle=sidebar-colapse]").click(function () {
  SidebarCollapse();
});

function SidebarCollapse() {
  $(".menu-collapsed").toggleClass("d-none");
  $(".sidebar-submenu").toggleClass("d-none");
  $(".submenu-icon").toggleClass("d-none");
  $("#sidebar-container").toggleClass("sidebar-expanded sidebar-collapsed");

  // Treating d-flex/d-none on separators with title
  var SeparatorTitle = $(".sidebar-separator-title");
  if (SeparatorTitle.hasClass("d-flex")) {
    SeparatorTitle.removeClass("d-flex");
  } else {
    SeparatorTitle.addClass("d-flex");
  }

  // Collapse/Expand icon
  $("#collapse-icon").toggleClass("fa-angle-double-left fa-angle-double-right");
}

$(document).ready(function () {
  $("table tr td:nth-child(4) input").each(function () {
    $(this).datepicker({
      format: "dd/mm/yyyy",
      endDate: "+0d",
      todayHighlight: true,
      autoclose: true,
    });
  });

  // validate input, project name
  $(".input_proj").bind("input", function () {
    var c = this.selectionStart,
      r = /[^a-z0-9 -]/gi,
      v = $(this).val();
    if (r.test(v)) {
      $(this).val(v.replace(r, ""));
      c--;
    }
    this.setSelectionRange(c, c);
  });

  // validate input, aip ref code
  $(".input_aipRefCode").bind("input", function () {
    var c = this.selectionStart,
      r = /[^0-9 -]|\s/gi,
      v = $(this).val();
    if (r.test(v)) {
      $(this).val(v.replace(r, ""));
      c--;
    }
    this.setSelectionRange(c, c);
  });
  
  // validate input, username
  $(".input_username").bind("input", function () {
    var c = this.selectionStart,
      r = /[^a-z0-9 -]|\s/gi,
      v = $(this).val();
    if (r.test(v)) {
      $(this).val(v.replace(r, ""));
      c--;
    }
    this.setSelectionRange(c, c);
  });
});
