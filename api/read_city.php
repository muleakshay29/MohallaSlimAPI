<?php
header('Access-Control-Allow-Origin: *');
// include core configuration
//include_once '../config/core.php';

// include database connection
include_once '../config/database.php';

// product object
include_once '../objects/city_master.php';

// class instance
$database = new Database();
$db = $database->getConnection();
$CityMaster = new CityMaster($db);
// $num = $CityMaster->rowCount();

$stmt = $CityMaster->readAll();

// if ($num > 0)
{
	$city = array();
    // $city_arr['records'] = array();
	
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
	{
		extract($row);

        $City[] = array(
            "City_id" => $City_id,
            "City_name" => $City_name,
			//"Country_id" => $Country_id,
			//"State_id" => $State_id
        );

        // array_push($city_arr["records"], $city);
	}
	
	echo json_encode($City);
}
// else 
// {
    // echo json_encode(array("message"=>"No Category Found."));
// }
