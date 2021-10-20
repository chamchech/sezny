function Change() {

    if ((document.getElementById('case_1').checked)) {
        document.getElementById('dynamicForm').style.display="block";
    }
    else {
        document.getElementById('dynamicForm').style.display="none";
    }
}


function ChangePack() {

    if ((document.getElementById('packautre').checked)) {
        document.getElementById('dynamicFormPack').style.display="block";
    }
    else {
        document.getElementById('dynamicFormPack').style.display="none";
    }
}
