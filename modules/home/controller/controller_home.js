function loadSlider() {

    $.ajax({
        url: 'modules/home/controller/controller_home.php?op=HomeBrands',
        type: 'GET',
        dataType: 'JSON'
    }).done(function (data) {

        $('<div></div>').attr('id', 'Div1').appendTo('.hero-slider-1');

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



    }).fail(function () {
        window.location.href = "index.php?module=exceptions&op=503&message=Error_Slider_js";

    });
}

function loadCategories(loadeds = 0) {
    $.ajax({
        url: 'modules/home/controller/controller_home.php?op=HomeBrands',
        type: 'GET',
        dataType: 'JSON'
    }).done(function (data) {
        for (row in data) {


        }


    }).fail(function () {
        window.location.href = "index.php?module=exceptions&op=503&message=Error_Categories_js";
    });
}


function loadDivs() {
    loadSlider();
    loadCategories();
    // loadTypes();
}

$(document).ready(function () {
    loadDivs();
});
