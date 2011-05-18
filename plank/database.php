<?php
/**
 *      Plank's database connection.
 *
 *      @author   Fourdeo <we.are@fourdeo.com>
 *      @version  0.3
 */
 
require_once('paths.php');
require($path . 'config/database.php');
require_once $plank_path . 'ActiveRecord/ActiveRecord.php';

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
    $cfg->set_model_directory($path . 'app/models');
    $cfg->set_connections($connections);
	});
} catch(PDOException $e) {
	die($e->getMessage());
}