function OnClick() {

  $(document).on('click', '#cosa3', function () {
    var id = this.getAttribute('car_id');

    CountVisits(id);
    loadDetails(id);
  });

  $(document).on('click', '#divpopup', function () {
    var id = this.getAttribute('class');

    CountVisits(id);
    loadDetails(id);
  });

  $(document).on('click', '.related_car', function () {
    var id = this.getAttribute('car_id');

    var related = [];
    related.push({ "limit": 3 });
    related.push({ "offset": -3 });
    localStorage.setItem('related', JSON.stringify(related));

    CountVisits(id);
    loadDetails(id);
  });

  $(document).on('click', '#relatedButton', function () {
    var id = this.getAttribute('class');

    LoadRelated(id);

  });

}

function loadDetails(id) {

  $("#shopPage").empty();

  ajaxPromise('modules/shop/controller/controller_shop.php?op=ShopDetails&id=' + id,
    'GET', 'JSON')

    .then(function (data) {

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
        '<h1 style="font-size: 24;"><img src="views/images/icons/car-door.png" style="max-height: 45px;"> ' + data[0].type + ' |<img src="views/images/icons/seat.png" style="max-height: 45px;">' + data[0].capacity + '</h1>' +
        '<h1 style="font-size: 24;"><img src="views/images/icons/fuel.png" style="max-height: 45px;"> ' + data[0].type + '</h1>' +
        '<h1 style="font-size: 24;">Estado: ' + data[0].category + '</h1>' +
        '</div>'

      );

      ///////////////////////////////////////////
      //                 MAPA 
      ///////////////////////////////////////////

      $('<div></div>').attr({ 'id': "map", 'style': "width: 100%; height: 500px; margin-top: 33px;" }).appendTo('#shopPage');

      addAPI();

      CreateMap();

      AddMarker(data);

      LoadRelated(id);

    }).catch(function () {
      window.location.href = "index.php?module=exceptions&op=503&message=Error_loadDetails_js";
    });
}

function ajaxForSearch(durl, method = 'GET', params) {
  var url = durl;
  console.log('afax for busqueda');
  ajaxPromise(url,
    method, 'JSON', { params })

    .then(function (data) {
      console.log(data);
      $("#divCars").empty();

      $('<div></div>').attr({ 'id': "divCars", 'class': "divCars" }).appendTo('#shopPage');
      $('<div></div>').attr({ 'id': "divPagination", 'class': "divPagination", 'style': 'margin-left: auto; margin-right: auto; width: 250px;' }).appendTo('#shopPage');
      $('<div></div>').attr({ 'id': "cosa0", 'class': "cosa0" }).appendTo('#divCars');
      // $("#AAA").empty();
      // $('<div></div>').attr({ 'id': "AAA", 'class': "AAA", 'style': "float: left; height: 750px; position: fluid;" }).appendTo('#shopPage').html('<p> </p>');
      $('<div></div>').attr({ 'id': "map", 'style': "margin-right: 2%; position: fixed; top: 50px; right: 1px; width: 422px; height: 700px; border-radius: 5px; margin-top: 133px;" }).appendTo('#divCars');

      addAPI();
      CreateMap();
      for (row in data) {
        $('<div></div>').attr({ 'class': data[row].ID, 'id': "cosa1", 'car_id': data[row].ID }).appendTo('.cosa0');
        $('<div></div>').attr({ 'class': "cosa3" + row, 'id': "cosa3", 'car_id': data[row].ID }).appendTo('.' + data[row].ID);
        $('<div></div>').attr({ 'class': "clearfix" + row, 'id': "clearfix" }).appendTo('.' + data[row].ID);
        $('<h1></h1>').html(data[row].brand + ' ' + data[row].model).attr({ 'class': "cosa4" + row, 'id': "cosa4" }).appendTo('.cosa3' + row);
        $('<h1></h1>').html(data[row].price + '€  ' + data[row].category).attr({ 'class': "cosa5" + row, 'id': "cosa5" }).appendTo('.cosa3' + row);
        $('<h1></h1>').html(data[row].km + ' KM').attr({ 'class': "cosa5" + row, 'id': "cosa5" }).appendTo('.cosa3' + row);
        $('<div></div>').attr({ 'class': "divImagen" + data[row].ID, 'id': "divImagen" + data[row].ID, 'style': 'position: relative;' }).appendTo('.clearfix' + row);
        $('<img></img>').attr({ 'class': "imagen" + row, 'id': "imagen", 'src': 'views/images/cars/' + data[row].image + '' }).appendTo('#divImagen' + data[row].ID);

        // $('<i></i>').attr({ 'class': "topright fa fa-heart", 'id': "heart" }).appendTo('#divImagen' + row).html('<h3></h3>');
        $('<i></i>').attr({ 'class': "topright fa fa-heart-o elbotondelike", 'id': "heart" + data[row].ID, 'car_id': data[row].ID }).appendTo('#divImagen' + data[row].ID).html('<h3></h3>');


        // $('<div></div>').attr({ 'class': "heart", 'id': data[row].ID, 'style': "position: static;" }).appendTo('.cosa3' + row).html('<h3>REXTVUYGIHOIJPOK^PL</h3>');
        // $('<i></i>').attr({ 'class': "bx bx-heart", 'id': 'like' }).appendTo('#cosa4').html('<h1>REXTVUYGIHOIJPOK^PL</h1>');

        AddMarker(data, row);
      }
      if (data[0].length == 0) {
        $("#divCars").empty();
        $('<h1></h1>').html('Sin resultados para estos criterios').attr({ 'id': "A", 'style': 'margin-left: 55px;' }).appendTo('#divCars');
        // $('<div></div>').attr({ 'id': "A", 'style': 'margin-left: 55px;' }).appendTo('#divCars').html('<h1>Sin resultados para estos criterios<h1/>');
      }

      load_like();

    }).catch(function () {
      $("#divCars").empty();
      $('<h1></h1>').html('Sin resultados para estos criterios').attr({ 'id': "A", 'style': 'margin-left: 400px; position: absolute; top: 233px;' }).appendTo('#divCars');

    });
}

