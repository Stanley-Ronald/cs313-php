	  <?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/header.php'; ?>

	  <nav>
	  <?php echo navigation(); ?>
	  </nav>

	<main>

    <h1>Account Login</h1>

	<?php
		if (isset($message)) {
		 echo $message;
		}
	?>

		<form action="/herokuProject/accounts/index.php" method="post">
			<fieldset>
				<label>Email Address:</label><br>
				<input type ="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required><br>
				<label>Password:</label><br>
				<span>Passwords must be at least 8 characters and contain at least 1 number,
					1 capital letter and 1 special characters</span>
				<input type ="password" name="clientPassword" id="clientPassword"
				required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
				<input type="submit" value="Login">
				<input type="hidden" name="action" value="login">

			</fieldset>
		</form>

	<h2>Need to Resister?</h2>

		<form method="post" action="http://localhost/herokuProject/accounts/index.php?action=registration">
		<fieldset>
			<button type="submit" formaction="http://localhost/herokuProject/accounts/index.php?action=registration">Register here</button>
		</fieldset>
		</form>

	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
