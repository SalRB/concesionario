<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
// include($path . "modules/home/model/DAO_home.php");

// $path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
include($path . "model/connect.php");

class DAOhome
{
    function selectBrand()
    {
        $sql = "SELECT * FROM brand LIMIT 6";
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

    function selectCategories()
    {
        $sql = "SELECT * FROM category LIMIT 4";
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
    } // end_selectCategories

    function selectTypes()
    {
        $sql = "SELECT * FROM type LIMIT 3";
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
    } // end_selectTypes


}// end_DAOhome