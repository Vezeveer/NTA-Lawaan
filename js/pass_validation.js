$("#psw, #confirm_password").on("keyup", function () {
  if ($("#psw").val() == $("#confirm_password").val()) {
    $("#message1").html("Matching").css("color", "green");
    $("#user_submit").prop("enable", true);
    $("#user_submit").prop("disabled", false);
  } else {
    $("#message1").html("Not Matching").css("color", "red");
    $("#user_submit").prop("disabled", true);
  }
});

var myInput = document.getElementById("psw");
var myInput2 = document.getElementById("confirm_password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function () {
//   document.getElementById("message").style.display = "inline";
  document.getElementById("message").classList.remove("d-none");

};
myInput2.onfocus = function () {
    // document.getElementById("message").style.display = "inline";
    document.getElementById("message").classList.remove("d-none");

  };

// When the user clicks outside of the password field, hide the message boxForm
myInput.onblur = function () {
//   document.getElementById("message").style.display = "none";
  document.getElementById("message").classList.add("d-none");

};
myInput2.onblur = function () {
    // document.getElementById("message").style.display = "none";
  document.getElementById("message").classList.add("d-none");

  };

// When the user starts to type something inside the password field
myInput.onkeyup = function () {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if (myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid1");
    letter.classList.add("valid1");
  } else {
    letter.classList.remove("valid1");
    letter.classList.add("invalid1");
  }

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if (myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid1");
    capital.classList.add("valid1");
  } else {
    capital.classList.remove("valid1");
    capital.classList.add("invalid1");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if (myInput.value.match(numbers)) {
    number.classList.remove("invalid1");
    number.classList.add("valid1");
  } else {
    number.classList.remove("valid1");
    number.classList.add("invalid1");
  }

  // Validate length
  if (myInput.value.length >= 8) {
    length.classList.remove("invalid1");
    length.classList.add("valid1");
  } else {
    length.classList.remove("valid1");
    length.classList.add("invalid1");
  }
};

// When the user starts to type something inside the password field
myInput2.onkeyup = function () {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if (myInput2.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid1");
    letter.classList.add("valid1");
  } else {
    letter.classList.remove("valid1");
    letter.classList.add("invalid1");
  }

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if (myInput2.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid1");
    capital.classList.add("valid1");
  } else {
    capital.classList.remove("valid1");
    capital.classList.add("invalid1");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if (myInput2.value.match(numbers)) {
    number.classList.remove("invalid1");
    number.classList.add("valid1");
  } else {
    number.classList.remove("valid1");
    number.classList.add("invalid1");
  }

  // Validate length
  if (myInput2.value.length >= 8) {
    length.classList.remove("invalid1");
    length.classList.add("valid1");
  } else {
    length.classList.remove("valid1");
    length.classList.add("invalid1");
  }
};

function validateForm() {
    var a = document.forms["user_create"]["userName"].value;
    var b = document.forms["user_create"]["fullName"].value;
    var c = document.forms["user_create"]["userEmail"].value;
    var d = document.forms["user_create"]["userPsw"].value;
    var e = document.forms["user_create"]["userPsw2"].value;
    var f = document.forms["user_create"]["userType"].value;

    if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "", e == null || e == "", f == null || f == "") {
      alert("Please Fill All Required Field");
      return false;
    }
  }

