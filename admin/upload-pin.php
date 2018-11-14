<?php

session_start();
if (!isset($_SESSION['username'])){
	
	header("location:index.php");
}
	
require_once('conn.php');

$sql = $conn->query("SELECT* FROM admntable");
$row = mysqli_fetch_assoc($sql);
$type = $pin = $price = $errormsg = $errtype = $errpin = $errprice = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	$type = htmlspecialchars($_POST['type']);
	$pin = htmlspecialchars($_POST['pin']);
	$price = htmlspecialchars($_POST['price']);
	$id = htmlspecialchars($_POST['id']);
	$status = "Active";
	
	$date = new DateTime();
	$dateTime = $date->format('Y-m-d H:i:s');
	
	if (empty($type) || !preg_match("/^[a-zA-Z ]*$/", $type)) {
		$errtype = "Specify type !";
		
	} else if (empty($pin) || !preg_match("/^[a-zA-Z 0-9 ]*$/", $pin)) {
		$errpin = "Give pin !";
		
	} else if (empty($price) || !preg_match("/^[0-9-+]*$/", $price)) {
		$errprice = "How much are selling the card !";
		
	} else {
	
	$sql = $conn->prepare("INSERT INTO addpin(type, pin, price, status, date)VALUES(?, ?, ?, ?, ?)");
		
		$sql->bind_param('sssss',  $type, $pin, $price, $status, $dateTime);
		
		$sql->execute();
		
		$errormsg = "<span class = 'msg'>" . "Submitted continue ... " . "</span>";
	}			
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

    <title>Admin | Manage Users</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <section id="container" >
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <a href="#" class="logo"><b>Admin</b></a>
           
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="#"><img src="assets/img/UGC%20Concept%20Logo.jpg"  width="80" height="70"></a></p>
              	  <h5 class="centered">Admin: <?php echo $_SESSION['username'];?></h5>
              	  	

                  <li class="mt">
                      <a href="manage-users.php" >
                          <i class="fa fa-users"></i>
                          <span>Manage Users</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">
                      <a href="available-card.php" >
                          <i class="fa fa-file"></i>
                          <span>Available Cards</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">
                      <a href="editprofile.php" >
                          <i class="fa fa-edit"></i>
                          <span>Edit profile</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">
                      <a href="#">
                          <i class="fa fa-upload"></i>
                          <span>upload pin</span>
                      </a>
                  </li>
				  
<!--
				  <li class="sub-menu">
                      <a href="logout.php">
                          <i class="fa fa-logout"></i>
                          <span>Loguot</span>
                      </a>
                  </li>
-->
              
                 
              </ul>
          </div>
      </aside>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Cards</h3>
				<div class="row">
				
                  
	                  
                  <div class="col-md-8">
					  
					  <h3>Uploading pin</h3>
					  
					  <form method="post">
						  <input type="hidden" name="id" value="<?php echo $rows['id']; ?>" >
						  <div class="form-group">
							  <label for="type">Type</label>
							  <select name="type" class="form-control">
							  
								  <option selected>Select type</option>
								  <option value="WEAC">WEAC</option>
								  <option value="JAMB">JAMB</option>
								  <option value="NECO">NECO</option>
							  
							  </select>
							  
							  	<?php echo $errtype; ?> <br />
						  </div>
						  <div class="form-group">
							  <label for="pin">Card Pin</label>
							  <input type="text" name="pin" placeholder="Card pin" class="form-control">
							  	<?php echo $errpin; ?> <br />
							
						  </div>
						  <div class="form-group">
							  <label for="price">Price</label>
							  <input type="text" name="price" placeholder="Card price" class="form-control">
							  	<?php echo $errprice; ?> <br />
							
						  </div>
						  <div class="form-group">
						  
							  <input type="submit" name="upload" value="update" class="btn btn-success">
						  
						  </div>
					</form>
				</div>
			 </div>
		</section>
      </section
  ></section>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/common-scripts.js"></script>
  <script>
      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
