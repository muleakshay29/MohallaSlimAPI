<?php
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$config['determineRouteBeforeAppMiddleware'] = true;

// $config['db']['host']   = 'localhost';
// $config['db']['user']   = 'root';
// $config['db']['pass']   = 'root';
// $config['db']['dbname'] = 'mohalla';

$config['db']['host']   = 'localhost';
$config['db']['user']   = 'root';
$config['db']['pass']   = 'ctrls.123';
$config['db']['dbname'] = 'mohalla';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['db'] = function ($c) 
					{
						$db = $c['settings']['db'];
						$pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'], $db['user'], $db['pass']);
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
						return $pdo;
					};
?>