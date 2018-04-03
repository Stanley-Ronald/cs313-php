		<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/header.php'; ?>

	  <nav>
	  <?php echo navigation(); ?>
	  </nav>

	<main>
    <h1><?php echo $type; ?> Products</h1>
    <?php if(isset($message)){ echo $message; } ?>

    <?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>


	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
