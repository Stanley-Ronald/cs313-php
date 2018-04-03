	  <?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/header.php'; ?>
	  <nav>
	  <?php echo navigation(); ?>
	  </nav>

	<main>

    <h1>User Registration</h1>

		<?php
		if (isset($message)) {
		 echo $message;
		}
		?>


		<form method="post" action="/herokuProject/accounts/index.php">
			<fieldset>
				<label>First Name:</label><br>
				<input type ="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required><br>
				<label>Last Name:</label><br>
				<input type ="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required><br>
				<label>E-mail:</label><br>
				<input type ="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required><br>
				<label>Password:</label><br>
				<span>Passwords must be at least 8 characters and contain at least 1 number,
					1 capital letter and 1 special characters</span>
				<input type ="password" name="clientPassword" id="clientPassword"
				required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
				<input type="submit" value="Register">
				<input type="hidden" name="action" value="register">
			</fieldset>
		</form>

	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
