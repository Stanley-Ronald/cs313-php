<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /herokuProject/');
 exit;
}
?>

<?php //Build a drop-down and its going to populate in products forms.
$catList = '<select name="categoryId" id="categoryId">';
$catList .= " <option>Select a Category</option>";
foreach ($categories as $category){
		$catList .= " <option value='".$category["categoryId"]."'";
		//if my category has already been selected
		if(isset($categoryId)) {
			if($category['categoryId'] === $categoryId){
				$catList .= 'selected';
			}
		}
    elseif(isset($prodInfo['categoryId'])){
  if($category['categoryId'] === $prodInfo['categoryId']){
   $catList .= ' selected ';
  }
}
$catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
?>

	  <?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/header.php'; ?>

	  <nav>
	  <?php echo navigation(); ?>
	  </nav>

	<main>

    <h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";}
    elseif(isset($invName)) { echo $invName; }?></h1>

	<?php
		if (isset($message)) {
		 echo $message;
		}
	?>

		<form action="/herokuProject/products/index.php" method="post">
			<fieldset>
				<label>Categories</label><br>

				<?php echo $catList;?><br>

				<label>Product Name:</label><br>
				<input type="text" name="invName" id="invName" required <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>><br>
				<label>Product Description:</label><br>
				<input type="text" name="invDescription" id="invDescription" required <?php if(isset($invDescription)){ echo "value='$invDescription'"; } elseif(isset($prodInfo['invDescription'])) {echo "value='$prodInfo[invDescription]'"; }?>><br>
				<label>Product Image:</label><br>
				<input type="text" name="invImage" id="invImage" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; }?>><br>
        <label>Product Thumbnail:</label><br>
				<input type="text" name="invThumbnail" id="invThumbnail" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; }?>><br>
				<label>Product Price:</label><br>
				<input type="text" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?>><br>
				<label>Product Stock:</label><br>
				<input type="text" name="invStock" id="invStock" required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?>><br>

        <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
        <input type="submit" name="submit" value="Update Product">
				<input type="hidden" name="action" value="updateProd">

			</fieldset>
		</form>

	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
