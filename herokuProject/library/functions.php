<?php

function checkEmail($clientEmail) {
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword) {
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
  return preg_match($pattern, $clientPassword);
}

// buils the nav menu
  function navigation(){
    $categories = getCategories();

    $navList = '<ul>';
    $navList .= "<li><a href='/herokuProject/index.php' title='View the home page'>Home</a></li>";
    foreach ($categories as $category) {
      $navList .= "<li><a href='/herokuProject/products/?action=category&type=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
  }

  //build a display of products within an unordered list
  function buildProductsDisplay($products){
 $pd = '<ul id="prod-display">';
 foreach ($products as $product) {
  $pd .="<li><a href='/herokuProject/products/?action=productDetail&id=$product[invId]' title='View our $product[invName] product line'>";
  $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on RSGlasses.com'>";
  $pd .= '<hr>';
  $pd .= "<h2>$product[invName]</h2>";
  $pd .= "<span>$$product[invPrice]</span>";
  $pd .= '</li>';
 }
 $pd .= '</ul>';
 return $pd;
}

  function buildProductView($product){
    foreach ($product as $prod) {
  $item = '<div>';
  $item .= '<div id="productImage">';
  $item .= "<img src='$prod[invImage]' alt='Image of $prod[invName] on RSGlasses.com'>";
  $item .= '</div>';
  $item .= '<div>';
  $item .= '<hr>';
  $item .= "<h1>$prod[invName]</h1>";
  $item .= "<p>Description: $prod[invDescription]</p>";
  $item .= "<p>Size: $prod[invSize] inches</p>";
  $item .= "<p>Cost: $$prod[invPrice]</p>";
  $item .= "<p>Stock: $prod[invStock]</p>";
  $item .= '</div>';
  $item .= '</div>';
 }
 return $item;
}

function makeThumbnailName($image) {
 $i = strrpos($image, '.');
 $image_name = substr($image, 0, $i);
 $ext = substr($image, $i);
 $image = $image_name . '-tn' . $ext;
 return $image;
}


// Build the products select list
function buildProductsSelect($products) {
 $prodList = '<select name="invId" id="invId">';
 $prodList .= "<option>Choose a Product</option>";
 foreach ($products as $product) {
  $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
 }
 $prodList .= '</select>';
 return $prodList;
}


?>