function countCars(durl, method = 'GET', params) {
  var url = durl;

  ajaxPromise(url,
    method, 'JSON', { params })

    .then(function (data) {

      var total_pages = 0;
      var total_prod = data['counted'];
      // console.log('Productos totales ' + total_prod);
      if (total_prod >= 3) {
        total_pages = total_prod / 3;
        total_pages = Math.ceil(total_pages);
        // console.log(total_pages);
      } else {
        total_pages = 1;
      }

      $('#divPagination').bootpag({
        total: total_pages,
        page: 1,
        maxVisible: total_pages
      }).on('page', function (event, num) {
        // console.log(total_prod);
        total_prod = 3 * (num - 1);
        // console.log(total_prod);
        if (params == undefined) {
          var pag = [];
          pag.push({ "limit": 3 });
          pag.push({ "offset": total_prod });
          ajaxForSearch('modules/shop/controller/controller_shop.php?op=AllCars', 'POST', pag);
        } else {
          params.push({ "limit": 3 });
          params.push({ "offset": total_prod });
          // console.log(params);
          ajaxForSearch('modules/shop/controller/controller_shop.php?op=Filters', 'POST', params);
        }
      });

    }).catch(function () {
      console.log('error pagination');
    });
}

function loadListCars() {
  // console.log('load list cars');
  var filters = localStorage.getItem('filters') || false;

  if (filters != false) {
    // console.log('cargar con filtros');

    all_lists_products();
  } else {
    // console.log('cargar');
    countCars('modules/shop/controller/controller_shop.php?op=CountAll');
    ajaxForSearch('modules/shop/controller/controller_shop.php?op=AllCars');
  }

}

