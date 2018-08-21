<?php
header('Access-Control-Allow-Origin: *');

// include database connection
include_once '../config/database.php';

// product object
include_once '../objects/state_master.php';

// class instance
$database = new Database();
$db = $database->getConnection();
$StateMaster = new StateMaster($db);

if(isset($_REQUEST['Country_id']))
{
	$stmt = $StateMaster->read($_REQUEST['Country_id']);
}
else
{
	$stmt = $StateMaster->readAll();
}

$State = array();
$state_arr['records'] = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
{
	extract($row);

	$State[] = array(
		"State_id" => $Id,
		"State_name" => $Name
	);

	// array_push($state_arr["records"], $State);
}

echo json_encode($State);
