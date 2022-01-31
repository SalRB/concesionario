<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
include($path . "modules/home/model/DAO_home.php");

// $homeQuery = new QuerysHomePage();

switch ($_GET['op']) {
    case 'list';
        include('modules/home/view/home.html');
        break;

    case 'HomeBrands';

        $daocars = new DAOhome();
        $rdo = $daocars->selectBrand();
        echo json_encode($rdo);

        break;


    case 'HomeCategory';
        $selCatBrand = $homeQuery->selectMultiple("SELECT * FROM brandCars ORDER BY views DESC LIMIT " . $_POST['loaded'] . ", " . $_POST['items']);
        if (!empty($selCatBrand)) {
            echo json_encode($selCatBrand);
        } else {
            echo "error";
        } // end_else
        break;
    case 'HomeType';
        $selCatBrand = $homeQuery->selectMultiple("SELECT * FROM brandCars ORDER BY views DESC LIMIT " . $_POST['loaded'] . ", " . $_POST['items']);
        if (!empty($selCatBrand)) {
            echo json_encode($selCatBrand);
        } else {
            echo "error";
        } // end_else
        break;

    default;
        include('view/inc/error404.html');
        break;
}// end_switch