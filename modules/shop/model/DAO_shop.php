<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
// include($path . "modules/home/model/DAO_home.php");

// $path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
include($path . "model/connect.php");

class DAOshop
{
    function selectCars($limitData)
    {
        if (!empty($limitData['params'][0]['limit'])) {
            $limit = $limitData['params'][0]['limit'];
            $offset = $limitData['params'][1]['offset'];
            $sql = "SELECT * FROM carsv3 ORDER BY visits DESC LIMIT $offset, $limit";
        } else {
            $sql = "SELECT * FROM carsv3 ORDER BY visits DESC LIMIT 0, 3";
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

    function selectCar($ID)
    {

        $sql = "SELECT * FROM carsv3 WHERE ID = '$ID'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);

        return $res;
    } // end_selectBrand


    function selectImages($ID)
    {
        $sql = "SELECT images FROM car_images WHERE car_ID = '$ID'";

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



    function Filters_Brand()
    {

        $sql = "SELECT DISTINCT brand FROM carsv3 ";

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

    function Filters_Type()
    {

        $sql = "SELECT DISTINCT type FROM carsv3 ";

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

    function Filters_Category()
    {

        $sql = "SELECT DISTINCT category FROM carsv3 ";

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


    function Filters($filters)
    {

        // echo json_encode($filters);
        $count = 0;
        $count2 = 0;
        $count3 = 0;

        // $sizeof = sizeof($filters['params'][0]['brand']);
        // $sizeof = empty($filters['params'][88]['brand']);
        // $cosa2 = empty($filters['params'][$cosa]['brand'][0]);
        // $cosa2 = $filters['params'][0]['brand'][0];

        $sql = "SELECT * FROM carsv3 WHERE ";

        // foreach ($filters['params'] as $key) {
        // }

        if (!empty($filters['params'][$count]['brand'])) {
            foreach ($filters['params'][$count]['brand'] as $key1) {
                $brand = $filters['params'][$count]['brand'][$count2];
                if ($count3 == 0) {
                    $sql .= "brand = '$brand'";
                    $count2++;
                    $count3++;
                } else {
                    if ($count2 == 0) {
                        $sql .= " AND brand = '$brand'";
                    } else {
                        $sql .= " OR brand = '$brand'";
                    }
                    $count2++;
                }
            }
            $count++;
        }
        $count2 = 0;

        if (!empty($filters['params'][$count]['type'])) {
            foreach ($filters['params'][$count]['type'] as $key2) {
                $type = $filters['params'][$count]['type'][$count2];
                if ($count3 == 0) {
                    $sql .= "type = '$type'";
                    $count2++;
                    $count3++;
                } else {
                    if ($count2 == 0) {
                        $sql .= " AND type = '$type'";
                    } else {
                        $sql .= " OR type = '$type'";
                    }
                    $count2++;
                }
            }
            $count++;
        }

        $count2 = 0;

        if (!empty($filters['params'][$count]['category'])) {
            foreach ($filters['params'][$count]['category'] as $key3) {
                $category = $filters['params'][$count]['category'][$count2];
                if ($count3 == 0) {
                    $sql .= "category = '$category'";
                    $count2++;
                    $count3++;
                } else {
                    if ($count2 == 0) {
                        $sql .= " AND category = '$category'";
                    } else {
                        $sql .= " OR category = '$category'";
                    }
                    $count2++;
                }
            }
            $count++;
        }

        if (!empty($filters['params'][$count]['city'])) {
            $city = $filters['params'][$count]['city'][0];
            if ($count3 == 0) {
                $sql .= "city LIKE '%$city%'";
                $count3++;
            } else {
                $sql .= " AND city LIKE '%$city%'";
            }
        }

        if (!empty($filters['params'][$count]['orderby'])) {
            $orderby = $filters['params'][$count]['orderby'];
            $sql .= " ORDER BY $orderby, visits DESC";
        } else {
            $sql .= " ORDER BY visits DESC";
        }

        if (!empty($filters['params'][$count]['limit'])) {
            $limit = $filters['params'][$count]['limit'];
            $count++;
            $offset = $filters['params'][$count]['offset'];
            $sql .= " LIMIT $offset, $limit";
        } else {
            $sql .= " LIMIT 0, 3";
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
    }


    function CountVisits($ID)
    {
        $sql = "UPDATE carsv3 SET visits = visits+1 WHERE ID = '$ID'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
    }



    function LoadRelated($related)
    {
        $limit = $related['related'][0]['limit'][0];
        $offset = $related['related'][1]['offset'][0];
        $id = $related['related'][2]['id'][0];

        $sql = "SELECT * FROM carsv3 WHERE id <> '$id' AND brand = (SELECT brand FROM carsv3 WHERE id = '$id') OR type = (SELECT type FROM carsv3 WHERE id = '$id') LIMIT $offset, $limit";

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

    function countAll()
    {
        $sql = "SELECT COUNT(*) AS counted FROM carsv3";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);

        return $res;
    } // end_selectBrand

    function countWithFilters($filters)
    {
        $count = 0;
        $count2 = 0;
        $count3 = 0;

        $sql = "SELECT COUNT(*) AS counted FROM carsv3 WHERE ";

        if (!empty($filters['params'][$count]['brand'])) {
            foreach ($filters['params'][$count]['brand'] as $key1) {
                $brand = $filters['params'][$count]['brand'][$count2];
                if ($count3 == 0) {
                    $sql .= "brand = '$brand'";
                    $count2++;
                    $count3++;
                } else {
                    if ($count2 == 0) {
                        $sql .= " AND brand = '$brand'";
                    } else {
                        $sql .= " OR brand = '$brand'";
                    }
                    $count2++;
                }
            }
            $count++;
        }
        $count2 = 0;

        if (!empty($filters['params'][$count]['type'])) {
            foreach ($filters['params'][$count]['type'] as $key2) {
                $type = $filters['params'][$count]['type'][$count2];
                if ($count3 == 0) {
                    $sql .= "type = '$type'";
                    $count2++;
                    $count3++;
                } else {
                    if ($count2 == 0) {
                        $sql .= " AND type = '$type'";
                    } else {
                        $sql .= " OR type = '$type'";
                    }
                    $count2++;
                }
            }
            $count++;
        }

        $count2 = 0;

        if (!empty($filters['params'][$count]['category'])) {
            foreach ($filters['params'][$count]['category'] as $key3) {
                $category = $filters['params'][$count]['category'][$count2];
                if ($count3 == 0) {
                    $sql .= "category = '$category'";
                    $count2++;
                    $count3++;
                } else {
                    if ($count2 == 0) {
                        $sql .= " AND category = '$category'";
                    } else {
                        $sql .= " OR category = '$category'";
                    }
                    $count2++;
                }
            }
            $count++;
        }

        if (!empty($filters['params'][$count]['city'])) {
            $city = $filters['params'][$count]['city'][0];
            if ($count3 == 0) {
                $sql .= "city LIKE '%$city%'";
                $count3++;
            } else {
                $sql .= " AND city LIKE '%$city%'";
            }
        }

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);

        return $res;
    }

    function select_load_likes($user)
    {
        $sql = "SELECT car FROM likes WHERE user='$user'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_likes($car, $user)
    {
        $sql = "SELECT user, car FROM likes WHERE user='$user' AND car='$car'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function insert_likes($car, $user)
    {
        $sql = "INSERT INTO likes (user, car) VALUES ('$user','$car')";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function delete_likes($car, $user)
    {
        $sql = "DELETE FROM likes WHERE user='$user' AND codigo_producto='$car'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
}// end_DAOhome