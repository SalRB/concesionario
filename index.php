<?php
if ((isset($_GET['module'])) && ($_GET['module'] === "cars")) {
	include("views/inc/top_page_cars.php");
} else {
	include("views/inc/top_page.php");
}
// session_start(); ///////////////////////////////////////////


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