let i = 0;
let clickHandler//
let previousClickHandler;
let previousId = "p0";

function addToTextBox(){
    let textFieldName = document.getElementById("textFieldName").value;
    let comboType = document.getElementById("comboType").value;
    let textBox = document.getElementById("textBox");

    let s1 = "<span id='s"+ i +"0'>" + textFieldName + "</span>";
    let s2 = "<span id='s"+ i +"1'>" + comboType + "</span>";
    let p = "<p onclick='getId(id)'id='p"+ i +"'>" + s1 + s2 + "</p>";

    textBox.innerHTML += p;
    i++;

    let textBoxContent = textBox.innerHTML;
    document.getElementById("textBoxContent").value = textBoxContent;
}
function getId(id) {
    p_previousId = document.getElementById(previousId);
    p_previousId.style.backgroundColor = "#f2f2f2";

    let p_currentId = document.getElementById(id);
    p_currentId.style.backgroundColor = "#45a049";


    buttonRemove.removeEventListener("click", previousClickHandler, false);
    clickHandler = function() {

    };

    buttonRemove.addEventListener("click", clickHandler, false);
    previousClickHandler = clickHandler;
    previousId = id;
}


