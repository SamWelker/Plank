<?php
$version = '0.2.1';

$path       = str_ireplace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
$urlpath    = str_ireplace('index.php', '', $_SERVER['SCRIPT_NAME']);
$plankpath = dirname(__FILE__) . '/';
if(substr($path,   -1, 1) != '/') { $path   .= '/'; }
if(substr($urlpath, 0, 1) != '/') { $urlpath = '/' . $urlpath; }
define('BASE_PATH',  $path);
define('URL_PATH',   $urlpath);
define('PLANK_PATH', $plankpath);

//	Theme path
require  BASE_PATH . 'config/settings.php';
$themeurl = $urlpath . 'themes/' . (isset($theme) ? $theme : 'default') . '/';
$themedir = $path . 'themes/' . (isset($theme) ? $theme : 'default') . '/';

require PLANK_PATH . 'plank/database.php';
require PLANK_PATH . 'plank/errors.php';
require PLANK_PATH . 'plank/rendering.php';

session_start();
require BASE_PATH . 'routes.php';

function throw403() {
  global $path, $urlpath;
  ob_start();
  render('layouts/403');
  $content = ob_get_contents();
  ob_end_clean();
  render('layouts/application');
  exit;
}

function throw404() {
  global $path, $urlpath;
  ob_start();
  render('layouts/404');
  $content = ob_get_contents();
  ob_end_clean();
  render('layouts/application');
  exit;
}

ob_start();
//include 'loader.php';
$request = str_replace($urlpath, '', $_SERVER['REQUEST_URI']);
if (substr($request, -1) == '/') { $request = substr($request, 0, -1); }
if ($request == '') {
  $route = explode('#', $root);
  require_once $path . 'app/controllers/' . $route[0] . '.php';
  if (is_callable(($requestFunction = implode('_', $route))) === false) {
    throw404();
  }
  call_user_func($requestFunction, (isset($match) ? $match : null));
} else {
  foreach ($routes as $routeFrom => $routeTo) {
    if (preg_match('`^' . $routeFrom . '$`i', $request, $match) == 1) {
      $route = explode('#', $routeTo);
      require_once $path . 'app/controllers/' . $route[0] . '.php';
      if (is_callable(($requestFunction = implode('_', $route))) === false) {
        throw404();
      }
      call_user_func($requestFunction, (isset($match) ? $match : null));
      break;
    }
  }
}
$content = ob_get_contents();
ob_end_clean();
render('layouts/' . $application_layout);