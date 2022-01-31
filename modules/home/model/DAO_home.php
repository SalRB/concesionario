<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
// include($path . "modules/home/model/DAO_home.php");

// $path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
include($path . "model/connect.php");

class DAOhome {
    function selectBrand() {
		$sql = "SELECT * FROM brand LIMIT 5";
		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
        // die('<script>console.log('.json_encode( mysqli_fetch_assoc($res)) .');</script>');

        $retrArray = array();
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;

            }// end_while
        }// end_if
        die('<script>console.log('.json_encode( $retrArray) .');</script>');

        return $retrArray;
    }// end_selectBrand


}// end_QuerysHomePage