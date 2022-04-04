<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
include($path . "modules/search/model/DAO_search.php");
// die('<script>console.log('.json_encode( 'AAAAAAAAAAAAAAAAAAA' ) .');</script>');

// $homeQuery = new QuerysHomePage();


switch ($_GET['op']) {

    case 'categories';

        try {
            $daocars = new DAOsearch();
            $rdo = $daocars->categories($_POST);
            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;

    case 'brands';

        try {
            $daocars = new DAOsearch();
            $rdo = $daocars->brands($_POST);
            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;

    case 'autocomplete';

        try {
            $daocars = new DAOsearch();
            $rdo = $daocars->autocomplete($_POST);
            echo json_encode($rdo);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        break;

    default;
        include('view/inc/error404.html');
        break;
}// end_switch