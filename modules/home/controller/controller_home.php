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


    case 'HomeCategories';

        $daocars = new DAOhome();
        $rdo = $daocars->selectCategories();
        echo json_encode($rdo);

        break;

    case 'HomeTypes';

        $daocars = new DAOhome();
        $rdo = $daocars->selectTypes();
        echo json_encode($rdo);

        break;

    default;
        include('view/inc/error404.html');
        break;
}// end_switch