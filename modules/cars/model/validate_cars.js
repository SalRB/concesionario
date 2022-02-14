$(function () {
    $("#release_date").datepicker({
        dateFormat: "dd/mm/yy",
        minDate: "-20Y",
        maxDate: "+0D",
        changeMonth: true,
        changeYear: true
    });
});

function validate_plate(texto) {
    if (texto.length > 0) {
        return true;
    }
    return false;
}

function validate_brand(texto) {
    if (texto.length > 0) {
        return true;
    }
    return false;
}

function validate_nombre(texto) {
    if (texto.length > 0) {
        return true;
    }
    return false;
}

function validate_release_date(texto) {
    if (texto.length > 0) {
        return true;
    }
    return false;
}

function validate_model(texto) {
    if (texto.length > 0) {
        return true;
    }
    return false;
}

function validate_color(texto) {
    if (texto.length > 0) {
        return true;
    }
    return false;
}

function validate_capacity(texto) {
    if (texto.length > 0) {
        return true;
    }
    return false;
}




function validate_js(state) {
    // console.log('hola validate js');
    // return true;

    var check = true;

    var v_plate = document.getElementById('plate').value;
    var v_brand = document.getElementById('brand').value;
    var v_model = document.getElementById('model').value;
    var v_release_date = document.getElementById('release_date').value;
    var v_color = document.getElementById('color').value;
    var v_capacity = document.getElementById('capacity').value;



    var r_plate = validate_plate(v_plate);
    var r_brand = validate_brand(v_brand);
    var r_model = validate_model(v_model);
    var r_release_date = validate_release_date(v_release_date);
    var r_color = validate_color(v_color);
    var r_capacity = validate_capacity(v_capacity);



    if (!r_plate) {
        document.getElementById('error_plate').innerHTML = " * plate";
        check = false;
    } else {
        document.getElementById('error_plate').innerHTML = "";
    }
    if (!r_brand) {
        document.getElementById('error_brand').innerHTML = " * brand";
        check = false;
    } else {
        document.getElementById('error_brand').innerHTML = "";
    }
    if (!r_model) {
        document.getElementById('error_model').innerHTML = " * model";
        check = false;
    } else {
        document.getElementById('error_model').innerHTML = "";
    }
    if (!r_release_date) {
        document.getElementById('error_release_date').innerHTML = " * Pon una fecha carallo";
        check = false;
    } else {
        document.getElementById('error_release_date').innerHTML = "";
    }
    if (!r_color) {
        document.getElementById('error_color').innerHTML = " * color";
        check = false;
    } else {
        document.getElementById('error_color').innerHTML = "";
    }
    if (!r_capacity) {
        document.getElementById('error_capacity').innerHTML = " * capacity";
        check = false;
    } else {
        document.getElementById('error_capacity').innerHTML = "";
    }

    if (check) {

        if (state == "update") {
            document.update_car.submit();
            document.update_car.action = "index.php?module=cars&op=update";
        }

        if (state == "create") {
            document.create_car.submit();
            document.create_car.action = "index.php?module=cars&op=create";
        }
    }

}



function loadContentModal() {
    $('.car').click(function () {
        var id = this.getAttribute('id');
        // console.log(id);

        ajaxPromise('modules/cars/controller/controller_cars.php?op=readModal&id=' + id,
            'GET', 'JSON')


            .then(function (data) {
                // console.log(data);
                $('<div></div>').attr('id', 'detailsCars', 'type', 'hidden').appendTo('#carModal');
                $('<div></div>').attr('id', 'Div1').appendTo('#modalcontent');

                $('#Div1').html(function () {
                    var content = "";
                    for (row in data) {
                        content += '<br><span>' + row + ': <span id =' + row + '>' + data[row] + '</span></span>';
                    }// end_for
                    //////
                    return content;
                });

                showModal(carTitle = data.brand + " " + data.model, data.carPlate);

            }).catch(function () {
                window.location.href = 'index.php?page=error503'; ///////////TA MAL
            });
    });


}

function showModal(carTitle, carPlate) {
    $("#modalcontent").show();
    $("#modalcontent").dialog({
        title: carTitle,
        width: 850,
        height: 500,
        resizable: "false",
        modal: "true",
        hide: "fold",
        show: "fold",
        buttons: {
            Update: function () {
                window.location.href = 'index.php?page=our-cars&op=update&carPlate=' + carPlate;
            },
            Delete: function () {
                window.location.href = 'index.php?page=our-cars&op=delete&carPlate=' + carPlate;
            },
            Ok: function () {
                $(this).dialog('close');
            }

        }// end_Buttons
    }); // end_Dialog
}// end_showModal


$(document).ready(function () {
    $('#list_table').DataTable();
    loadContentModal();
});