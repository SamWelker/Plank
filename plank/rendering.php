<?php
$application_layout = 'application';

function layout($layout) {
  global $application_layout;
  $application_layout = $layout;
}

function render($options = null) {
  global $route, $path, $urlpath, $themeurl, $themedir, $content;
  if (isset($options) === false || isset($options['view']) === false) {
    $view = implode('/', $route);
  } else if (is_string($options) === true) {
    $view = $options;
  }
  if (is_array($options) === true) {
    foreach ($options as $key => $value) { $$key = $value; }
  }
  $view = str_replace('..', '', $view) . '.php';
  if (file_exists($themedir . $view) === true) { include $themedir . $view; }
  else { include $path . 'app/views/' . $view; }
}