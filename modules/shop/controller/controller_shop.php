<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
include($path . "modules/shop/model/DAO_shop.php");
// die('<script>console.log('.json_encode( 'AAAAAAAAAAAAAAAAAAA' ) .');</script>');

// $homeQuery = new QuerysHomePage();
if (isset($_SESSION["tiempo"])) {
    $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
}

switch ($_GET['op']) {
    case 'list';

        include('modules/shop/view/shop.html');
        break;

    case 'AllCars';

        try {
            $daocars = new DAOshop();
            $rdo = $daocars->selectCars($_POST);
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
            echo json_encode("error_loading_images");
        }


        echo json_encode($rdo);

        break;


    case 'FiltersContent';

        try {
            $daocars = new DAOshop();
            $rdo[0] = $daocars->Filters_Brand();
            $rdo[1] = $daocars->Filters_Type();
            $rdo[2] = $daocars->Filters_Category();
            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;


    case 'Filters';

        try {
            $daocars = new DAOshop();
            $rdo = $daocars->Filters($_POST);
            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;



    case 'CountVisits';

        try {
            $daocars = new DAOshop();
            $rdo = $daocars->CountVisits($_GET['id']);
            // echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;

    case 'LoadRelated';

        try {
            $daocars = new DAOshop();
            $rdo = $daocars->LoadRelated($_POST);
            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;

    case 'CountAll';

        try {
            $daocars = new DAOshop();
            $rdo = $daocars->countAll();
            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;


    case 'CountWithFilters';

        try {
            $daocars = new DAOshop();
            $rdo = $daocars->countWithFilters($_POST);
            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;


    default;
        include('view/inc/error404.html');
        break;
}// end_switch