<?php
if($_SESSION['clientData']['clientLevel'] < 2){
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

    <h1><?php if(isset($prodInfo['invName']))
    { echo "Delete $prodInfo[invName]";} ?></h1>

	<?php
		if (isset($message)) {
		 echo $message;
		}
	?>

  <form method="post" action="/herokuProject/products/">
    <fieldset>

    <label for="invName">Product Name</label>
    <input type="text" readonly name="invName" id="invName" <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>>

    <label for="invDescription">Product Description</label>
    <textarea name="invDescription" readonly id="invDescription"><?php if(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea>

    <label>&nbsp;</label>
    <input type="submit" class="regbtn" name="submit" value="Delete Product">

    <input type="hidden" name="action" value="deleteProd">
    <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">

    </fieldset>
</form>

	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
