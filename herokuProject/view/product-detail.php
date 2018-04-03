	  <?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/header.php'; ?>

	  <nav>
	  <?php echo navigation(); ?>
	  </nav>

<main>
  <?php
		if(isset($message)){ echo $message; }
   	if(isset($prodDisplay)){ echo $prodDisplay; }
	?>

	<?php if(isset($_SESSION['loggedin'])){ ?>

	<?php
	   $clientFirstname = $_SESSION['clientData']['clientFirstname'][0];
	   $clientLastname = $_SESSION['clientData']['clientLastname'];
	   $screenName = $clientFirstname.$clientLastname;
	?>

</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
