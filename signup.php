<?php

require_once('conn.php');

$username = $mail = $phone = $password = "";
$pass_er = $errusername = $errmail = $errphone = $errpassword = $errrepass = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	$username = htmlspecialchars($_POST['username']);
	$mail = htmlspecialchars($_POST['mail']);
	$phone = htmlspecialchars($_POST['phone']);
	$password = htmlspecialchars($_POST['password']);
	$repass = $_POST['repass'];
	
	$hashedpassword = password_hash($password, PASSWORD_DEFAULT);
	
	if (empty($username) || !preg_match("/^[a-zA-Z]*$/", $username)) {
		$errusername = "First name required !";
	} else if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		$errmail = "A valid mail required !";
	} else if (empty($phone) || !preg_match("/^[0-9-+]*$/", $phone)) {
		$errphone = "Phone number required !";
	} else if (empty($password) || !preg_match("/^['a-zA-Z0-9']*$/", $password)) {
		$errpass = "Password required !";
	} else if (empty($repass)) {
		
		$errrepass = "Confirm password!";
	} else {
		
		if ($password == $repass) {

		$sql = $conn->prepare("INSERT INTO ugctable(username, mail, phone, password)VALUES(?, ?, ?, ?)");

			$sql->bind_param('ssss', $username, $mail, $phone, $hashedpassword);

			$sql->execute();

			header("location:login.php");

		} else {
			
			$pass_er =  "<p class='msg' >" ."password mismatch try again" . "</p>";
		}	
	}
}

?>

<!doctype html>
<html lang="en">
	<head>
		<title> UGC || SignPage </title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/styl.css" media="all">
		<link rel="stylesheet" href="css/font-awesome.css">
	</head>
	<body>		
		<div class="mail">Contact@yahoo.com</div>
		<div class="container-fluid">
			<div class="col-md-1" ></div>
		  <div class="row" style="background-color: #fda100; margin-bottom: 2%;">
			  <div class="col-md-12" >
				<nav class="navbar navbar-inverse " style="width: 100%; background-color: #fda100; border-radius: 0%; border: none; padding: 0% 8% 0% 10%;">
					<div class="navbar-header">
						<a href="index.php"><img src="img/UGC%20Concept%20Logo.jpg" class="logo navbar-brand"></a>
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					  </button>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav navbar-left">

					  </ul>
						
					 <ul class="nav navbar-nav" style="color: black !important; float: right; font-size: 20px; padding-top: 20px;" >	
						<li><a href="login.php">login</a></li>
					  </ul>
					</div>
				  </nav>
			  </div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4"></div>
				
				<div class="col-md-4">
				
					<h3> Sign Up</h3>
					<?php echo  $pass_er; ?>
					<form method="post">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" class="form-control">
							<?php echo $errusername; ?>
						</div>
						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" name="phone" class="form-control">
							<?php echo $errphone; ?>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="mail" class="form-control">
							<?php echo $errmail; ?>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" class="form-control">
							<?php echo $pass_er; ?>
						</div>
						<div class="form-group">
							<label for="retype">Retype password</label>
							<input type="password" name="repass" class = "form-control">
							<?php echo $errrepass; ?>
						</div>
						<div class="form-group">
							
							<input type="submit" name="submit" value="Signup" class="btn btn-success">
							
						</div>
						
					</form>
				</div>
			</div>		
			
		</div>
		<footer>
			<div class="social">
				<p> JOIN US </p>
				<i class="fa fa-facebook"></i>
				<i class="fa fa-twitter"></i>
				<i class="fa fa-instagram"></i>
			</div>
			<div class="address">
				<p>ADDRESS</p>
				Opposite School gate<br>
				beside MOUAU ffilling station<br>
				Umudike, Ikwuano. Abia state.
			</div>
		</footer>
		<script src="js/js.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>