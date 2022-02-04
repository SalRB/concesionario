<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
// include($path . "modules/home/model/DAO_home.php");

// $path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
include($path . "model/connect.php");

class DAOshop
{
    function selectCars()
    {
        die('<script>console.log('.json_encode( 'AAAAAAAAAAAAAAAAAAA' ) .');</script>');

        $sql = "SELECT * FROM carsv3";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            } // end_while
        } // end_if

        return $retrArray;
    } // end_selectBrand





}// end_DAOhome