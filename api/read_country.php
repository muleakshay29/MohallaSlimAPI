<?php
header('Access-Control-Allow-Origin: *');

// include database connection
include_once '../config/database.php';

// product object
include_once '../objects/country_master.php';

// class instance
$database = new Database();
$db = $database->getConnection();
$CountryMaster = new CountryMaster($db);

$stmt = $CountryMaster->read();

$country_arr = array();
$country_arr['records'] = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
{
	extract($row);

	$Country[] = array(
		"Country_id" => $Id,
		"Country_name" => $Name
	);

	// array_push($country_arr["records"], $Country);
	// array_push($Country);
}

// echo json_encode($country_arr);
echo json_encode($Country);
