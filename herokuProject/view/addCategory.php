<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /herokuProject/');
 exit;
}
?>
	  <?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/header.php'; ?>

	  <nav>
	  <?php echo navigation(); ?>
	  </nav>

	<main>

    <h1>Add Category</h1>
	<p>Please enter all fields</p>

	<?php
		if (isset($message)) {
		 echo $message;
		}
	?>

		<form action="/herokuProject/products/index.php" method="post">
			<fieldset>
				<label>Category Name:</label><br>
				<input type ="text" name="categoryName" id="categoryName" <?php if(isset($categoryName)){echo "value='$categoryName'";} ?> required><br>
				<input type="submit" value="Add Category">

				<input type="hidden" name="action" value="addCategory">
			</fieldset>
		</form>

	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
