<?php
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');

$form_data = json_decode(file_get_contents("php://input"), true);
$form_data_count = COUNT($form_data);

$request_method = $_SERVER["REQUEST_METHOD"];

if($form_data_count > 0)
{
	$Country_id = $form_data['countryId'];
	$State_id = $form_data['stateId'];
	$City_name = $form_data['cityName'];

    // include database connection
    include_once '../config/database.php';

    // product object
    include_once '../objects/city_master.php';

    // class instance
    $database = new Database();
    $db = $database->getConnection();
    $CityMaster = new CityMaster($db);

    // set product property values
    $result = 'true';
    if(is_null($Country_id) || empty($Country_id) || $Country_id == 0) 
	{
        $result = "Country must be selected.";
    } 
	else if(is_null($State_id) || empty($State_id) || $State_id == 0) 
	{
        $result = "State must be selected.";
    }
	else if(is_null($City_name) || empty($City_name)) 
	{
        $result = "City name must be filled.";
    } 
	else 
	{
        $CityMaster->Country_id = $Country_id;
        $CityMaster->State_id = $State_id;
        $CityMaster->City_name = $City_name;
        // $result = $CityMaster->create() ? "true" : 'false';
        $result = $CityMaster->create();
    }

    // create the product
    echo json_encode($result);
}