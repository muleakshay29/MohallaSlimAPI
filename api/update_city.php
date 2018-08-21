<?php
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');

$form_data = json_decode(file_get_contents("php://input"), true);
$form_data_count = COUNT($form_data);

// if the form was submitted
if( $form_data_count > 0 )
{	
    // include database connection
    include_once '../config/database.php';

    // product object
    include_once '../objects/city_master.php';
	
	$City_id = $form_data['cityId'];
	$Country_id = $form_data['countryId'];
	$State_id = $form_data['stateId'];
	$City_name = $form_data['cityName'];

    // class instance
    $database = new Database();
    $db = $database->getConnection();
    $CityMaster = new CityMaster($db);

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
        // new values
        $CityMaster->Country_id = $Country_id;
        $CityMaster->State_id = $State_id;
        $CityMaster->City_name = $City_name;
        $CityMaster->City_id = $City_id;
        $result = $CityMaster->update();
    }

    // update the product
    echo json_encode($result);
}