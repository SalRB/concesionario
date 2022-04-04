<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/concesionario/';
include($path . "modules/login/model/DAO_login.php");
include($path . "modules/login/model/validate_register.php");
include($path . "views/inc/JWT.php");
@session_start();


switch ($_GET['op']) {
    case 'list';
        include('modules/login/view/login.html');
        break;

    case 'login':
        try {
            $dao = new DAOLogin();
            $rdo = $dao->select_user($_POST['username']);

            $jwt = parse_ini_file("jwt.ini");
            $header = $jwt['header'];
            $secret = $jwt['secret'];
            $payload = '{"iat":"' . time() . '","exp":"' . time() + (60 * 60) . '","name":"' . $rdo["username"] . '"}';

            $JWT = new JWT;
            $token = $JWT->encode($header, $payload, $secret);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error");
            exit;
        } else {
            if (password_verify($_POST['password'], $rdo['passwd'])) {
                $_SESSION['username'] = $rdo['username'];
                $_SESSION['tiempo'] = time();

                echo json_encode($token);
                exit;
            } else {
                echo json_encode("error");
                exit;
            }
        }
        break;

    case 'register':

        $check = validate($_POST['email']);
        $check2 = validate_username($_POST['username']);
        if (($check) && ($check2)) {
            try {
                $dao = new DAOLogin();
                $rdo = $dao->insert_user($_POST['username'], $_POST['email'], $_POST['password']);
            } catch (Exception $e) {
                echo json_encode("error");
                exit;
            }
            if (!$rdo) {
                echo json_encode("error");
                exit;
            } else {
                echo json_encode("ok");
                exit;
            }
        } else {
            if ((!$check) && (!$check2)) {
                echo json_encode("error_email_username");
                exit;
            } else {
                if (!$check) {
                    echo json_encode("error_email");
                    exit;
                } else {
                    echo json_encode("error_username");
                    exit;
                }
            }
            exit;
        }

        break;

    case 'logout':
        unset($_SESSION['tiempo']);
        unset($_SESSION['username']);
        session_destroy();
        echo json_encode('Done');


        break;

    case 'data_user':
        $jwt = parse_ini_file("jwt.ini");
        $secret = $jwt['secret'];
        $token = $_POST['token'];

        $JWT = new JWT;
        $json = $JWT->decode($token, $secret);
        $json = json_decode($json, TRUE);

        $dao = new DAOLogin();
        $rdo = $dao->select_data($json['name']);
        echo json_encode($rdo);
        exit;
        break;

    case 'actividad':
        if (!isset($_SESSION["tiempo"])) {
            echo "inactivo";
        } else {
            if ((time() - $_SESSION["tiempo"]) >= 300) {
                echo "inactivo";
                exit();
            } else {
                echo "activo";
                exit();
            }
        }
        break;

    case 'control_user':
        $jwt = parse_ini_file("jwt.ini");
        $secret = $jwt['secret'];
        $token = $_POST['token'];

        $JWT = new JWT;
        $json = $JWT->decode($token, $secret);
        $json = json_decode($json, TRUE);

        if ($json['name'] == $_SESSION['username']) {
            echo json_encode('valid');
        } else {
            echo json_encode('invalid_user');
        }
        break;

    case 'refresh_token':

        $jwt = parse_ini_file("jwt.ini");
        $header = $jwt['header'];
        $secret = $jwt['secret'];
        $token = $_POST['token'];

        $JWT = new JWT;
        $json = $JWT->decode($token, $secret);
        $json = json_decode($json, TRUE);

        $payload = '{"iat":"' . time() . '","exp":"' . time() + (60 * 60) . '","name":"' . $json['name'] . '"}';

        $JWT = new JWT;
        $token = $JWT->encode($header, $payload, $secret);


        echo json_encode($token);

        break;


    case 'refresh_cookie':

        session_regenerate_id();

        break;

    default;
        include("view/inc/error404.php");
        break;
}
