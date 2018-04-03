<?php

//Products Controller

session_start();

require_once '../library/connections.php';
require_once '../model/heroku-model.php';
require_once '../model/accounts-model.php';
require_once '../model/products-model.php';
require_once '../library/functions.php';

// Get the array of categories
$categories = getCategories();

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

switch ($action) {
	case 'newCategory':
		include '../view/addCategory.php';
		break;
	case 'newProduct':
		include '../view/addProducts.php';
		break;
	case 'addProducts':

	$categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_STRING);
	$invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
	$invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
	$invName= filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
	$invPrice= filter_input(INPUT_POST, 'invPrice', FILTER_VALIDATE_FLOAT);
	$invStock= filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_FLOAT);
	$invThumbnail= filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);

		// Check for missing data
		if(empty($categoryId) || empty($invDescription) || empty($invImage) || empty($invName) || empty($invPrice) || empty($invStock) || empty($invThumbnail))
		{
		$message = '<p>Please provide information for all empty form fields.</p>';
		include '../view/addProducts.php';
		exit;
		}

		// Send the data to the model
		$prodOutcome = insertProducts($invDescription, $invImage, $invName, $invPrice,
		$invStock, $invThumbnail, $categoryId);

		// Check and report the result
		if($prodOutcome === 1){
		 $message = "<p>Thanks for adding $invName. </p>";
		 include '../view/productManagement.php';
		 exit;
		} else {
		 $message = "<p>Sorry it failed. Please try again.</p>";
		 include '../view/addProducts.php';
		 exit;
		}
		break;

    case 'updateProd':
      $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_STRING);
      $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
      $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
      $invName= filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
      $invPrice= filter_input(INPUT_POST, 'invPrice', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $invStock= filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
      $invThumbnail= filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

      // Check for missing data, we have visual confirmation
      if(empty($categoryId) || empty($invDescription) || empty($invImage) || empty($invName) || empty($invPrice) || empty($invStock) || empty($invThumbnail) || empty($invId)){
      $message = '<p class="fillfields">Please provide information for all empty form fields.</p>';
      include '../view/prod-update.php';
      exit; }
      //call the function from the model
      $updateResult = updateProd($invDescription, $invImage, $invName, $invPrice, $invStock, $invThumbnail, $categoryId, $invId);
      if ($updateResult) {
      $message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
      $_SESSION['message'] = $message;
      header('location: /herokuProject/products/');
      exit;
    }
    else {
  $message = "<p class='notice'>Error: $invName was not updated.</p>";
  $_SESSION['message'] = $message;
  header('location: /herokuProject/products/');
  exit;
 }
 break;

		case 'addCategory':
		$categoryName = filter_input(INPUT_POST, 'categoryName');

		if (empty($categoryName)) {
			$message = '<p>Please provide information for all empty form fields.</p>';
			include '../view/addCategory.php';
			exit;
		}

		$categOutcome = addCategory($categoryName);

		if($categOutcome === 1){
		header ("location: /herokuProject/products/index.php");
		} else {
		 $message = "<p>Sorry it failed. Please try again.</p>";
		 include '../view/addCategory.php';
		 exit;
		}
		break;

    case 'mod':
     $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
     $prodInfo = getProductInfo($invId);
     if(count($prodInfo)<1){
      $message = 'Sorry, no product information could be found.';
     }
     include '../view/prod-update.php';
     exit;
    break;

    case 'del':
     $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
     $prodInfo = getProductInfo($invId);
     if (count($prodInfo) < 1) {
      $message = 'Sorry, no product information could be found.';
     }
     include '../view/prod-delete.php';
     exit;
     break;

     case 'deleteProd':
      $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

      $deleteResult = deleteProduct($invId);
      if ($deleteResult) {
       $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
       $_SESSION['message'] = $message;
       header('location: /herokuProject/products/');
       exit;
      } else {
       $message = "<p class='notice'>Error: $invName was not deleted.</p>";
       $_SESSION['message'] = $message;
       header('location: /herokuProject/products/');
       exit;
      }
      break;

      case 'category':
       $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
       $products = getProductsByCategory($type);
       if(!count($products)){
        $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
       } else {
        $prodDisplay = buildProductsDisplay($products);
       }
       //echo $prodDisplay;
       //exit;
       include '../view/category.php';
       break;

      case 'productDetail':
      $invId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      $thumbnails = getThumbnail($invId);
      $product = getProductId($invId);
      $invReview = getReviewsByInvId($invId);

      if (!count($product)){
      $message = "<p>Sorry, that product could not be found.</p>";
      } else {
      $prodDisplay = buildProductView($product);
	    $reviewDisplay = buildReviewDisplay($invReview);
      }

      include '../view/product-detail.php';
      break;


      default:
      $products = getProductBasics();
      if(count($products) > 0){
      $prodList = '<table>';
      $prodList .= '<thead>';
      $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
      $prodList .= '</thead>';
      $prodList .= '<tbody>';
      foreach ($products as $product) {
       $prodList .= "<tr><td>$product[invName]</td>";
       $prodList .= "<td><a href='/herokuProject/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
       $prodList .= "<td><a href='/herokuProject/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
      }
       $prodList .= '</tbody></table>';
      } else {
       $message = '<p class="notify">Sorry, no products were returned.</p>';
      }

    include '../view/productManagement.php';
    break;
    }

?>
