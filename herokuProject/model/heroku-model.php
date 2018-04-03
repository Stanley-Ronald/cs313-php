<?php

/* Heroku Model */
function getCategories(){

$db = herokuConnect();
$sql = 'SELECT categoryId, categoryName FROM categories ORDER BY categoryName ASC';
$stmt = $db->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll();
$stmt->closeCursor();
return $categories;
}

?>
