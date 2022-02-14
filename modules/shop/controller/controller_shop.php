<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
include($path . "modules/shop/model/DAO_shop.php");
// die('<script>console.log('.json_encode( 'AAAAAAAAAAAAAAAAAAA' ) .');</script>');

// $homeQuery = new QuerysHomePage();


switch ($_GET['op']) {
    case 'list';

        include('modules/shop/view/shop.html');
        break;

    case 'ShopCars';

        try {
            $daocars = new DAOshop();
            $rdo = $daocars->selectCars();
            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;


    case 'ShopDetails';
        try {
            $daocars = new DAOshop();
            $rdo[0] = $daocars->selectCar($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }
        
        try {
            $daocars = new DAOshop();
            $rdo[1][] = $daocars->selectImages($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }


        echo json_encode($rdo);

        // $daocars = new DAOshop();
        // $rdo = $daocars->selectImages($_GET['id']);
        // echo json_encode($rdo);




        break;

    default;
        include('view/inc/error404.html');
        break;
}// end_switch