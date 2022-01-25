<?php
// echo 'Buenas';
// $data = 'hola crtl user';
// die('<script>console.log('.json_encode( $data ) .');</script>');

$path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
include($path . "modules/cars/model/DAO_cars.php");
// session_start();/////////////////////////////////////////////////////

// include("modules/cars/model/DAO_cars.php");
// session_start();

switch ($_GET['op']) {
    case 'list';

        try {
            $daocars = new DAOcars();
            $rdo = $daocars->select_all_cars();
        } catch (Exception $e) {
            // $callback = 'index.php?module=503';
            $callback = 'index.php?module=exceptions&op=503&message=Error_DAO_list';
            die('<script>window.location.href="' . $callback . '";</script>');
        }

        if (!$rdo) {
            $callback = 'index.php?module=exceptions&op=503&message=Error_SQL_list';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            include("modules/cars/view/list.php");
        }
        break;

    case 'create';

        include("modules/cars/model/validate_cars.php");

        $check = true;

        if ($_POST) {

            $check = validate();

            if ($check) {
                $_SESSION['ID'] = $_POST;
                try {
                    $daocars = new DAOcars();
                    $rdo = $daocars->insert_cars($_POST);
                } catch (Exception $e) {

                    $callback = 'index.php?module=exceptions&op=503&message=Error_DAO_create';
                    die('<script>window.location.href="' . $callback . '";</script>');
                }

                if ($rdo) {
                    echo '<script language="javascript">alert("Registrado en la base de datos correctamente")</script>';
                    $callback = 'index.php?module=cars&op=list';
                    die('<script>window.location.href="' . $callback . '";</script>');
                } else {
                    $callback = 'index.php?module=exceptions&op=503&message=Error_SQL_create';
                    die('<script>window.location.href="' . $callback . '";</script>');
                }
            }
        }

        include("modules/cars/view/create.php");
        break;


    case 'update';

        // include("modules/cars/model/validate_cars.php"); //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $check = true;

        if ($_POST) {
            // $check = validate();

            // if ($check) {
            $_SESSION['ID'] = $_POST;
            try {
                $daocars = new DAOcars();
                $rdo = $daocars->update_car($_POST);
            } catch (Exception $e) {
                $callback = 'index.php?module=exceptions&op=503&message=Error_DAO_update';
                die('<script>window.location.href="' . $callback . '";</script>');
            }

            if ($rdo) {
                echo '<script language="javascript">alert("Actualizado en la base de datos correctamente")</script>';
                $callback = 'index.php?module=cars&op=list';
                die('<script>window.location.href="' . $callback . '";</script>');
            } else {
                $callback = 'index.php?module=exceptions&op=503&message=Error_SQL_update';
                die('<script>window.location.href="' . $callback . '";</script>');
            }
            // }
        }

        try {
            $daocars = new DAOcars();
            $rdo = $daocars->select_cars($_GET['id']);
            $car = get_object_vars($rdo);
        } catch (Exception $e) {
            $callback = 'index.php?module=exceptions&op=503&message=Error_DAO_update_filling';
            die('<script>window.location.href="' . $callback . '";</script>');
        }

        if (!$rdo) {
            $callback = 'index.php?module=exceptions&op=503&message=Error_SQL_update_filling';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            include("modules/cars/view/update.php");
        }
        break;




    case 'read';

        try {
            $daocars = new DAOcars();
            $rdo = $daocars->select_cars($_GET['id']);
            $car = get_object_vars($rdo);
        } catch (Exception $e) {
            $callback = 'index.php?module=exceptions&op=503&message=Error_DAO_read';
            die('<script>window.location.href="' . $callback . '";</script>');
        }
        if (!$rdo) {
            $callback = 'index.php?module=exceptions&op=503&message=Error_SQL_read';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            include("modules/cars/view/read.php");
        }
        break;

    case 'delete';
        if (isset($_POST['delete'])) {
            try {
                $daocars = new DAOcars();
                $rdo = $daocars->delete_car($_GET['id']);
            } catch (Exception $e) {
                $callback = 'index.php?module=exceptions&op=503&message=Error_DAO_delete';
                die('<script>window.location.href="' . $callback . '";</script>');
            }

            if ($rdo) {
                echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
                $callback = 'index.php?module=cars&op=list';
                die('<script>window.location.href="' . $callback . '";</script>');
            } else {
                $callback = 'index.php?module=exceptions&op=503&message=Error_SQL_delete';
                die('<script>window.location.href="' . $callback . '";</script>');
            }
        }

        $daocars = new DAOcars();
        $rdo = $daocars->select_cars($_GET['id']);
        $car = get_object_vars($rdo);

        include("modules/cars/view/delete.php");
        break;

    case 'delete_all';
        try {
            $daocars = new DAOcars();
            $rdo = $daocars->delete_all_cars();
        } catch (Exception $e) {
            $callback = 'index.php?module=exceptions&op=503&message=Error_DAO_delete_all';
            die('<script>window.location.href="' . $callback . '";</script>');
        }

        if ($rdo) {
            echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
            $callback = 'index.php?module=cars&op=list';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            $callback = 'index.php?module=exceptions&op=503&message=Error_SQL_delete_all';
            die('<script>window.location.href="' . $callback . '";</script>');
        }


    case 'dummies';

        try {
            $daocars = new DAOcars();
            $rdo = $daocars->load_dummies();
        } catch (Exception $e) {

            $callback = 'index.php?module=exceptions&op=503&message=Error_DAO_dummies';
            die('<script>window.location.href="' . $callback . '";</script>');
        }

        if ($rdo) {
            echo '<script language="javascript">alert("Dummies loaded successfully")</script>';
            $callback = 'index.php?module=cars&op=list';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            $callback = 'index.php?module=exceptions&op=503&message=Error_SQL_dummies';
            die('<script>window.location.href="' . $callback . '";</script>');
        }

        break;
    case 'readModal':
        try {
            $daocars = new DAOcars();
            $rdo = $daocars->select_cars($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error");
            exit;
        } else {
            $car = get_object_vars($rdo);
            echo json_encode($car);
            exit;
        }
        break;

    default;
        $callback = 'index.php?module=exceptions&op=404&message=Error_case_controller_cars';
        break;
}
