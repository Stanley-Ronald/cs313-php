<?php

/* Products model */

function insertProducts($invDescription, $invImage, $invName, $invPrice, $invStock, $invThumbnail, $categoryId) {
$db = herokuConnect();
$sql = 'INSERT INTO inventory(invDescription, invImage, invName, invPrice, invStock, invThumbnail, categoryId)
VALUES (:invDescription, :invImage, :invName, :invPrice, :invStock, :invThumbnail, :categoryId)';
$stmt = $db->prepare($sql);
$stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
$stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
$stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
$stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
$stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
$stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
$stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

function addCategory($categoryName){
$db = herokuConnect();
$sql = 'INSERT INTO categories(categoryName)
VALUES (:categoryName)';
$stmt = $db->prepare($sql);
$stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

// This function will get basic product info from the inventory table
// for starting an update or delete process
function getProductBasics() {
 $db = herokuConnect();
 $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

// selecting a single product based on its id
// Get product information by invId
function getProductInfo($invId){
 $db = herokuConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}

// update product
function updateProd($invDescription, $invImage, $invName, $invPrice, $invStock, $invThumbnail, $categoryId, $invId){
  $db = herokuConnect();
  $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, categoryId = :categoryId WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function deleteProduct($invId) {
 $db = herokuConnect();
 $sql = 'DELETE FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

//get a new list of products based on category
function getProductsByCategory($type){
 $db = herokuConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryId)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':categoryId', $type, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

// get product id
function getProductId($invId){
  $db = herokuConnect();
  $sql = 'SELECT * FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $product;
}
?>
