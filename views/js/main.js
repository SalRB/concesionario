/*==================== LOAD MENU ====================*/
function load_menu() {

    $('<li></li>').attr({ 'id': 'liLogin' }).appendTo('#ulMenu');  // header.html linea 75
    ajaxPromise('modules/login/controller/controller_login.php?op=data_user', 'POST', 'JSON',
        { token: localStorage.getItem('token') })
        .then(function (data) {
            $('<a></a>').attr({ 'class': 'menu-btn', 'id': 'logout' }).html('Log out').appendTo('#liLogin');
        }).catch(function (e) {
            $('<a></a>').attr({ 'class': 'menu-btn', 'id': 'login', 'href': 'index.php?module=login&op=list' }).html('Login').appendTo('#liLogin');
        });
}

/*==================== CLICK LOGOUT ====================*/
function click_logout() {
    $(document).on('click', '#logout', function () {
        logout();
    });
}

/*==================== LOGOUT ====================*/
function logout() {
    $.ajax({
        url: 'modules/login/controller/controller_login.php?op=logout',
        type: 'POST',
        dataType: 'JSON'
    }).done(function (data) {
        console.log(data);
        localStorage.removeItem('token');
        window.location.href = "index.php?module=home&op=list";
    }).fail(function (e) {
        console.log(e);
    });
}

$(document).ready(function () {
    load_menu();
    click_logout();
});