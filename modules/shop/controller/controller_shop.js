function loadCars() {
    $.ajax({
        url: 'modules/shop/controller/controller_shop.php?op=ShopCars',
        type: 'GET',
        dataType: 'JSON'
    }).done(function (data) {
        console.log(data);


        $('<section></section>').attr({ 'id': "feature" }).appendTo('#types');



        for (row in data) {



        }


    }).fail(function () {
        window.location.href = "index.php?module=exceptions&op=503&message=Error_loadCars_js";
    });
}


function loadDivs() {
    $('<h1></h1>').html('HEY').appendTo('#shopPage').attr("style", "padding-bottom: 50px");
    $('<div></div>').attr({ 'id': "types", 'class': 'row' }).appendTo('#shopPage');

    loadCars();
}

$(document).ready(function () {
    loadDivs();
});
