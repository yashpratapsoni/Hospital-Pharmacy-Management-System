<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['manager_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> - Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" type="text/css" href="style/home.css">
 <link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<script src="js/function.js" type="text/javascript"></script>

</head>
<body>
<div style="width: 100%;display: flex;flex-direction: column;">
    <div class="div1">

        <div class="bnr" style="margin-top: 0px">
            <img src="images/logo.png" width="67px" height="" />
        </div>

        <div class="bnr" style="margin-left: 100px">
            HOSPITAL PHARMACY MANAGEMENT SYSTEM
        </div>
         <?php 
	include('connect_db.php');
	$qury=mysqli_query($conn, "SELECT * from stock where status='low'") or die(mysqli_error());
	$ros=mysqli_num_rows($qury);
	if($ros>0){
		?>
	 <div class="bnr" style="margin-top: 17px;margin-left: 0px">
	 	<img src="images/red.png" class="imgc">: Low stock</div>
	<?php
	}else{
		?>
	<div class="bnr" style="margin-top: 17px">
		<img src="images/green.png" class="imgc">: Enough stock
	</div>
	<?php	
	}
	?>
     <div class="bnr" style="margin-top: 17px">
            <a href="logout.php">
                <button class="lout" style="vertical-align:middle;">
                <div style=" display: flex; justify-content: space-between;">
                <img src="images/user.png" style="width: 25px">
                <div style="padding:5px;color: #000000;">
                    <b>Logout</b>
                </div>
                </div>
                </button>
            </a>
        </div>
    </div>

<div style="width: 100%;display: flex;">

        <div>
            <a href="manager.php" style="text-decoration:none;"><button class="button">Home</button></a>
            <a href="view.php" style="text-decoration:none;"><button class="button">View Users</button></a>
            <a href="view_prescription.php" style="text-decoration:none;"><button class="button">View Prescription</button></a>
            <a href="stock.php" style="text-decoration:none;"><button class="button">Manage Stock</button></a>
        </div>
<div class="content" style="margin-left: 265px">
            <table class="tb">
                <tr>
                    <td>
                    	<img src="images/manager_icon.png" height="200" alt="edit" />
                    </td>
                    <td>
                    	<img src="images/patients_1.png"  height="200" alt="edit" />
                    </td>
                </tr>
                <tr>
                	<td align="center">
                		<a href="manager.php" class="link">
                		<span>Dashboard</span>
                		</a>
                	</td>
                	<td align="center">
                		<a href="view.php" class="link">
                	<span>View Users</span>
                </a>
                	</td>
                </tr>
                <tr>
                    <td>
                    	<img src="images/prescri.jpg" height="200" alt="edit" />
                    </td>
                    <td>
                    	<img src="images/stock_icon.jpg" height="200" alt="edit" />
                    </td>
                </tr>
                <tr>
                	<td align="center">
                		<a href="view_prescription.php" class="link">
                	<span>View Prescription</span>
				</a>
                	</td>
                	<td align="center">
                		<a href="stock.php" class="link">
                	<span>Manage Stock</span>
                </a>
                	</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="background-color: #231F20; font-size: 17px;padding: 6px; margin-top: 228px">
            <p style="float: left; padding-left: 30px;color: #ffffff; margin: 5px">&copy; 2022 Pharmacy. All Rights Reserved</p>
            <p style="float: right; padding-right: 30px;color: #ffffff; margin: 5px;"> Designed By : Yash & Yuvraj</p>
    </div>
</div>
</body>
</html>
