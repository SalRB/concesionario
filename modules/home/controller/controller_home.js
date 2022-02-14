function loadSlider() {


    ajaxPromise('modules/home/controller/controller_home.php?op=HomeBrands',
        'GET', 'JSON')

        .then(function (data) {

            $('<div></div>').attr('id', 'Div1').appendTo('#slider');

            $('#Div1').html(function () {
                var content = "";
                content += `<section id="main-slider" class="no-margin">
                <div class="carousel slide">
                    <ol class="carousel-indicators">`

                for (row_num in data) {
                    if (row_num == 0) {
                        content += `<li data-target="#main-slider" data-slide-to="` + row_num + `" class="active"></li>`

                    } else {
                        content += `<li data-target="#main-slider" data-slide-to="` + row_num + `"></li>`
                    }
                }

                content += `
                        </ol>
                    <div class="carousel-inner">`
                for (row in data) {
                    content += `<div class="item`
                    if (row == 0) {
                        content += ` active`
                    } content += `" style="background-image: url(views/images/home/` + data[row].brand_image + `)">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="carousel-content">
                                            <h1 class="animation animated-item-1">` + data[row].brand_name + `</h1>
                                            <a class="btn-slide animation animated-item-3" href="#">Learn More</a>
                                            <a class="btn-slide white animation animated-item-3" href="#">Get Started</a>
                                        </div>
                                    </div>
            
                                </div>
                            </div>
                        </div>`
                }

                content += `</div>
                </div>
                <a class="prev hidden-xs hidden-sm" href="#main-slider" data-slide="prev">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <a class="next hidden-xs hidden-sm" href="#main-slider" data-slide="next">
                    <i class="fa fa-chevron-right"></i>
                </a>
            </section>`;
                return content;
            });



        }).catch(function () {
            window.location.href = "index.php?module=exceptions&op=503&message=Error_Slider_js";

        });
}

function loadCategories() {

    ajaxPromise('modules/home/controller/controller_home.php?op=HomeCategories',
        'GET', 'JSON')

        .then(function (data) {
            console.log(data);


            $('<section></section>').attr({ 'id': "feature" }).appendTo('#categories');
            $('<div></div>').attr({ 'id': "div1", 'class': 'container' }).appendTo('#feature');
            $('<div></div>').attr({ 'id': "div2", 'class': 'center fadeInDown' }).appendTo('#div1');
            $('<h2></h2>').html('HEY').appendTo('#div2');
            $('<div></div>').attr({ 'id': "div3", 'class': 'row' }).appendTo('#div1');
            $('<div></div>').attr({ 'id': "div4", 'class': 'features' }).appendTo('#div3');



            for (row in data) {

                $('<div></div>').attr({ 'id': "div5" + row, 'class': 'col-md-3 col-sm-4 fadeInDown' }).appendTo('#div4');
                $('<a></a>').attr({ 'id': "div6" + row, 'href': 'https://www.youtube.com/' }).appendTo('#div5' + row);
                $('<div></div>').attr({ 'id': "div7" + row, 'class': 'feature-wrap' }).appendTo('#div6' + row);
                $('<img></img>').attr({ 'id': "div8" + row, 'src': 'views/images/home/' + data[row].category_image + '', 'style': 'border-radius: 5px' }).appendTo('#div7' + row);
                $('<h2></h2>').html(data[row].category_name).attr({ 'id': "div9", 'style': 'padding-top: 1em' }).appendTo('#div7' + row);



            }


        }).catch(function () {
            window.location.href = "index.php?module=exceptions&op=503&message=Error_Categories_js";
        });
}

function loadTypes() {

    ajaxPromise('modules/home/controller/controller_home.php?op=HomeTypes',
        'GET', 'JSON')

        .then(function (data) {
            console.log(data);


            $('<section></section>').attr({ 'id': "feature" }).appendTo('#types');
            $('<div></div>').attr({ 'id': "div11", 'class': 'container' }).appendTo('#feature');
            $('<div></div>').attr({ 'id': "div12", 'class': 'center fadeInDown' }).appendTo('#div11');
            $('<h2></h2>').html('HEY').appendTo('#div12');
            $('<div></div>').attr({ 'id': "div13", 'class': 'row' }).appendTo('#div11');
            $('<div></div>').attr({ 'id': "div14", 'class': 'features' }).appendTo('#div13');



            for (row in data) {

                $('<div></div>').attr({ 'id': "div15" + row, 'class': 'col-md-3 col-sm-4 fadeInDown' }).appendTo('#div14');
                $('<a></a>').attr({ 'id': "div16" + row, 'href': 'https://www.youtube.com/' }).appendTo('#div15' + row);
                $('<div></div>').attr({ 'id': "div17" + row, 'class': 'feature-wrap' }).appendTo('#div16' + row);
                $('<img></img>').attr({ 'id': "div18" + row, 'src': 'views/images/home/' + data[row].type_image + '', 'style': 'border-radius: 5px' }).appendTo('#div17' + row);
                $('<h2></h2>').html(data[row].type_name).attr({ 'id': "div19", 'style': 'padding-top: 1em' }).appendTo('#div17' + row);



            }


        }).catch(function () {
            window.location.href = "index.php?module=exceptions&op=503&message=Error_Categories_js";
        });
}


function loadDivs() {
    $('<div></div>').attr({ 'id': "slider", 'class': 'row' }).appendTo('#homePage');
    $('<h1></h1>').html('HEY').appendTo('#homePage').attr("style", "padding-bottom: 50px");
    $('<div></div>').attr({ 'id': "categories", 'class': 'row' }).appendTo('#homePage');
    $('<div></div>').attr({ 'id': "types", 'class': 'row' }).appendTo('#homePage');

    loadSlider();
    loadCategories();
    loadTypes();
}

$(document).ready(function () {
    loadDivs();
});
