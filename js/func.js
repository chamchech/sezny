function Change() {

    if ((document.getElementById('btn-check-outlined-situation').checked)) {
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

function ChangeReunion() {

    if ((document.getElementById('repoui').checked)) {
        document.getElementById('dynamicFormReunion').style.display="block";
    }
    else {
        document.getElementById('dynamicFormReunion').style.display = "none";
    }
}


function ShowTab(id)
{
    if (document.getElementById(id).style.display == 'none') {
        document.getElementById(id).style.display = 'block';
    }
    else {
        document.getElementById(id).style.display = 'none';
    }
}

$('#myList a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
})
$('#myTab input').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
})
