function loadCars() {

    ajaxPromise('modules/shop/controller/controller_shop.php?op=ShopCars',
        'GET', 'JSON')

        .then(function (data) {

            $('<div></div>').attr({ 'id': "cosa0", 'class': "cosa0" }).appendTo('#shopPage');

            for (row in data) {
                $('<div></div>').attr({ 'class': data[row].ID, 'id': "cosa1" }).appendTo('.cosa0');
                $('<div></div>').attr({ 'class': "cosa3" + row, 'id': "cosa3" }).appendTo('.' + data[row].ID);
                $('<div></div>').attr({ 'class': "clearfix" + row, 'id': "clearfix" }).appendTo('.' + data[row].ID);
                $('<h1></h1>').html(data[row].brand + ' ' + data[row].model).attr({ 'class': "cosa4" + row, 'id': "cosa4" }).appendTo('.cosa3' + row);
                $('<h1></h1>').html(data[row].price + '   ' + data[row].category).attr({ 'class': "cosa5" + row, 'id': "cosa5" }).appendTo('.cosa3' + row);
                $('<img></img>').attr({ 'class': "imagen" + row, 'id': "imagen", 'src': 'views/images/cars/' + data[row].image + '' }).appendTo('.clearfix' + row);
            }

        }).catch(function () {
            window.location.href = "index.php?module=exceptions&op=503&message=Error_loadCars_js";
        });
}
function loadDetails() {

    $(document).on('click', '#cosa1', function () {
        $("#shopPage").empty();
        var id = this.getAttribute('class');
        // console.log(id);

        ajaxPromise('modules/shop/controller/controller_shop.php?op=ShopDetails&id=' + id,
            'GET', 'JSON')

            .then(function (data) {
                console.log(data);

                // $('<div></div>').html('<h1>HELLO</h1>').attr({ 'id': "as", 'class': "as" }).appendTo('#shopPage');


                ///////////////////////////////////////////
                //                SLIDER
                ///////////////////////////////////////////

                $('<div></div>').attr({ 'id': "div0", 'style': "width: 50%; margin-left: 4%; margin-top: 50px", 'class': "section" }).appendTo('#shopPage');
                $('<section></sections>').attr({ 'id': "main-slider", 'class': "section" }).appendTo('#div0');
                $('<div></div>').attr({ 'id': "div1", 'class': "carousel slide" }).appendTo('#main-slider');
                $('<ol></ol>').attr({ 'id': "ol", 'class': "carousel-indicators", 'style': "top: 450px;" }).appendTo('#div1');

                $('<div></div>').attr({ 'id': "div2", 'class': "carousel-inner" }).appendTo('#div1');


                for (row in data[1][0]) {
                    if (row == 0) {
                        $('<li></li>').attr({ 'id': "AAA", 'class': "active", 'data-target': "#main-slider", 'data-slide-to': row }).appendTo('#ol');

                        $('<div></div>').attr({ 'id': "AAA", 'class': "item active", "style": "background-image: url(views/images/cars/" + data[1][0][row].images + "); border-radius: 25px; max-height: 500px;" }).appendTo('#div2');
                    } else {
                        $('<li></li>').attr({ 'id': "AAA", 'data-target': "#main-slider", 'data-slide-to': row }).appendTo('#ol');

                        $('<div></div>').attr({ 'id': "AAA", 'class': "item", "style": "background-image: url(views/images/cars/" + data[1][0][row].images + "); max-height: 500px; border-radius: 25px;" }).appendTo('#div2');
                    }
                }

                $('<a></a>').attr({ 'id': "arrow1", 'class': "prev hidden-xs hidden-sm", 'href': "#main-slider", 'data-slide': "prev" }).appendTo('#main-slider');
                $('<i></i>').attr({ 'class': "fa fa-chevron-left" }).appendTo('#arrow1');
                $('<a></a>').attr({ 'id': "arrow2", 'class': "next hidden-xs hidden-sm", 'href': "#main-slider", 'data-slide': "next" }).appendTo('#main-slider');
                $('<i></i>').attr({ 'class': "fa fa-chevron-right" }).appendTo('#arrow2');

                ///////////////////////////////////////////
                //            DATOS COCHE 
                ///////////////////////////////////////////

                $('<div></div>').attr({ 'id': "AAA", 'style': "position: absolute; top: 20%; left: 60%; display: contents;" }).appendTo('#shopPage').html(
                    '<div style="position: absolute; top: 20%; left: 60%;">' +
                    '<h1 style="font-size: 48px;">' + data[0].brand + ' ' + data[0].model + '</h1>' +
                    '<h1 style="font-size: 24; color: rgb(177, 41, 0);">' + data[0].price + '€</h1>' +
                    '<h1 style="font-size: 24;"><img src="views/images/icons/car-door.png" style="max-height: 45px;"> ' + data[0].doors + ' |<img src="views/images/icons/seat.png" style="max-height: 45px;">' + data[0].capacity + '</h1>' +
                    '<h1 style="font-size: 24;"><img src="views/images/icons/fuel.png" style="max-height: 45px;"> ' + data[0].type + '</h1>' +
                    '<h1 style="font-size: 24;">Estado: ' + data[0].category + '</h1>' +
                    '</div>'

                );

            }).catch(function () {
                window.location.href = "index.php?module=exceptions&op=503&message=Error_loadDetails_js";
            });
    });
}

function filters() {

    var talla = [];
    var color = [];
    var categoria = [];
    var filters = [];

    localStorage.removeItem('filters');

    $.each($("input[id='talla']:checked"), function () {
        talla.push($(this).val());
    });
    if (talla.length != 0) {
        filters.push({ "talla": talla });
    }

    $.each($("input[id='color']:checked"), function () {
        color.push($(this).val());
    });
    if (color.length != 0) {
        filters.push({ "color": color });
    }

    $.each($("input[id='categoria']:checked"), function () {
        categoria.push($(this).val());
    });

    if (categoria.length != 0) {
        filters.push({ "categoria": categoria });
    }

    if (filters.length != 0) {
        localStorage.setItem('filters', JSON.stringify(filters));
    }

    document.filter.submit();
    document.filter.action = "index.php?page=controller_shop.php?op=view";




}





function loadDivs() {
    loadCars();
    loadDetails();
    filters();
}

$(document).ready(function () {
    loadDivs();
});
