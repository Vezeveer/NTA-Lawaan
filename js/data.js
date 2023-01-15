

function AddRow(){
    let addRow = document.getElementsByClassName('project-table')
    addRow.deleteRow(-1);
	let newRow = addRow.insertRow(-1);

    let n1 = newRow.insertCell(0);
    let n2 = newRow.insertCell(1);
    let n3 = newRow.insertCell(2);
    let n4 = newRow.insertCell(3);
    let n5 = newRow.insertCell(4);
    let n6 = newRow.insertCell(5);
    let n7 = newRow.insertCell(6);
    let n8 = newRow.insertCell(7);
    let n9 = newRow.insertCell(8);
    let n10 = newRow.insertCell(9);
    let n11 = newRow.insertCell(10);

    n1.innerHTML = "<input type=\"checkbox\" name=\"item1\" value=\"item1\">";
    // n2.innerHTML = "3000-200-2";
    // n3.innerHTML = "GGGG";
    // n4.innerHTML = "LLLLL";

    let newRow2 = addRow.insertRow(-1);

    let x1 = newRow2.insertCell(0);
    let x2 = newRow2.insertCell(1);

    x1.innerHTML += "<input type=\"checkbox\" disabled></input>";
    x2.innerHTML += "<form action=\"/\" onsubmit=\"AddRow()\"><input type=\"text\" name=\"addItem\" placeholder=\"+Add Item\"></form>";
}

function hideFadeOut( el, speed ) {
    let seconds = speed/1000;
    el.style.animation = "fade-out "+seconds+"s forwards";
    //setTimeout(function() {
    //    el.style.bottom = "-9999px";
    //}, speed);
}

function showFadeIn( el, speed ) {
    let seconds = speed/1000;
    //el.style.bottom = "10px";
    el.style.animation = "fade-in "+seconds+"s forwards";
}

function showItemOptions(){
    let x = document.getElementById("itemOptionsContainer");
    if (document.getElementById("checkAll").checked == true) {
        showFadeIn(x, 500);
    } else {
        hideFadeOut(x, 500);
    }
}

// function newProject(){
//     const cm = document.getElementById("content-main").lastElementChild;
//     console.log(cm);
//     let html = `
//     <h5 class="card-header font-weight-light">Health and Sanitation Services</h5>
//     <div class="card-body">
//         <div class="container-fluid">
//             <table id="table1">
//                 <tr>
//                     <th><input type="checkbox" id="checkAll" onclick="showItemOptions()"><span class="resize-handle"></span></th>
//                     <th data-type="text-short">AIP Reference Code<span class="resize-handle"></span></th>
//                     <th data-type="text-short">Activity Description<span class="resize-handle"></span></th>
//                     <th data-type="text-short">Implementing Office<span class="resize-handle"></span></th>
//                     <th data-type="text-short">Start Date<span class="resize-handle"></span></th>
//                     <th data-type="text-short">End Date<span class="resize-handle"></span></th>
//                     <th data-type="text-short">Expected Output<span class="resize-handle"></span></th>
//                     <th data-type="text-short">Funding Services<span class="resize-handle"></span></th>
//                     <th data-type="text-short">Personal Services<span class="resize-handle"></span></th>
//                     <th data-type="text-short">Maintenance & Other Operating Expenses<span class="resize-handle"></span></th>
//                     <th data-type="text-short">Capital Outlay<span class="resize-handle"></span></th>
//                     <th data-type="text-short">Total<span class="resize-handle"></span></th>
//                 </tr>
//                 <?php 
//                     for($i = 0; count($aipRefCode) > $i; $i++){
//                         echo "<tr>
//                         <td><input type=\"checkbox\" name=\"item1\" value=\"item1\"></td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['aipRefCode']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['activityDescription']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['implementingOffice']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['startDate']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['endDate']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['expectedOutput']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['fundingServices']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['personalServices']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['maintAndOtherOperatingExpenses']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['capitalOutlay']}</td>
//                         <td data-type=\"text-short\">{$aipRefCode[$i]['total']}</td>
//                     </tr>";
//                     }
//                 ?>
//                 <tr>
//                     <td><input type="checkbox" disabled></td>
//                     <td>
//                         <form action="/" onsubmit="AddRow()">
//                             <input type="text" name="firstname" placeholder="+Add Item">
//                         </form>
//                     </td>
//                 </tr>
//             </table>
//         </div>
//     </div>
//     `;
//     cm.insertAdjacentHTML("afterend", html);
//     //cm.remove();
//     //document.getElementById("content-main").remove(); //remove card with said ID
// }
