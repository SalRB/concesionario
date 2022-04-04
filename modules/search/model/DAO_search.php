<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
// include($path . "modules/home/model/DAO_home.php");

// $path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
include($path . "model/connect.php");

class DAOsearch
{
    function categories($filters)
    {
        $sql = "SELECT DISTINCT category FROM carsv3";

        if (!empty($filters['filters'][1]['brand'])) {
            $brand = $filters['filters'][1]['brand'][0];
            $sql .= " WHERE brand = '$brand'";
        }

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

    function brands($filters)
    {
        $sql = "SELECT DISTINCT brand FROM carsv3";

        if (!empty($filters['filters'][0]['category'])) {
            $category = $filters['filters'][0]['category'][0];
            $sql .= " WHERE category = '$category'";
        }

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

    function autocomplete($filters)
    {
        $sql = "SELECT DISTINCT city FROM carsv3 ";

        $count = 0;
        if (strlen($filters['filters'][0]['category'][0]) > 1) {
            $category = $filters['filters'][0]['category'][0];
            if ($count == 0) {
                $sql .= " WHERE ";
                $count++;
            }
            $sql .= "category = '$category' ";
        }

        if (strlen($filters['filters'][1]['brand'][0]) > 1) {
            $brand = $filters['filters'][1]['brand'][0];
            if ($count == 0) {
                $sql .= " WHERE ";
                $sql .= "brand = '$brand' ";
                $count++;
            } else {
                $sql .= " AND brand = '$brand' ";
            }
        }
        $city = $filters['filters'][2]['city'][0];

        if ($count == 0) {
            $sql .= " WHERE city LIKE '%$city%'";
        } else {
            $sql .= " AND city LIKE '%$city%'";
        }



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