<?php
header('Access-Control-Allow-Origin: *');
//var_dump($_REQUEST);die;

if(!empty($_REQUEST['form_data']))
{
	$form_data = json_decode($_REQUEST['form_data']);	
	$name = $form_data->name;
	$price = $form_data->price;
	$description = $form_data->description;
	$category_id = $form_data->category_id;
    // include core configuration
    // include_once '../config/core.php';

    // include database connection
    include_once '../config/database.php';

    // product object
    include_once '../objects/product.php';

    // class instance
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

    // set product property values
    $result = 'true';
    if(is_null($name) || empty($name)) {
        $result = "The product name must be filled.";
    } else if(is_null($price) || empty($price)) {
        $result = "The price must be filled.";
    } else if(is_null($description) || empty($description)) {
        $result = "The description must be filled.";
    } else if(is_null($category_id) || empty($category_id)) {
        $result = "The category must be selected.";
    } else {
        $product->name = $name;
        $product->price = $price;
        $product->description = $description;
        $product->category_id = $category_id;
        $result = $product->create() ? "true" : 'false';
    }

    // create the product
    echo $result;
}