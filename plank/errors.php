<?php
/**
 *    Plank's database connection.
 *
 *    @author   Fourdeo <we.are@fourdeo.com>
 *    @version  0.3
 */
 
function plank_errors($number, $string, $file, $line, $context) {
  //  The error number isn't normal.
  if(!($number & error_reporting())) {
    return;
  }
  
  //  LOL, JK. It's all good.
  switch($number) {
    case E_USER_ERROR:
      echo '
            <div class="anchor fatal error">
              <h1>Fatal error <em>(' . $number . ': ' . $string . ')</em>!</h1>
              <p>Your code has a fatal error on line ' . $line . ', in ' . $file . '.</p>
              <p>You&rsquo;re running PHP ' . PHP_VERSION . ', on ' . PHP_OS . ', and using Plank version ' . $version . '.</p>
              <p>I can see the light&hellip; Goodbye, cruel developer!</p>
            </div>
           ';
      exit;
      break;
    
    case E_USER_WARNING:
      echo '
            <div class="anchor warning error">
              <h1>Warning error <em>(' . $number . ': ' . $string . ')</em>!</h1>
              <p>Your code has an error on line ' . $line . ', in ' . $file . '.</p>
              <p>You&rsquo;re running PHP ' . PHP_VERSION . ', on ' . PHP_OS . ', and using Plank version ' . $version . '.</p>
              <p>This isn&rsquo;t a fatal error, and will be fine once you turn Plank&rsquo;s error handling off.</p>
            </div>
           ';
      break;
    
    case E_USER_NOTICE:
      echo '
            <div class="anchor notice error">
              <h1>Just an FYI <em>(' . $number . ': ' . $string . ')</em>!</h1>
              <p>Just to let you know, something&rsquo;s up on line ' . $line . ', in ' . $file . '.</p>
              <p>You&rsquo;re running PHP ' . PHP_VERSION . ', on ' . PHP_OS . ', and using Plank version ' . $version . '.</p>
              <p>This isn&rsquo;t a fatal error, and will be fine once you turn Plank&rsquo;s error handling off.</p>
            </div>
           ';
      break;
    
    default:
      echo '
            <div class="anchor unknown error">
              <h1>How bizarre! <em>(' . $number . ': ' . $string . ')</em>!</h1>
              <p>There was an unkown error on line ' . $line . ', in ' . $file . '.</p>
              <p>You&rsquo;re running PHP ' . PHP_VERSION . ', on ' . PHP_OS . ', and using Plank version ' . $version . '.</p>
            </div>
           ';
      break;
    
  }

  return true;
}

//  If debugging is turned on
if(isset($debug)) {
  set_error_handler('plank_errors', E_ALL);
}