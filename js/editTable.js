
let table1 = document.getElementById('table1');
let cells = table1.getElementsByTagName('td');

let $cell;

$('td').click(function() { // get clicked cell
    $cell = $(this);
});

for (let i=0; i<cells.length; i++){
    cells[i].onclick = function(){
        if(this.hasAttribute('data-clicked')){ // do not execute if not clicked
            return;
        }
        this.setAttribute('data-clicked', 'yes'); // check if current cell is selected or not
        this.setAttribute('data-text', this.innerHTML)

        let input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.value = this.innerHTML;
        input.style.width = this.offsetWidth - (this.clientLeft *2)+"px";
        input.style.height = this.offsetHeight - (this.clientTop *2)+"px";
        input.style.border = "0px";
        input.style.fontFamily = "inherit";
        input.style.fontSize = "inherit";
        input.style.textAlign = "inherit";
        input.style.backgroundColor = "LightGoldenRogYellow";

        input.onblur = function(){
            let td = input.parentElement;
            let old_text = input.parentElement.getAttribute('data-text');
            let new_text = this.value;

            if(old_text != new_text){
                // there are changes in the cell's text
                // save to db with Ajax
                let $row = $(this).closest("tr"),         // Finds the closest row <tr>
                    $tds = $row.find("td:nth-child(2)"); // Finds the 2nd <td> element
                
                console.log("Header Under Clicked: "+$(this).closest('table').find('th').eq($cell.index()).text());
                
                $.each($tds, function(){                // Visits every single <td> element
                    console.log("ID: "+$(this).text());        // Prints out the text within the <td>
                    // returns the AIP Reference Code
                });
                      
                td.removeAttribute('data-clicked');
                td.removeAttribute('data-text');
                td.innerHTML = new_text;
                td.style.cssText = 'padding: 5px';
                console.log("Old Value: " + old_text);
                console.log("New Value: " + new_text);
            } else { //no chaanges
                td.removeAttribute('data-clicked');
                td.removeAttribute('data-text');
                td.innerHTML = old_text;
                td.style.cssText = 'padding: 5px';
                console.log('No changes made');
            }      
        }

        addEventListener('keydown', (event) => {
            if(event.key == 'Enter'){
                input.blur();
            }
        });
        this.innerHTML = '';
        this.style.cssText = 'padding: 0px 0px';
        this.append(input);
        this.firstElementChild.select();
    }
}