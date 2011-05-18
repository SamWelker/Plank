<?php
/**
 *      Plank's database connection.
 *
 *      @author   Fourdeo <we.are@fourdeo.com>
 *      @version  0.3
 */
 
require BASE_PATH . 'config/database.php';
require_once PLANK_PATH . 'ActiveRecord/ActiveRecord.php';

try {
	$db = new PDO("mysql:host=$host;dbname=$name", $user, $pass, array(PDO::ATTR_PERSISTENT => true));
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$connections = array(
		'development' => "mysql://$user:$pass@$host/$name"
	);
	// initialize ActiveRecord
	ActiveRecord\Config::initialize(function($cfg) use ($connections)
	{
	  global $path;
    $cfg->set_model_directory(BASE_PATH . 'app/models');
    $cfg->set_connections($connections);
	});
} catch(PDOException $e) {
	die($e->getMessage());
}