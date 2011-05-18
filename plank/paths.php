<?php
/**
 *      Plank's super-clever path detection.
 *
 *      @author   Fourdeo <we.are@fourdeo.com>
 *      @version  0.3
 */
 
$path       = str_ireplace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
$urlpath    = str_ireplace('index.php', '', $_SERVER['SCRIPT_NAME']);
$plankpath = dirname(__FILE__) . '/';
if(substr($path,   -1, 1) != '/') { $path   .= '/'; }
if(substr($urlpath, 0, 1) != '/') { $urlpath = '/' . $urlpath; }
define('CODE_PATH', $path);
define('URL_PATH', $urlpath);
define('PLANK_PATH', $plankpath);