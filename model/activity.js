function protecturl() {

    ajaxPromise('modules/login/controller/controller_login.php?op=control_user', 'POST', 'JSON',
        { token: localStorage.getItem('token') })

        .then(function (data) {
            if ((data == 'Invalid Signature') || (data == 'invalid_user')) {
                toastr.warning('Error usuario');
                setInterval(function () { logout() }, 3000);
            }
        }).catch(function () { // Por la diferencia en el tratado de errores con el promise, se puede hacer así
            toastr.warning('Error usuario');
            setInterval(function () { logout() }, 3000);
        });
}


function actividad() {

    ajaxPromise('modules/login/controller/controller_login.php?op=actividad', 'POST')

        .then(function (data) {
            if (data == "inactivo") {
                toastr.warning('Se va a cerrar la sesión por inactividad');
                setInterval(function () { logout() }, 3000);
            }
        }).catch(function (e) {
            console.log(e);
        });
}

function refresh_token() {

    ajaxPromise('modules/login/controller/controller_login.php?op=refresh_token', 'POST', 'JSON',
        { token: localStorage.getItem('token') })
        .then(function (data) {
            console.log(data);
            localStorage.setItem("token", data);
        }).catch(function (e) {
            console.log(e);
        });
}

function refresh_cookie() {
    ajaxPromise('modules/login/controller/controller_login.php?op=refresh_cookie', 'POST')
        .then(function (data) {
            console.log('done');
        }).catch(function (e) {
            console.log(e);
        });
}

$(document).ready(function () {
    if (localStorage.getItem('token')) {

        protecturl();

        setInterval(function () {
            actividad();
        }, 111000);

        setInterval(function () {
            refresh_token();
            refresh_cookie();
        }, 5000);
    }
});
