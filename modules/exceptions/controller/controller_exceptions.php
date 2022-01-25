<?php

include("modules/exceptions/model/DAO_exceptions.php");

switch ($_GET['op']) {
    case 'list';
        $daoexceptions = new DAOexceptions();
        $rdo = $daoexceptions->select_all_exceptions();

        include("modules/exceptions/view/list.php");
        break;

    case 'clear_logs';
        $daoexceptions = new DAOexceptions();
        $rdo = $daoexceptions->clear_logs();

        echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
        $callback = 'index.php?module=exceptions&op=list';
        die('<script>window.location.href="' . $callback . '";</script>');
        break;

    case 'error_plus';
        $daoexceptions = new DAOexceptions();
        $rdo = $daoexceptions->error_plus();

        $callback = 'index.php?module=exceptions&op=list';
        die('<script>window.location.href="' . $callback . '";</script>');
        break;

    case '404':
        $daoexceptions = new DAOexceptions();
        $rdo = $daoexceptions->error($_GET['op'], $_GET['message']);
        include("modules/" . $_GET['module'] . "/view/" . $_GET['op'] . ".php");
        break;

    case '503':
        $daoexceptions = new DAOexceptions();
        $rdo = $daoexceptions->error($_GET['op'], $_GET['message']);
        include("modules/" . $_GET['module'] . "/view/" . $_GET['op'] . ".php");
        break;

    default;
        include("index.php");
        break;
}
