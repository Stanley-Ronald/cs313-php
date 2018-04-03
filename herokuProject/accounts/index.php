<?php

//Accounts Controller

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/heroku-model.php';
require_once '../model/accounts-model.php';
require_once '../model/products-model.php';
require_once '../library/functions.php';

// Get the array of categories
$categories = getCategories();

navigation();


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {


	case 'registration':
		include '../view/registration.php';
		break;

	case 'Login':
		include '../view/login.php';
		break;

	case 'Logout':
		session_destroy();
		header('location:/herokuProject');
		exit;
		break;

	case 'Admin':
		include '../view/admin.php';
		break;

	case 'register':
		// Filter and store the data
		$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
		$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
		$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
		$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
		$clientEmail = checkEmail($clientEmail);
		$checkPassword = checkPassword($clientPassword);

		// Check for an exisiting email
		$checkEmail = checkExistingEmail($clientEmail);

		// check for exisiting email address in the table
		if ($checkEmail) {
			$message = '<p> That email address already exists. Do you want to login instead?</p>';
			include '../view/login.php';
			exit;
			}

		// Check for missing data
		if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
			$message = '<p>Please provide information for all empty form fields.</p>';
			include '../view/registration.php';
		exit;
		}

		// Hash the checked password
		$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

		// Send the data to the model
		$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

		// Check and report the result
		if($regOutcome === 1){
		 setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
		 $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
		 include '../view/login.php';
		 exit;
		} else {
		 $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
		 include '../view/registration.php';
		 exit;
		}
		break;

	case 'login':
		$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
		$clientEmail = checkEmail($clientEmail);
		$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
		$passwordCheck = checkPassword($clientPassword);
		// Run basic checks, return if errors
		if (empty($clientEmail) || empty($passwordCheck)) {
		$message = '<p class="notice">Please provide a valid email address and password.</p>';
		include '../view/login.php';
		exit;
		}
		// A valid password exists, proceed with the login process
		// Query the client data based on the email address
		$clientData = getClient($clientEmail);
		// Compare the password just submitted against
		// the hashed password for the matching client
		$hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
		// If the hashes don't match create an error
		// and return to the login view
		if (!$hashCheck) {
		$message = '<p class="notice">Please check your password and try again.</p>';
		include '../view/login.php';
		exit;
		}
		// A valid user exists, log them in
		$_SESSION['loggedin'] = TRUE;
		setcookie('firstname', '', time() - 3600, '/');
		// Remove the password from the array
		// the array_pop function removes the last
		// element from an array
		array_pop($clientData);
		// Store the array into the session
		$_SESSION['clientData'] = $clientData;
		$_SESSION['message'] = "You have succesfully logged in!";

    include '../view/admin.php';
		exit;
			break;

	case "updateInfo":
		$clientId = $_SESSION['clientData']['clientId'];
		$clientInfo = getclientInfo($clientId);
		if(count($clientInfo)<1){
			$message = 'Sorry, the information entered could be found.';
			}
			include '../view/client-update.php';
			exit;
		break;

	case "newPassword":
		$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
		$clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
		$passwordCheck = checkPassword($clientPassword);

		if (empty($passwordCheck)) {
			$message = '<p class="notice">Please provide a valid password.</p>';
			include '../view/client-update.php';
			exit;
			}
			$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
			$changeResult = clientPassword($hashedPassword, $clientId);
			if ($changeResult) {
				$message = "<p>Congratulations, Your password information was successfully updated.</p>";
				$_SESSION['message'] = $message;
				header('location: /herokuProject/accounts/');
				exit;
				} else {
				$message = "<p class='notice'>Error: Your password was not updated. Please try again.</p>";
				$_SESSION['message'] = $message;
				header('location: /herokuProject/accounts/');
				exit;
				}
		break;

	case "clientUpdate":
		$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
		$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
		$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
		$clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
		$clientEmail = checkEmail($clientEmail);

		if ($_SESSION['clientData']['clientEmail'] != $clientEmail) {

		    if (checkExistingEmail($clientEmail)) {
		        $message = "That email is already in use! Please enter another email address.";
		        include '../view/client-update.php';
		        exit;
		        }
		    }
		    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientId)) {
				$message = '<p class="fillfields">Please provide information for all required fields.</p>';
				include '../view/client-update.php';
		    exit; }
		    $updateResult = clientUpdate($clientFirstname, $clientLastname, $clientEmail, $clientId);
		    if ($updateResult) {
				$message = "<p>Congratulations $clientFirstname, your information was successfully updated.</p>";
				$_SESSION['message'] = $message;
				$_SESSION['clientData'] = getClient($clientEmail);
				header('location: /herokuProject/accounts/');
		    exit;
			} else {
				$message = "<p class='notice'>Error: Your account was not updated. Please try again.</p>";
				$_SESSION['message'] = $message;
				header('location: /herokuProject/accounts/');
				exit;
				}
				break;

   default:
	 include '../view/admin.php';
}

?>
