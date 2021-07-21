$(document).ready(function () {
    $('#rcsverif').keyup(function () {
        var rcs = $('#rcsverif').val();
        if (rcs != "") {
            $.post('js/verifform.php', { rcsverif: rcs }, function (data) {
                if (rcs.length == 9 && data != "") {
                    alert(data);
                }
            })
                .fail(function (data) {
                    alert("error");
                })
        };
    });
});

$(document).ready(function () {
    $('#mailverif').keyup(function () {
        var mail = $('#mailverif').val();
        if (mail != "") {
            $.post('js/verifform.php', { mailverif: mail }, function (data) {
                if (data != "") {
                    alert(data);
                }
            })
                .fail(function (data) {
                    alert("error");
                })
        };
    });
});

$(document).ready(function () {
    $('#raisonsocialverif').keyup(function () {
        var rs = $('#raisonsocialverif').val();
        if (rs != "") {
            $.post('js/verifform.php', { raisonsocialverif: rs }, function (data) {
                if (data != "") {
                    alert(data);
                }
            })
                .fail(function (data) {
                    alert("error");
                })
        };
    });
});

var fieldalias = "mot de passe"

function verify(element1, element2) {
    var passed = false

    if (element1.value != element2.value) {
        alert("Les deux mot de passe ne condordent pas")
        element1.select()
    }

    else
        passed = true
    return passed
}