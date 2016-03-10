<?php 

$config = array(
	'username' => 'shuchir_food',
	'password' => 'duelmasters'
);

function connect($config)
{
	try {
		$conn = new PDO('mysql:host=192.185.17.122;dbname=shuchir_app_data',
						$config['username'],
						$config['password']);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}

function connect1($config)
{
	try {
		$conn = new PDO('mysql:host=192.185.17.122;dbname=shuchir_FoodTalk_Plus',
						$config['username'],
						$config['password']);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}


function query($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);

	$results = $stmt->fetchAll();

	return $results ? $results : false;
}


function get($tableName, $conn, $id)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName ORDER BY $id DESC");

		return ( $result->rowCount() > 0 )
			? $result
			: false;
	} catch(Exception $e) {
		return false;
	}

}

function get2($tableName, $conn, $status)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName WHERE city = $status");

		return ( $result->rowCount() > 0 )
			? $result
			: false;
	} catch(Exception $e) {
		return false;
	}

}

function insertto($query, $bindings, $conn){
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);
	return true;
}

