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
		$catList .= ">".$category["categoryName"]."</option>";
	}

$catList.= '</select>';
?>

	  <?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/header.php'; ?>

	  <nav>
	  <?php echo navigation(); ?>
	  </nav>

	<main>

    <h1>Add Product</h1>
	<p>Please enter all fields</p>

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
				<input type ="text" name="invName" id="invName" <?php if(isset($invName)){echo "value='$invName'";} ?> required><br>
				<label>Product Description:</label><br>
				<input type ="text" name="invDescription" id="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";} ?> required><br>
				<label>Product Image:</label><br>
				<input type ="text" name="invImage" id="invImage" value="../images/" <?php if(isset($invImage)){echo "value='$invImage'";} ?> required><br>
        <label>Product Thumbnail:</label><br>
				<input type ="text" name="invThumbnail" id="invThumbnail" value="../images/" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required><br>
				<label>Product Price:</label><br>
				<input type ="number" name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required><br>
				<label>Product Stock:</label><br>
				<input type ="number" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required><br>

				<input type="submit" value="Add Product">
				<input type="hidden" name="action" value="addProducts">
			</fieldset>
		</form>

	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
