let i = 0;
let clickHandler;
let previousClickHandler;
let previousId = "p0";
let isSelected = false;

function addToTextBox(){
    let textName = document.getElementById("textName").value;
    let textFieldName = document.getElementById("textFieldName").value;
    let comboType = document.getElementById("comboType").value;
    let textBox = document.getElementById("textBox");

    if (textName === ""){
        alert("El nombre no puede estar vacío.");
        return 0;
    }
    if (textFieldName === ""){
        alert("El nombre del campo no puede estar vacío.");
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
    isSelected = true;
    buttonRemove.removeEventListener("click", previousClickHandler, false);
    clickHandler = function() {
        if(isSelected){
            const rowToRemove = document.getElementById(id);
            removeElementFromHiddenInput(rowToRemove);
            rowToRemove.remove();
            isSelected = false;
        }
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
function removeElementFromHiddenInput(elementToDelete){
    let textBox = document.getElementById("textBoxContent");
    let textBoxContent = textBox.value;

    elementToDelete = cutElement(elementToDelete);
    textBox.setAttribute("value", textBoxContent.replace(elementToDelete,""))
    console.log(textBoxContent);
}
function cutElement(element){
    let positionToReplaceFirstIndex = element.outerHTML.search(" style");
    let positionToReplaceLastIndex = element.outerHTML.search(";");

    let newElement = element.outerHTML.replace(element.outerHTML.substring(positionToReplaceFirstIndex, positionToReplaceLastIndex+2), "");
    return newElement
}


