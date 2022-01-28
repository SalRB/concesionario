<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
include($path . "modules/cars/model/DAO_home.php");
// $homeQuery = new QuerysHomePage();

switch ($_GET['op']) {
    case 'list';
        include ('module/home/view/homepage.html');
        break;
    case 'homePageSlide';
        $selSlide = $homeQuery -> selectMultiple("SELECT carPlate, brand, model, image FROM allCars ORDER BY cv DESC LIMIT 5");
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }else {
            echo "error";
        }// end_else
        break;
    case 'homePageCat';
        $selCatBrand = $homeQuery -> selectMultiple("SELECT * FROM brandCars ORDER BY views DESC LIMIT " . $_POST['loaded'] . ", " . $_POST['items']);
        if (!empty($selCatBrand)) {
            echo json_encode($selCatBrand);
        }else{
            echo "error";
        }// end_else
        break;
    default;
        include ('view/inc/error404.html');
        break;
}// end_switch