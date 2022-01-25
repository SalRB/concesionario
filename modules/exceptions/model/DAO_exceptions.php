<?php
include("model/connect.php");

class DAOexceptions
{
	function select_all_exceptions()
	{
		$sql = "SELECT * FROM exceptions ORDER BY date ASC";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		return $res;
	}

	function error_plus()
	{
		$sql = "INSERT INTO exceptions (date, code_id, message) VALUES (CURRENT_TIMESTAMP, (SELECT RAND()*(999-1)+1), 'example error')";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		return $res;
	}

	function error($op, $message)
	{
		$sql = "INSERT INTO exceptions (date, code_id, message) VALUES (CURRENT_TIMESTAMP, $op, '$message')";
		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
		return $res;
	}

	function clear_logs()
	{
		$sql = "DELETE FROM exceptions";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
		return $res;

	}
}
