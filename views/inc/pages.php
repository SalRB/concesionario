<?php
// echo 'asd';
switch ($_GET['module']) {
	case "home";
		include("index.php");
		break;
	case "cars";
		include("modules/" . $_GET['module'] . "/controller/controller_" . $_GET['module'] . ".php");
		break;
	case "404";
		include("views/inc/" . $_GET['module'] . ".php");
		break;
	case "503";
		include("views/inc/" . $_GET['module'] . ".php");
		break;
	case "exceptions";
		include("modules/" . $_GET['module'] . "/controller/controller_" . $_GET['module'] . ".php");
		break;
	default;
		include("index.php");
		break;
}
