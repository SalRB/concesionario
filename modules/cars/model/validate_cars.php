<?php

function validate_plate($plate)
{
    $mysqli = "SELECT * FROM carsv2 WHERE plate = '$plate'";

    $connection = connect::con();
    $res = mysqli_query($connection, $mysqli);
    $res = mysqli_num_rows($res);
    connect::close($connection);

    return $res;
}

function validate_frame_number($frame_number)
{
    $mysqli = "SELECT * FROM carsv2 WHERE frame_number = '$frame_number'";

    $connection = connect::con();
    $res = mysqli_query($connection, $mysqli);
    $res = mysqli_num_rows($res);
    connect::close($connection);

    return $res;
}

function validate()
{
    $check = true;

    $v_plate = $_POST['plate'];
    $r_plate = validate_plate($v_plate);
    $v_frame_number = $_POST['frame_number'];
    $r_frame_number = validate_frame_number($v_frame_number);

    if (($r_plate === 1) || ($r_frame_number === 1)){
        echo '<script language="javascript">
        toastr.error("Learn how to type, crrrrrrrack");
        </script>';
        $check = false;
    }

    return $check;
}
