<?php
// header('Access-Control-Allow-Headers: *');
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
$results = $CityMaster->searchCity($_REQUEST['searchTerm']);

// output in json format
echo $results;