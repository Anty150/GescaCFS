let i = 0;
let clickHandler//
let previousClickHandler;
let previousId = "p0";

function addToTextBox(){
    let textName = document.getElementById("textName").value;
    let textFieldName = document.getElementById("textFieldName").value;
    let comboType = document.getElementById("comboType").value;
    let textBox = document.getElementById("textBox");

    if (textName == ""){
        alert("Name cannot be empty.");
        return 0;
    }
    if (textFieldName == ""){
        alert("Field name cannot be empty.");
        return 0;
    }

    let s1 = "<span id='s"+ i +"0'>" + textFieldName + "</span>";
    let s2 = "<span id='s"+ i +"1'>" + comboType + "</span>";
    let p = "<p onclick='operationsOnRows(id)'id='p"+ i +"'>" + s1 + s2 + "</p>";

    textBox.innerHTML += p;
    i++;

    let textBoxContent = textBox.innerHTML;
    document.getElementById("textBoxContent").value = textBoxContent;
}
function operationsOnRows(id) {
    buttonRemove.removeEventListener("click", previousClickHandler, false);
    clickHandler = function() {
        const rowToRemove = document.getElementById(id);
        rowToRemove.remove();
        return 0;
    };
    buttonRemove.addEventListener("click", clickHandler, false);
    previousClickHandler = clickHandler;

    p_previousId = document.getElementById(previousId);
    if (p_previousId !== null) {
        p_previousId.style.backgroundColor = "#f2f2f2";
    }
    previousId = id;

    let p_currentId = document.getElementById(id);
    if (p_currentId !== null) {
        p_currentId.style.backgroundColor = "#45a049";
    }
}