function all_lists_products() {

  var all_filters = JSON.parse(localStorage.getItem('filters'));
  // console.log(all_filters);

  countCars('modules/shop/controller/controller_shop.php?op=CountWithFilters', 'POST', all_filters);
  ajaxForSearch('modules/shop/controller/controller_shop.php?op=Filters', 'POST', all_filters);


  // const filter_names = ['brand', 'type'];
  // let filter_url = '?op=Filters';
  // console.log(localStorage.getItem('filters'));

  // let todo = JSON.parse(localStorage.getItem('filters'));
  // // todo = btoa(todo);
  // console.log(todo);

  // todo.forEach(filter_type => {
  //   filter_names.forEach(name => {
  //     if (filter_type[name] !== undefined) {
  //       // filter_url = filter_url + '&' + name + '="' + filter_type[name] + '"';
  //       filter_url = filter_url + '&' + name + '=' + filter_type[name];
  //     }

  //   })
  // });

}

function printFilters() {

  ajaxPromise('modules/shop/controller/controller_shop.php?op=FiltersContent',
    'GET', 'JSON')

    .then(function (data) {

      // console.log(data);

      $('<div></div>').attr({ 'id': "AAA", 'style': "margin-left: 3%; position: absolute; top: 233px" }).appendTo('#shopPage').html(
        '<form id="form">' +
        '</select>' +
        '</form>'
      )

      $('<h4></h4>').appendTo('#form').html('Brands:');

      for (row1 in data[0]) {
        $('<br></br>').appendTo('#form');
        $('<input></input>').attr({ 'id': data[0][row1].brand, 'value': data[0][row1].brand, 'type': "checkbox", 'class': 'brand' }).appendTo('#form').html(data[0][row1].brand);
        $('<label></label>').attr({ 'id': "brand", 'for': data[0][row1].brand }).appendTo('#form').html(data[0][row1].brand);
      }

      $('<br></br>').appendTo('#form');
      $('<br></br>').appendTo('#form');
      $('<h4></h4>').appendTo('#form').html('Type:');

      for (row2 in data[1]) {
        $('<br></br>').appendTo('#form');
        $('<input></input>').attr({ 'id': data[1][row2].type, 'value': data[1][row2].type, 'type': "checkbox", 'class': 'type' }).appendTo('#form').html(data[1][row2].type);
        $('<label></label>').attr({ 'id': "type", 'for': data[1][row2].type }).appendTo('#form').html(data[1][row2].type);
      }

      $('<br></br>').appendTo('#form');
      $('<br></br>').appendTo('#form');
      $('<h4></h4>').appendTo('#form').html('Category:');

      for (row3 in data[2]) {
        $('<br></br>').appendTo('#form');
        $('<input></input>').attr({ 'id': data[2][row3].category, 'value': data[2][row3].category, 'type': "checkbox", 'class': 'category' }).appendTo('#form').html(data[2][row3].type);
        $('<label></label>').attr({ 'id': "category", 'for': data[2][row3].category }).appendTo('#form').html(data[2][row3].category);
      }

      $('<br></br>').appendTo('#form');
      $('<br></br>').appendTo('#form');
      $('<h4></h4>').appendTo('#form').html('Order by:');


      $('<br></br>').appendTo('#form');
      $('<select></select>').attr({ 'id': "orderBySelect", 'name': "orderBySelect" }).appendTo('#form');
      $('<option></option>').attr({ 'value': 'none', 'selected': '', 'disabled': '', 'hidden': '' }).appendTo('#orderBySelect').html('By');
      $('<option></option>').attr({ 'value': 'price' }).appendTo('#orderBySelect').html('price');
      $('<option></option>').attr({ 'value': 'km' }).appendTo('#orderBySelect').html('km');


      $('<br></br>').appendTo('#form');
      $('<button></button>').attr({ 'style': "margin-top: 20px;", 'id': 'button', 'type': 'button' }).appendTo('#form').html('Submit');
      $('<button></button>').attr({ 'style': "margin-top: 20px;", 'id': 'reset', 'type': 'button' }).appendTo('#form').html('Reset');


      var filters = localStorage.getItem('filters') || false;

      if (filters != false) {
        hightlight();
      }

    }).catch(function () {
      window.location.href = "index.php?module=exceptions&op=503&message=Error_loading_filters_js";
    });

  $(document).on('click', '#button', function () {
    SaveFilters();
    loadListCars();
  });

  $(document).on('click', '#reset', function () {
    RemoveFilters();
  });

}

