<!DOCTYPE html>
<head>

  <title>RS Sunglasses</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/styles.css">

</head>

<body>

  <div id="wrapper">

<header>
	<div>
	<a></a>
	</div>
	<div id="myAccount">
		<?php if(isset($cookieFirstname)){
     echo "<span>Welcome $cookieFirstname</span>";
    } ?>
    <?php if(isset($_SESSION['loggedin'])){
    ?>
		<a href="/herokuProject/accounts/?action=Logout" title="Logout">Logout</a>
		<img src="/herokuProject/images/site/account.gif" alt="folder image" height='30' width='35'>
		<a href="/herokuProject/accounts/?action=Admin" title="welcome">Welcome
     <?php
    echo $_SESSION['clientData']['clientFirstname']; ?></a>
     <?php
	 }else{ ?>
		<img src="/herokuProject/images/site/account.gif" alt="folder image" height='30' width='35'><a href="/herokuProject/accounts/?action=Login" title="Go to account">My Account</a>
	 <?php
		} ?>

	</div>
</header>
