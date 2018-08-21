<?php
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');

// var_dump($_POST);

$form_data = json_decode(file_get_contents("php://input"), true);
$form_data_count = COUNT($form_data);

// if the form was submitted
// if($_POST)
if($form_data_count > 0)
{
    // include database connection
    include_once '../config/database.php';

    // product object
    include_once '../objects/user.php';
	
	$username = $form_data['username'];
	$password = $form_data['password'];
	
	// $username = $_POST['username'];
	// $username = $_POST['username'];

    // class instance
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    // set product property values
    $msg = 'true';
    $result = null;
    // if(is_null($_POST['username']) || empty($_POST['username'])) 
    if(is_null($username) || empty($username)) 
	{
        $msg = "The username field is required.";
    }
	// else if(is_null($_POST['password']) || empty($_POST['password'])) 
	else if(is_null($password) || empty($password)) 
	{
        $msg = "The password field is required.";
    } 
	else 
	{
        // $user->email = $_POST['username'];
        // $user->password = $_POST['password'];
		
		$user->email = $username;
        $user->password = $password;
        $obj = $user->auth();
        $result = $obj;
        /* if($obj != null)
            $msg = 'true';
        else
            $msg = 'Invalid email / password'; */
		
		// $result = $user->insert_logs();
    }

    /* $data = [
        'message'   => $msg,
        'user'      => $result
    ]; */
    // create the product
    // echo json_encode($data);
    echo json_encode($result);
}