function hightlight() {
  console.log('hightlight');
  var filters = JSON.parse(localStorage.getItem('filters'));
  console.log(filters);

  var count = 0;

  // if (filters[count]['brand']) {
  //   console.log('____________________');
  //   console.log(filters[count]['brand']);
  // } else{
  //   console.log(filters[count]['brand']);
  // }

  // if (!filters[count]['brand']) {
  //   console.log('____________________');
  //   console.log(filters[count]['brand']);
  // } else{
  //   console.log(filters[count]['brand']);
  // }



  // if (!!filters[count]['brand'] !== undefined) {
  //   for (values in filters[count]['brand']) {
  //     document.getElementById(filters[count]['brand'][values]).checked = true;
  //   }
  //   count++;
  // }

  // if (filters[count]['type'] !== undefined) {
  //   for (values in filters[count]['type']) {
  //     document.getElementById(filters[count]['type'][values]).checked = true;
  //   }
  //   count++;
  // }

  // if (filters[count]['category']) {
  //   for (values in filters[count]['category']) {
  //     document.getElementById(filters[count]['category'][values]).checked = true;
  //   }
  //   count++;
  // }

  // document.getElementById("brand1").checked = true;
  // document.getElementById('TOYOTA').setAttribute('checked', true);

}

function RemoveFilters() {
  localStorage.removeItem('filters');
  location.reload();
}

function SaveFilters() {

  var brand = [];
  var type = [];
  var category = [];
  var filters = [];
  var orderby = [];

  localStorage.removeItem('filters');

  $.each($("input[class='brand']:checked"), function () {
    brand.push($(this).val());
  });
  if (brand.length != 0) {
    filters.push({ "brand": brand });
  }

  $.each($("input[class='type']:checked"), function () {
    type.push($(this).val());
  });
  if (type.length != 0) {
    filters.push({ "type": type });
  }

  $.each($("input[class='category']:checked"), function () {
    category.push($(this).val());
  });
  if (category.length != 0) {
    filters.push({ "category": category });
  }

  if ($('#orderBySelect').val() != null) {
    console.log($('#orderBySelect').val());
    orderby = $('#orderBySelect').val();
    filters.push({ "orderby": orderby });

  }



  if (filters.length != 0) {
    localStorage.setItem('filters', JSON.stringify(filters));
  }

  // document.filter.submit();
  // document.filter.action = "index.php?page=controller_shop.php?op=view";
}

function addAPI() {
  mapboxgl.accessToken = 'pk.eyJ1IjoicHVlc2JpZW4zMyIsImEiOiJjbDAxMzEyb3cwcWIzM2p0MWoyZmxlNTE1In0.sQ3TcqT8uywjfN41dlymqw';
}

function CreateMap() {
  map = new mapboxgl.Map({
    container: 'map', // container ID
    style: 'mapbox://styles/mapbox/streets-v11', // style URL
    center: [-0.6000854943333472, 38.82222699462896], // starting position [lng, lat]
    zoom: 9 // starting zoom
  });
}

function AddMarker(data, row = '0') {

  const popup = new mapboxgl.Popup({ offset: 25 }).setHTML('<div class=' + data[row].ID + '" id="divpopup"><img src="views/images/cars/' + data[row].image + '">' +
    '<h4>' + data[row].brand + ' ' + data[row].model + '</h4>' +
    '<h4 style="color: rgb(177, 41, 0);">' + data[row].price + ' €</h4></div>');

  const marker1 = new mapboxgl.Marker()
    .setLngLat([data[row].lon, data[row].lat])
    .setPopup(popup) // sets a popup on this markers
    .addTo(map);

}

function CountVisits(id) {

  ajaxPromise('modules/shop/controller/controller_shop.php?op=CountVisits&id=' + id,
    'GET', 'JSON')

}

