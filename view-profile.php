<?php

session_start();

require_once('conn.php');

if (!ISSET($_SESSION['username'])) {
	
	header("location:login.php");
}
	$username = $_SESSION['username'];
	$select = $conn->query("SELECT* FROM ugctable WHERE username = '$username'");
	$row = mysqli_fetch_assoc($select); 

	$conn->close();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	$username = txt($_post['user']);
	$phone = txt($_post['phone']);
	$mail = txt($_post['mail']);
	
	if (empty($username) || !preg_match("/^['a-zA-Z 0-9]*$/", $username)) {
		$erruser = "Field required!";
	} elseif (empty($phone) || !preg_match("/^['0-9']*$/", $phone)) {
		$errphone = "Field required";
	} else if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL )){
		$ermail = "A valid email address needed";
	} else {
		
		$sql = "UPDATE  ugctable set $username = ?, $phone = ?, $mail = ? WHERE $sername = ? ";
		
		$sql->bind_param('sssi', $username, $phone, $mail);
		$sql->execute();
		
	}
}

 function txt($txt) {
	
	$txt = trim($txt);
	$txt = htmlspecialchars($txt);
	$txt = stripslashes($txt);
	return $txt;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title> User Dashboard </title>
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <link href="admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="admin/assets/css/style.css" rel="stylesheet">
    <link href="admin/assets/css/style-responsive.css" rel="stylesheet">
</head>
<body>
    <section id="container" >
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <a href="#" class="logo"><b> Users </b></a>
            <div class="nav notify-row" id="top_menu">
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                  <li><a class="logout" href="#"><?php echo $_SESSION['username'];?></a></li>
                    <li><a class="logout" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </header>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="#"><img src="img/UGC%20Concept%20Logo.jpg"  width="60"></a></p>
                  <h5 class="centered"><?php echo $_SESSION['username'];?></h5>
                    
                  <li class="mt">
                      <a href="Welcome.php" >
                          <i class="fa fa-file"></i>
                          <span> Dashboard </span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">
                      <a href="view-profile.php" >
                          <i class="fa fa-user"></i>
                          <span>View profile</span>
                      </a>
                   
                  </li>
				  <li class="sub-menu">
                      <a href="index.php" >
                          <i class="fa fa-user"></i>
                          <span>Buy card</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">
                      <a href="#" >
                          <i class="fa fa-money"></i>
                          <span>Transactions</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="#">
                          <i class="fa fa-file"></i>
                          <span>Change Password</span>
                      </a>
                  </li>
              </ul>
          </div>
      </aside>
        <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Users Dashboard </h3>
                <div class="row">
           
                  <div class="col-md-12">
					  <div class="col-md-6" >
                     
			<div style="padding: 5%;">
				
				<div class="col-md-12"  >
                     
			<div style="margin-top: 50px; padding: 2% 4% 4% 4%; box-shadow: 0px 0px 10px 2px #ccc; border-radius: 3px">
				<div class="form-group">
				
					<label for="username">Username</label>
					<input type="text" name="user" value="<?php echo $row['username']; ?>" class="form-control">
				</div>
				<div class="form-group">
				
					<label for="email">Email</label>
					<input type="email" name="mail" value="<?php echo $row['mail']; ?>" class="form-control">
				</div>
				<div class="form-group">
				
					<label for="phonee">Phone</label>
					<input type="text" name="phone" value="<?php echo $row['phone']; ?>" class="form-control">
				</div>
				<div class="form-group">
				
					<input type="submit" name="submit" value="Update" class="btn btn-info">
				</div>
				
			</div>		
          </div>
			</div>		
        </div>
        <div class="col-md-5">
			<div class="howitworks" style="margin-top: 50px; padding: 2% 0% 4% 4%; box-shadow: 0px 0px 10px 2px #ccc; border-radius: 3px">
				<div class="howitworks2">
					<h2>HOW IT WORKS </h2>
				</div>
				<div class="how">
					<h3> 
						Create a new UGC account 
						<span class="howitspan">
						Step 1 
						</span>
					</h3> 
					<h3>
						<p> Create a new UGC wallet 
							<span class="howitspan"> Step 2 </span>
						</p>
					</h3>
					<h3>
						Fund your UGC account using the 

						UGC concept <br> account uising the following 
					</h3>
				</div>
				<div class="bank">
					<p> Bank Acc Detail </p> 
					<p> Bank: Firstbank PLC ltd </p>
					<p> Acc Name: CEOU Data consult. </p>
					<p> Act No. 2031433484 </p>
				</div>
			</div>
		</div>
      </div>
</div>                      
        </section>
      </section>
      </section>

    <script src="admin/assets/js/jquery.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="admin/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="admin/assets/js/jquery.scrollTo.min.js"></script>
    <script src="admin/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="admin/assets/js/common-scripts.js"></script>
  <script>
      $(function(){
          $('select.styled').customSelect();
      });

  </script>
</body>

</html>
