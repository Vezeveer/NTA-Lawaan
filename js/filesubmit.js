
  let fileInput = document.getElementById("file-input");
  let fileResult = document.getElementById("file-result");
  let fileSubmit = document.getElementById("file-submit");

  fileSubmit.disabled = true;

  fileInput.addEventListener("change", function () {
    if (fileInput.files.length > 0) {
      const fileSize = fileInput.files.item(0).size;
      const fileMb = fileSize / 1024 ** 2;
      console.log(fileMb)
      if (fileMb >= 1) {
        fileResult.innerHTML = "Please select a file less than 1MB.";
        fileSubmit.disabled = true;
      } else {
        fileResult.innerHTML = "Your file is " + fileMb.toFixed(1) + "MB.";
        fileSubmit.disabled = false;
      }
    }
  });


  function printImg(url) {
    var win = window.open('');
    win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
    win.focus();
  }