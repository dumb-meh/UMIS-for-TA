<?php
require_once 'header.php';
require_once 'additonal/dbh.add.php';
require_once 'additonal/functions.add.php';
if (isset($_GET["error"])) {
  if ($_GET["error"] == "none") {
    echo "<span style='padding-left: 850px !important;  color: white; font-size: 25px;'>Success! Message Sent</span>";

  }
  if ($_GET["error"] == "invalidEmail") {
    echo "<span style='padding-left: 850px !important;  color: white; font-size: 25px;'>Invalid Email! University Email Only</span>";

  }
}

  if (isset($_POST["submit"])) {

  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message=$_POST["message"];

  if(invalidUid($email)){
  header ("location: contact.php?error=invalidEmail");
  exit();
}
 contactUs($name, $email, $phone, $message, $conn);
}
?>
<html>
<head>
	<title>Contact us</title>
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>

    <section>

    </section>
	<div class="container2">
		<div class="contact-box">
			<div class="left">
                <img src="img/bg4.jpg" class="imgSize1">
            </div>
			<div class="right">
        <form class="" action="" method="post">
          <h2 class="contact-h2">Contact Admin</h2>
          <input type="text" class="field" name="name" placeholder="Your Name" required>
          <input type="email" class="field" name="email" placeholder="Your Email" required>
          <input type="tel" class="field" name="phone" placeholder="Phone" required>
          <textarea placeholder="Message" name="message" class="field" required></textarea>

  				<button class="btn" type="submit" name="submit">Send</button>
        </form>

			</div>
		</div>
	</div>
</body>
</html>
