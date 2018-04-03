<?php

//Main Controller

session_start();

require_once 'library/connections.php';
require_once 'model/heroku-model.php';
require_once 'library/functions.php';

navigation();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL)
{
 $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action){

 case 'something':

 break;

 default:
  include 'view/home.php';
}

?>
