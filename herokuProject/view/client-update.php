<?php
if(!$_SESSION['loggedin']){
  header ("location: /herokuProject/");
}?>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/header.php'; ?>
	  <nav>

	  <?php echo navigation(); ?>
	  </nav>

	<main>

    <h2>Update Your Account Information</h2>

    <p>All fields are required</p>
    <?php
    if (isset($message)){
      echo $message;
      } ?>

    <form action="/herokuProject/accounts/" method="post">
      <fieldset>
        <label>First Name:</label>
          <input name="clientFirstname" id="clientFirstname" type="text" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'"; } ?>><br>

        <label>Last Name:</label>
          <input name="clientLastname" id="clientLastname" type="text" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'"; } ?>><br>

        <label>Client Email:</label>
          <input name="clientEmail" id="clientEmail" type="text" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'"; } ?>>

          <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>"><br>
          <input type="submit" value="Update Information">
          <input type="hidden" name="action" value="clientUpdate">

      </fieldset>
    </form>

    <h2>Change Password</h2>
    <p>This information you enter will become your NEW password.</p>
    <?php
    if (isset($message)){
      echo $message;
    }?>

    <form action="/herokuProject/accounts/" method="post">
      <fieldset>

        <label>Confirm Password:</label>
        <input type="password" name="clientPassword" id="clientPassword" <?php if(isset($clientPassword)){echo "value='$clientPassword'";} ?> pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>

        <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
        <span>Passwords must be at least 8 characters, contain at least 1 number, 1 captial letter, and 1 special character.</span><br>
        <input type="submit" value="New Password">
        <input type="hidden" name="action" value="newPassword">

      </fieldset>
    </form>



	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
