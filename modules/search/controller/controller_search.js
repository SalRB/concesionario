function load_search() {

  $('<div></div>').attr({ 'id': "divSearch", 'class': "" }).appendTo('#search'); //#search en header.html linea 68
  $('<select></select>').attr({ 'id': "category", 'name': "category" }).appendTo('#divSearch');
  $('<select></select>').attr({ 'id': "brand", 'name': "brand" }).appendTo('#divSearch');
  $('<input></input>').attr({ 'id': "city", 'type': "text", 'autocomplete': "off" }).appendTo('#divSearch');
  $('<div></div>').attr({ 'id': "divcity" }).appendTo('#divSearch');
  $('<i></i>').attr({ 'id': "searchButton", 'class': "fa fa-search", 'style': "position: absolute; bottom: 10px; margin-left: 10px;" }).appendTo('#divSearch');


}

function refresh_options() {

  var category = [];
  var brand = [];
  var city = [];
  var filters = [];

  $(document).on('change', '#category', function () {
    category = [];
    brand = [];
    filters = [];
    city = [];
    category.push($('#category').val());
    brand.push($('#brand').val());
    filters.push({ "category": category });
    filters.push({ "brand": brand });
    filters.push({ "city": city });
    // localStorage.removeItem('filters_search');
    localStorage.setItem('filters_search', JSON.stringify(filters));
    load_brands();

  });

  // $(document).on('change', '#brand', function () {
  //   category = [];
  //   brand = [];
  //   filters = [];
  //   city = [];
  //   category.push($('#category').val());
  //   brand.push($('#brand').val());
  //   filters.push({ "category": category });
  //   filters.push({ "brand": brand });
  //   filters.push({ "city": city });
  //   // localStorage.removeItem('filters_search');
  //   localStorage.setItem('filters_search', JSON.stringify(filters));
  //   load_categories();

  // });

}

function load_categories() {
  var filters = JSON.parse(localStorage.getItem('filters_search'));

  ajaxPromise('modules/search/controller/controller_search.php?op=categories',
    'POST', 'JSON', { filters })

    .then(function (data) {

      $('#category').empty();
      $('<option></option>').attr({ 'value': 'none', 'selected': '', 'disabled': '', 'hidden': '' }).appendTo('#category').html('Category');
      for (row in data) {
        $('<option></option>').attr({ 'value': data[row].category }).appendTo('#category').html(data[row].category);
      }

    }).catch(function () {
      console.log("Fail loading categories");
    });
}

function load_brands() {
  var filters = JSON.parse(localStorage.getItem('filters_search'));

  ajaxPromise('modules/search/controller/controller_search.php?op=brands',
    'POST', 'JSON', { filters })

    .then(function (data) {

      // console.log(data);
      $('#brand').empty();
      $('<option></option>').attr({ 'value': 'none', 'selected': '', 'disabled': '', 'hidden': '' }).appendTo('#brand').html('Brand');
      for (row in data) {
        $('<option></option>').attr({ 'value': data[row].brand }).appendTo('#brand  ').html(data[row].brand);
      }

    }).catch(function () {
      console.log("Fail loading brands");
    });
}

function autocomplete() {
  $("#city").on("keyup", function () {
    filters = [];
    category = [];
    brand = [];
    city = [];

    console.log($(this).val());

    category.push($('#category').val());
    brand.push($('#brand').val());
    city.push($(this).val());
    filters.push({ "category": category });
    filters.push({ "brand": brand });
    filters.push({ "city": city });

    console.log('________');
    console.log(filters);

    ajaxPromise('modules/search/controller/controller_search.php?op=autocomplete',
      'POST', 'JSON', { filters })

      .then(function (data) {
        console.log(data);
        $('#divcity').empty();
        for (row in data) {
          $('<div></div>').appendTo('#divcity').html(data[row].city).attr({ 'class': 'option', 'id': data[row].city });
        }

        $(document).on('click', '.option', function () {
          $('#city').val(this.getAttribute('id'));
          $('#divcity').fadeOut(1000);
        });


      }).catch(function () {
        console.log("Fail loading cities");
      });
  });

}


function searchButton() {
  $("#searchButton").on("click", function () {

    if (($('#brand').val() != null) || ($('#category').val() != null) || ($('#city').val() != "")) {

      console.log($('#city').val());
      console.log('boton');

      var filters = [];

      if ($('#brand').val() != null) {
        console.log('marca tiene cosas');
        filters.push({ "brand": [$('#brand').val()] });
      }

      if ($('#category').val() != null) {
        console.log('categoria tiene cosas');
        filters.push({ "category": [$('#category').val()] });
      }

      if ($('#city').val() != "") {
        console.log('ciudad tiene cosas');
        filters.push({ "city": [$('#city').val()] });
      }

      console.log(filters);
      localStorage.removeItem('filters');

      localStorage.setItem('filters', JSON.stringify(filters));

      window.location.href = 'index.php?module=shop&op=list';

    }


  });

}


$(document).ready(function () {
  localStorage.removeItem('filters_search');
  filters = [];
  category = [];
  brand = [];
  city = [];
  filters.push({ "category": category });
  filters.push({ "brand": brand });
  filters.push({ "city": city });
  localStorage.setItem('filters_search', JSON.stringify(filters));

  load_search();
  load_categories();
  load_brands();
  refresh_options();
  autocomplete();
  searchButton();

});