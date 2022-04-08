<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
include($path . "modules/shop/model/DAO_shop.php");
include($path . "views/inc/JWT.php");
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

    case 'load_likes';
        try {

            $jwt = parse_ini_file("jwt.ini");
            $secret = $jwt['secret'];
            $token = $_POST['token'];

            $JWT = new JWT;
            $json = $JWT->decode($token, $secret);
            $json = json_decode($json, TRUE);

            $dao = new DAOShop();
            $rdo = $dao->select_load_likes($json['name']);

            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        break;

    case 'control_likes';

        try {
            $jwt = parse_ini_file("jwt.ini");
            $secret = $jwt['secret'];
            $token = $_POST['token'];

            $JWT = new JWT;
            $json = $JWT->decode($token, $secret);
            $json = json_decode($json, TRUE);

            $dao = new DAOShop();
            $rdo = $dao->select_likes($_POST['id'], $json['name']);
        } catch (Exception $e) {
            echo json_encode("a");
            exit;
        }

        // $dinfo = array();
        // foreach ($rdo as $row) {
        //     array_push($dinfo, $row);
        // }
        if (count($rdo) === 0) {
            $dao = new DAOShop();
            $rdo2 = $dao->insert_likes($_POST['id'], $json['name']);
            echo json_encode("0");
        } else {
            $dao = new DAOShop();
            $rdo2 = $dao->delete_likes($_POST['id'], $json['name']);
            echo json_encode("1");
        }

        break;




    default;
        include('view/inc/error404.html');
        break;
}// end_switch