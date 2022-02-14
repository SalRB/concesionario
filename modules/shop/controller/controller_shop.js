function loadCars() {

    ajaxPromise('modules/shop/controller/controller_shop.php?op=ShopCars',
        'GET', 'JSON')


        // $.ajax({
        //     url: 'modules/shop/controller/controller_shop.php?op=ShopCars',
        //     type: 'GET',
        //     dataType: 'JSON'

        .then(function (data) {
            // console.log(data);


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

                $('<div></div>').html('<h1>HELLO</h1>').attr({ 'id': "as", 'class': "as" }).appendTo('#shopPage');
                $('<div></div>').attr({ 'id': "div0", 'style': "width: 40%; margin-left: 5%;", 'class': "section" }).appendTo('#shopPage');
                $('<section></sections>').attr({ 'id': "main-slider", 'class': "section" }).appendTo('#div0');
                $('<div></div>').attr({ 'id': "div1", 'class': "carousel slide" }).appendTo('#main-slider');
                $('<ol></ol>').attr({ 'id': "ol", 'class': "carousel-indicators" }).appendTo('#div1');

                $('<div></div>').attr({ 'id': "div2", 'class': "carousel-inner" }).appendTo('#div1');


                for (row in data[1][0]) {

                    if (row == 0) {
                        $('<li></li>').attr({ 'id': "AAA", 'class': "active", 'data-target': "#main-slider", 'data-slide-to': row }).appendTo('#ol');

                        $('<div></div>').attr({ 'id': "AAA", 'class': "item active", "style": "background-image: url(views/images/cars/multipla.jpg); border-radius: 25px;" }).appendTo('#div2');
                    } else {
                        $('<li></li>').attr({ 'id': "AAA", 'data-target': "#main-slider", 'data-slide-to': row }).appendTo('#ol');

                        $('<div></div>').attr({ 'id': "AAA", 'class': "item", "style": "background-image: url(views/images/cars/multipla.jpg); border-radius: 25px;" }).appendTo('#div2');
                    }





                }

                $('<a></a>').attr({ 'id': "arrow1", 'class': "prev hidden-xs hidden-sm", 'href': "main-slider", 'data-slide': "prev" }).appendTo('#main-slider');
                $('<i></i>').attr({ 'class': "fa fa-chevron-left" }).appendTo('#arrow1');
                $('<a></a>').attr({ 'id': "arrow2", 'class': "next hidden-xs hidden-sm", 'href': "main-slider", 'data-slide': "next" }).appendTo('#main-slider');
                $('<i></i>').attr({ 'class': "fa fa-chevron-right" }).appendTo('#arrow2');












            }).catch(function () {
                window.location.href = "index.php?module=exceptions&op=503&message=Error_loadDetails_js";
            });
    });
}

function loadDivs() {
    // $('<h1></h1>').html('HEY').appendTo('#shopPage').attr("style", "padding-bottom: 50px");
    // $('<div></div>').attr({ 'id': "shop", 'class': 'row' }).appendTo('#shopPage');

    loadCars();
    loadDetails();
}



$(document).ready(function () {
    loadDivs();
});
