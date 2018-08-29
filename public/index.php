<?php
/*--------------------------Settings--------------------------*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Auth-Token');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'config.php';
require '../classes/master.php';
/*--------------------------Settings--------------------------*/

$app->post('/login', function (Request $request, Response $response) 
{
	$data = $request->getParsedBody();
	$email = $data['username'];
	$password = $data['password'];
	
	$table_name = "users";
	$user_info = array
	(
		'fields' => 'id, email, created_at, password',
		'where' => 'email="'.$email.'" AND password="'.$password.'" '
	);
						
	$master = new Master($this->db);
	$user = $master->GetRecord($table_name,$user_info);
	$userCheck = count($user);
	echo json_encode($userCheck);
});


$app->group('/masters', function() 		//****Master API
{	
	$this->group('/countrymaster', function()		//****Country Master
	{
		$this->get('/fetchcountry', function (Request $request, Response $response) 
		{
			$table_name = "mla_country_master";
			$country_info = array
			(
				'fields' => '*',
				'ordertype' => 'ASC',
				'orderby' => 'Country_id'
			);
								
			$master = new Master($this->db);
			$countryList = $master->GetRecord($table_name,$country_info);
			echo json_encode($countryList);
		});
	});
	
	$this->group('/statemaster', function()		//****State Master
	{
		$this->get('/fetchallstate', function (Request $request, Response $response) 
		{
			$table_name = "mla_state_master";
			$state_info = array
			(
				'fields' => '*',
				'ordertype' => 'ASC',
				'orderby' => 'State_id'
			);
								
			$master = new Master($this->db);
			$statelist = $master->GetRecord($table_name,$state_info);
			echo json_encode($statelist);
		});
		
		$this->get('/fetchallstate/{Country_id}', function (Request $request, Response $response, array $args) 
		{
			$Country_id = $args['Country_id'];
			$table_name = "mla_state_master";
			$state_info = array
			(
				'fields' => '*',
				'where' => 'Country_id="'.$Country_id.'" ',
				'ordertype' => 'ASC',
				'orderby' => 'State_id'
			);
								
			$master = new Master($this->db);
			$statelist = $master->GetRecord($table_name,$state_info);
			echo json_encode($statelist);
		});
		
		$this->get('/fetchstate/{State_id}', function (Request $request, Response $response, array $args) 
		{
			$State_id = $args['State_id'];
			$table_name = "mla_state_master";
			$state_info = array
			(
				'fields' => '*',
				'where' => 'State_id="'.$State_id.'" '
			);
								
			$master = new Master($this->db);
			$statelist = $master->GetSingleRecord($table_name,$state_info);
			echo json_encode($statelist);
		});
	});
	
	$this->group('/citymaster', function() 		//****City Master API
	{
		$this->get('/fetchcity', function (Request $request, Response $response)
		{
			$table_name = "mla_city_master";
			$city_info = array
			(
				'fields' => '*',
				'ordertype' => 'DESC',
				'orderby' => 'City_id'
			);
			
			$master = new Master($this->db);
			$citylist = $master->GetRecord($table_name, $city_info);
			echo json_encode($citylist);
		});
		
		$this->get('/fetchcity/{City_id}', function (Request $request, Response $response, array $args)
		{
			$City_id = $args['City_id'];
			$table_name = "mla_city_master";
			$city_info = array
			(
				'fields' => '*',
				'where' => 'City_id="'.$City_id.'" '
			);
			
			$master = new Master($this->db);
			$citylist = $master->GetSingleRecord($table_name, $city_info);
			echo json_encode($citylist);
		});
		
		$this->post('/addcity', function (Request $request, Response $response, array $args)
		{
			$table_name = "mla_city_master";
			$fieldarray = array
			(
				'Country_id','State_id','City_name'
			);			
			$valuearray = $request->getParsedBody();
			
			$master = new Master($this->db);
			$city = $master->InsertRecord($table_name, $fieldarray, $valuearray);
			echo json_encode($city);
		});
		
		$this->put('/updatecity', function (Request $request, Response $response, array $args)
		{
			$table_name = "mla_city_master";
			$update_info = $request->getParsedBody();
			$where = "City_id=".$update_info['City_id'];
			$master = new Master($this->db);
			$city = $master->UpdateRecord($table_name, $update_info, $where);
			echo json_encode($city);
		});
		
		$this->delete('/deletecity/{City_id}', function ($request, $response, $args) 
		{
			$City_id = $args['City_id'];
			$table_name = "mla_city_master";
			$where = "City_id=$City_id";
			$master = new Master($this->db);
			$city = $master->DeleteRecord($table_name, $where);
			echo json_encode($city);
		});
		
		$this->get('/checkcity/{City_name}', function (Request $request, Response $response, array $args)
		{
			$City_name = $args['City_name'];
			$table_name = "mla_city_master";
			$city_info = array
			(
				'fields' => 'City_name',
				'where' => 'City_name="'.$City_name.'" '
			);
			
			$master = new Master($this->db);
			$city = $master->GetSingleRecord($table_name, $city_info);
			if($city == false)
			{
				$cityCheck = false;
			}
			else
			{
				$cityCheck = true;
			}
			echo json_encode($cityCheck);
		});
	});
});


$app->run();