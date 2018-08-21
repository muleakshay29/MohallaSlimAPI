<?php
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');

if( isset($_REQUEST['City_id']) )
{
    // include database connection
    include_once '../config/database.php';

    // product object
    include_once '../objects/city_master.php';

    // class instance
    $database = new Database();
    $db = $database->getConnection();
    $CityMaster = new CityMaster($db);

    $City_id = $_REQUEST['City_id'];

    $delete_result = $CityMaster->delete($City_id);
	
	echo json_encode($delete_result);
}
else
{
	echo '0';
}