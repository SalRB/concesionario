<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
include($path . "modules/shop/model/DAO_shop.php");

// $homeQuery = new QuerysHomePage();

// die('<script>console.log('.json_encode( 'AAAAAAAAAAAAAAAAAAA' ) .');</script>');

switch ($_GET['op']) {
    case 'list';

        include('modules/shop/view/shop.html');
        break;

    case 'ShopCars';
die('<script>console.log('.json_encode( 'AAAAAAAAAAAAAAAAAAA' ) .');</script>');

        $daocars = new DAOshop();
        $rdo = $daocars->selectCars();
        echo json_encode($rdo);

        break;


    default;
        include('view/inc/error404.html');
        break;
}// end_switch