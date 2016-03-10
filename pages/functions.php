<?php 

$config = array(
	'username' => 'shuchir_food',
	'password' => 'F@!thR3b0urn'
);

function connect($config)
{
	try {
		$conn = new PDO('mysql:host=localhost;dbname=shuchir_FTI',
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
		$conn = new PDO('mysql:host=localhost;dbname=shuchir_data_collection',
						$config['username'],
						$config['password']);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}

function connect2($config)
{
	try {
		$conn = new PDO('mysql:host=localhost;dbname=shuchir_dlive',
						$config['username'],
						$config['password']);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}

function connect3($config)
{
	try {
		$conn = new PDO('mysql:host=localhost;dbname=shuchir_masterchef',
						$config['username'],
						$config['password']);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}

function connect4($config)
{
	try {
		$conn = new PDO('mysql:host=localhost;dbname=shuchir_data',
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
		$result = $conn->query("SELECT * FROM $tableName  ORDER BY $id DESC");

		return ( $result->rowCount() > 0 )
			? $result->fetchAll(PDO::FETCH_ASSOC)
			: false;
	} catch(Exception $e) {
		return false;
	}

}
function getfield($tableName, $conn, $field1)
{
	try {
		$result = $conn->query("SELECT DISTINCT $field1 FROM $tableName ORDER BY `id` DESC");

		return ( $result->rowCount() > 0 )
			? $result->fetchAll(PDO::FETCH_ASSOC)
			: false;
	} catch(Exception $e) {
		return false;
	}

}
function gettest($tableName, $conn, $event1)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName WHERE event1 = '".$event1."'");

		return ( $result->rowCount() > 0 )
			? $result->fetchAll(PDO::FETCH_ASSOC)
			: false;
	} catch(Exception $e) {
		return false;
	}

}

function getafter($tableName, $conn, $id)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName WHERE $id > 130 ORDER BY $id DESC");

		return ( $result->rowCount() > 0 )
			? $result
			: false;
	} catch(Exception $e) {
		return false;
	}

}

function getall($tableName, $conn)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName");

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


function countnum($tableName, $conn, $fl)
{

	try {
		$result = $conn->query("SELECT * FROM $tableName");

		$data= ( $result->rowCount() > 0 )
			? $result
			: false;
		$counter = 0;
		if($data){
			foreach ($data as $key) {
				if ($key[$fl]==0) {
					$counter++;
				}
			}
		}
		return $counter;
	} catch(Exception $e) {
		return false;
	}
}