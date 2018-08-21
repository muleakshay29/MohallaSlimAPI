<?php
header('Access-Control-Allow-Origin: *');

// include database connection
include_once '../config/database.php';

// product object
include_once '../objects/city_master.php';

// class instance
$database = new Database();
$db = $database->getConnection();
$CityMaster = new CityMaster($db);

// read all products
$results = $CityMaster->readOne($_REQUEST['City_id']);

// output in json format
echo json_encode($results);