function LoadRelated(id) {
  // console.log(id);
  var related = JSON.parse(localStorage.getItem('related'));

  if (related[1]['offset'] == -3) {
    related.push({ "id": id });
  }
  related[1]['offset'] = related[1]['offset'] + 3;
  // console.log(related);

  localStorage.setItem('related', JSON.stringify(related));

  ajaxPromise('modules/shop/controller/controller_shop.php?op=LoadRelated',
    'POST', 'JSON', { related })
    .then(function (data) {
      // console.log(data);

      $('<div></div>').attr({ 'id': "divRelated", 'style': "width: 70%; height: 500px; margin-top: 33px; margin-left: auto; margin-right: auto;" }).appendTo('#shopPage');
      $('<div></div>').attr({ 'id': "divRelatedItems", 'style': "width: 100%; margin-top: 5 px;" }).appendTo('#divRelated');

      for (row in data) {
        $('<div></div>').attr({ 'id': "related" + data[row].ID, 'style': "margin-top: 3px; width: 20%;", 'class': 'related_car', 'car_id': data[row].ID }).appendTo('#divRelatedItems').html('<h1>' + data[row].brand + '</h1>');
        $('<img></img>').attr({ 'id': "img", "src": "views/images/cars/" + data[row].image, 'style': "margin-top: 3px; width: 100%;" }).appendTo('#related' + data[row].ID).html('<h1>' + data[row].brand + '</h1>');
      }

      $('#divButton').empty();

      if (data.length != 3) {
        $('<div></div>').attr({ 'id': "BB", 'style': "margin-top: 3px; margin: auto; width: 380px;" }).appendTo('#divRelated').html('<h1>No more related cars</h1>');
      } else {
        $('<div></div>').attr({ 'id': "divButton", 'style': "margin-top: 3px; margin: auto; width: 202px;" }).appendTo('#divRelated');
        $('<button></button>').attr({ 'id': "relatedButton", 'style': "" }).appendTo('#divButton').html('<h1>Load More</h1>');
      }

    }).catch(function () {
      console.log('error total_items');
    });
}

function load_like() {
  if (localStorage.getItem('token')) {
    ajaxPromise('modules/shop/controller/controller_shop.php?op=load_likes', 'POST', 'JSON',
      { token: localStorage.getItem('token') })
      .then(function (data) {
        console.log(data);
        for (row in data) {
          if ($("#divImagen" + data[row].car).children("i").hasClass("fa-heart-o")) {
            $("#divImagen" + data[row].car).children("i").removeClass("fa-heart-o").addClass("fa-heart");
          }
        }
      }).catch(function (e) {
        console.log(e);
      });

  }
}

function click_like() {
  $(document).on('click', '.elbotondelike', function () {
    if (!localStorage.getItem('token')) {
      window.location.href = "index.php?module=login&op=list";

      // if ($(this).children("i").hasClass("bx-heart")) {
      //   $(this).children("i").removeClass("bx-heart").addClass("bxs-heart");
      //   like_storage(this.getAttribute('id'), like);
      // } else {
      //   $(this).children("i").removeClass("bxs-heart").addClass("bx-heart");
      //   like_storage(this.getAttribute('id'), like);
      // }
    } else {
      ajaxPromise("modules/shop/controller/controller_shop.php?op=control_likes", 'POST', 'JSON', { token: localStorage.getItem('token'), id: this.getAttribute('car_id') })
        .then(function (data) {
          console.log(data);
        }).catch(function (e) {
          console.log(e);
          // window.location.href = 'index.php?page=error503'
        });

      if ($(this).hasClass("fa-heart")) {
        $(this).removeClass("fa-heart").addClass("fa-heart-o");
      } else {
        $(this).removeClass("fa-heart-o").addClass("fa-heart");
      }
    }
  });
}

function like_storage(id) {
  var local = localStorage.getItem('likes');

  if (local != null) {
    var like = JSON.parse(local);
  } else {
    var like = [];
  }

  if (like.indexOf(id) === -1) {
    like.push(id);
  } else if (like.indexOf(id) !== -1) {
    like.splice(like.indexOf(id), 1);
  }

  localStorage.setItem('likes', JSON.stringify(like));
}

$(document).ready(function () {
  const map = null;
  var related = [];
  related.push({ "limit": 3 });
  related.push({ "offset": -3 });
  // console.log(related);
  localStorage.setItem('related', JSON.stringify(related));

  // console.log(Math.ceil(3.2));

  printFilters();
  loadListCars();
  OnClick();
  click_like();
});
