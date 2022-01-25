<?php
// include("model/connect.php");

$path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
include($path . "model/connect.php");

class DAOcars
{
	function insert_cars($datos)
	{

		// $ID=$datos['ID'];
		$plate = $datos['plate'];
		$frame_number = $datos['frame_number'];
		$release_date = $datos['release_date'];
		$brand = $datos['brand'];
		$model = $datos['model'];
		$color = $datos['color'];
		$extras = "";
		if (isset($datos['extras'])) {
			foreach ($datos['extras'] as $result) {
				$extras .= $result . ':';
			}
		} else {
			$extras = "Ninguno";
		}
		$capacity = $datos['capacity'];
		$fuel = $datos['fuel'];
		$type = $datos['type'];

		$sql = " INSERT INTO carsv2 (ID, plate, frame_number, release_date, brand, model, color, extras, capacity, fuel, type)"
			. " VALUES ('', '$plate', '$frame_number', '$release_date', '$brand', '$model', '$color', '$extras', '$capacity', '$fuel', '$type')";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		return $res;
	}

	function select_all_cars()
	{
		$sql = "SELECT * FROM carsv2 ORDER BY ID ASC";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
		return $res;
	}

	function select_cars($ID)
	{
		$sql = "SELECT * FROM carsv2 WHERE ID='$ID'";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql)->fetch_object();
		connect::close($conexion);
		return $res;
	}

	function update_car($datos)
	{
		$ID = $datos['ID'];
		$plate = $datos['plate'];
		$frame_number = $datos['frame_number'];
		$release_date = $datos['release_date'];
		$brand = $datos['brand'];
		$model = $datos['model'];
		$color = $datos['color'];
		$extras = "";
		if (isset($datos['extras'])) {
			foreach ($datos['extras'] as $result) {
				$extras .= $result . ':';
			}
		} else {
			$extras = "Ninguno";
		}
		$capacity = $datos['capacity'];
		$fuel = $datos['fuel'];
		$type = $datos['type'];
		$sql = " UPDATE carsv2 SET ID='$ID', plate='$plate', frame_number='$frame_number', release_date='$release_date', brand='$brand', model='$model', color='$color', extras='$extras', capacity='$capacity', fuel='$fuel', type='$type' WHERE ID='$ID'";
		// echo 'Buenas';
		// $data = 'hola crtl user';
		// die('<script>console.log('.json_encode( $data ) .');</script>');

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
		return $res;
	}


	function delete_car($ID)
	{
		$sql = "DELETE FROM carsv2 WHERE ID='$ID'";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
		return $res;
	}

	function delete_all_cars()
	{
		$sql = "DELETE FROM carsv2";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
		return $res;
	}

	function load_dummies()
	{ //El ALTER TABLE iene que estar despues del delete para funcionar, de lo contrario solo va al poner valores mayores al actual
		$alter = "DELETE FROM carsv2";
		$delete = "ALTER TABLE carsv2 AUTO_INCREMENT = 1";
		$insert = "INSERT INTO carsv2 (plate, frame_number, release_date, brand, model, color, extras, capacity, fuel, type) VALUES 
				( '0001 BBB', 'AS8ASISA78ASHSUFJ', '12/12/2021', 'Fiat', 'Multipla', 'Red', 'Tinted glass:Hyper speakers', '2', 'Diesel', 'Manual'),
				( '2313 CFH', 'A5JW98ASAK989ASKJ', '27/11/2019', 'Opel', 'Corsa', 'White', 'Tinted glass', '5', 'Gasoline', 'Manual'),
				( '3785 DYP', '78AKSJHD3273HJDSH', '12/08/2018', 'Toyota', 'Corolla', 'Black', 'Ninguno', '5', 'Diesel', 'Manual'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '7823 FDP', 'JHAKSJKD78783AJHS', '03/07/2017', 'Tesla', 'Model S', 'White', 'Tinted glass:Hyper speakers', '5', 'Electric', 'Automatic'),
				( '9832 HLF', 'GAJHSKJLKD837837B', '04/02/2013', 'BMW', 'X1', 'Gray', 'Hyper speakers', '2', 'Hybrid', 'Automatic');";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $alter);
		$res = mysqli_query($conexion, $delete);
		$res = mysqli_query($conexion, $insert);
		connect::close($conexion);
		return $res;
	}
}
