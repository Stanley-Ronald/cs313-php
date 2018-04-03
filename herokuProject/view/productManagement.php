    <?php

    if ($_SESSION['clientData']['clientLevel'] < 2) {
     header('location: /herokuProject/');
     exit;
    }
    if (isset($_SESSION['message'])) {
     $message = $_SESSION['message'];
    }
    ?>

	  <?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/header.php'; ?>

	  <nav>
	  <?php echo navigation(); ?>
	  </nav>

	<main>

    <h1>Product Management</h1>

	<?php
		if (isset($message)) {
		 echo $message;
		}
	?>

	<h2><a href="/herokuProject/products/?action=newCategory" title="Add a new category">Add Category</a>
	<h2><a href="/herokuProject/products/?action=newProduct" title="Add a new product">Add Product</a>

		<?php
	if (isset($message)) {
	 echo $message;
	} if (isset($prodList)) {
	 echo $prodList;
	}
	?>

	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
<?php unset($_SESSION['message']); ?>
