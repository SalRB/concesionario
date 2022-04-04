function login() {
    if (validate_login() != 0) {
        var data = $('#login_form').serialize();
        // console.log($('#login_form').serialize());
        // ajaxPromise('modules/login/controller/controller_login.php?op=login',
        //     'POST', 'JSON', data)

        $.ajax({
            url: "modules/login/controller/controller_login.php?op=login",
            dataType: "JSON",
            type: "POST",
            data: data,
        }).done(function (result) {
            console.log(result);
            if (result == "error") {
                $("#error_login_password").html('La contraseña no es correcta');
            } else {
                localStorage.setItem("token", result);
                setTimeout(' window.location.href = "index.php?module=home&op=list"; ', 1000);
            }
        }).fail(function (e) {
            console.log(e);
        });
    }
}

function key_login() {
    $("#login_form").keypress(function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            e.preventDefault();
            login();
        }
    });
}

function button_login() {
    $('#login_button').on('click', function (e) {
        e.preventDefault();
        login();
    });
}

function validate_login() {
    var error = false;

    if (document.getElementById('l_username').value.length === 0) {
        document.getElementById('error_login_username').innerHTML = "Tienes que escribir el usuario";
        error = true;
    } else {
        document.getElementById('error_login_username').innerHTML = "";
    }

    if (document.getElementById('l_password').value.length === 0) {
        document.getElementById('error_login_password').innerHTML = "Tienes que escribir la contraseña";
        error = true;
    } else {
        document.getElementById('error_login_password').innerHTML = "";
    }

    if (error == true) {
        return 0;
    }
}

$(document).ready(function () {
    key_login();
    button_login();
});
