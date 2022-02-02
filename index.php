<?php
if ((isset($_GET['module'])) && ($_GET['module'] === "cars")) {
	include("views/inc/top_page_cars.html");
} elseif ((isset($_GET['module'])) && ($_GET['module'] === "home")) {
	include("views/inc/top_page_home.html");
} else {
	include("views/inc/top_page.html");
}
// session_start(); ///////////////////////////////////////////

// include_once("views/inc/content.html");

?>
<div id="wrapper">
	<div id="header">
		<?php
		include_once("views/inc/header.html");
		?>
	</div>
	<div id="menu">
		<?php
		include_once("views/inc/menu.html");
		?>
	</div>
	<div id="">
		<?php
		include_once("views/inc/pages.php");
		?>
		<br style="clear:both;" />
	</div>
	<div id="footer">
		<?php
		include_once("views/inc/footer.html");
		?>
	</div>
</div>