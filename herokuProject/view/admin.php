<?php
if(!$_SESSION['loggedin']){
  header ("location: /herokuProject/");
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

    <?php
         if (isset($_SESSION['clientData']['clientFirstname'])) {
         $firstName = $_SESSION['clientData']['clientFirstname'];}
         if (isset($_SESSION['clientData']['clientLastname'])) {
          $lastName = $_SESSION['clientData']['clientLastname'];}
         if (isset($_SESSION['clientData']['clientEmail'])) {
          $email = $_SESSION['clientData']['clientEmail'];}
         if (isset($_SESSION['clientData']['clientLevel'])) {
         $level = $_SESSION['clientData']['clientLevel'];}

         echo "<h3>$firstName $lastName is currently logged in!</h3>";

     if (isset($message)){
     echo $message; }
         echo "<ul>
             <li>First Name: $firstName</li>
             <li>Last Name: $lastName</li>
             <li>Email Address: $email</li>
             </ul>";
         echo '<a href="http://localhost/herokuProject/accounts/index.php?action=updateInfo">Update Account Information<a/>';

         if ($level > 1){
              echo '<h2>Administrative Functions</h2>';
              echo'<p>Please use the link below to manage products.</p>';
             echo '<a class= "link2" href="http://localhost/herokuProject/products/index.php?action=default">Products</a>';
         }
         ?>
          <?php if(isset($reviewInfoData)){ echo $reviewInfoData; } ?>

	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/herokuProject/common/footer.php'; ?>
</div>

</body>
</html>
