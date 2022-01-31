function loadSlider() {
    
    $.ajax({
        url: 'modules/home/controller/controller_home.php?op=HomeBrands',
        type: 'GET',
        dataType: 'JSON'
    }).done(function(data) {
        console.log(data);
        $('<div></div>').attr({
        "class": "single-slide", "style": "background-image: url(views/images/home)"})
        .appendTo('.hero-slider-1')
        .html('');
        for (row in data) {
            $('<div></div>').attr({'id': data[row].carPlate, 
            "class": "single-slide", "style": "background-image: url(views/images/home/" + data[row].brand_image + ")"})
            .appendTo('.hero-slider-2')
            .html('<div class= "item avtive" style="background-image: url(views/images/home/' + data[row].brand_image + ')><div class="container"><div class="row"><div class="col-md-7"><div class="carousel-content"><h1 class="animation animated-item-1">Help Finding Information Online</h1><div class="animation animated-item-2">Every new computer that’s brought home from the store has an operating system installed onto it.</div><a class="btn-slide animation animated-item-3" href="#">Learn More</a><a class="btn-slide white animation animated-item-3" href="#">Get Started</a></div></div></div></div></div>');
            // .html('<div class= "slide-content text-center"><h2>' + data[row].brand_name + '</h2></div>');
        }



        

            // $(".hero-slider").addClass('owl-carousel');
            // $(".owl-carousel").owlCarousel({
            //     items: 1,
            //     autoplay: true,
            //     animateIn: 'fadeIn',
            //     animateOut: 'fadeOutLeft',
            //     loop: true,
            //     autoplayHoverPause: true,
            //     nav: true,
            //     autoHeight:true,
            //     navText: [
            //         '<i class="fa fa-angle-left"></i>',
            //         '<i class="fa fa-angle-right"></i>'
            //     ]
            // });
    }).fail(function() {
        window.location.href = "index.php?module=exceptions&op=503&message=Error_Slider_js";

    });
}

// function loadCatBrands(loadeds = 0) {
//     let items = 3;
//     let loaded = loadeds;
//     ajaxPromise('module/home/controller/controllerHomePage.php?op=homePageCat', 
//     'POST', 'JSON', {items: items, loaded: loaded})
//     .then(function(data) {
//         for (row in data) {
//             let brand = data[row].brand.replace(/ /g, "_");
//             $('<div></div>').attr({'id': brand, 'class':'col-md-4 single-service-2'}).appendTo('#containerCategories');
//             $('<div></div>').attr({'class':'inner'})
//             .html('<img src = "' + data[row].image 
//             + '" style = "max-width: 100%; height: 100px;"><h4 style = "padding-top: 25px">' + data[row].brand + '</h4></img>')
//             .appendTo('#' + brand);
//         }
//     }).catch(function() {
//         window.location.href = 'index.php?page=error503';
//     });
// }

function loadDivs() {
    // $('<h1></h1>').html('Our Most Visited Brands').appendTo('#homePage').attr("style", "padding-bottom: 50px");
    // $('<div></div>').attr({'id': "containerCategories", 'class':'row'}).appendTo('#homePage');
    loadSlider();
    // loadCatBrands();
}

$(document).ready(function () {
    loadDivs();
});
