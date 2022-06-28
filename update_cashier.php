<?php
session_start();
include_once('connect_db.php');
if(isset($_GET['id'])){
$userid=$_GET['id'];

}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> -Pharmacy Management System</title>
	<link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>
 <style>#left-column {height: 477px;}
 #main {height: 477px;}</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg" class="img"></a> Pharmacy Management System</h1></div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="admin.php">Home</a></li>
			<li><a href="admin_pharmacist.php">Pharmacist</a></li>
			<li><a href="admin_manager.php">Manager</a></li>
			<li><a href="admin_cashier.php">Cashier</a></li>
			<li><a href="logout.php">Logout</a></li>
			
		</ul>	
</div>
		</div>
    <?php
    include_once('connect_db.php');
    $queryfetch=mysqli_query($conn,"SELECT * FROM cashier WHERE cashier_id='".$userid."'") or die(mysqli_error());
    $rows=mysqli_num_rows($queryfetch);
    if($rows>0){
        while($data=mysqli_fetch_array($queryfetch)){
            $first_namec=$data['first_name'];
			$last_namec=$data['last_name'];
			$staff_idc=$data['staff_id'];
			$postalc=$data['postal_address'];
			$phonec=$data['phone'];
			$emailc=$data['email'];
			$usernamec=$data['username'];
			$passwordc=$data['password'];
        }
    }else{
        echo '<script>window.alert("No record found")</script>';
    }
    
    
    
    ?>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>Manage Cashier</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Update Cashier</a></li>  
              
        </ul>  
          
        <div id="content_1" class="content">  
		<?php echo $message1;?>
			<fieldset> <legend>Update cashier</legend>
          <form name="myform" onsubmit="return validateForm(this);" action="" method="post" class="" >
				
				<p>First_Name:<input name="first_name" type="text" style="width:170px" placeholder="First Name" value="<?php  echo $first_namec; ?>" id="first_name" /></p>
       <p>Last_name:<input name="last_name" type="text" style="width:170px" placeholder="Last Name" id="last_name" value="<?php echo $last_namec; ?>" /></p>
				<p>Staff_Id:<input name="staff_id" type="text" style="width:120px" placeholder="Staff ID" id="staff_id" value="<?php echo $staff_idc; ?>" /> </p> 
				<p>Postal_Addrss:<input name="postal_address" type="text" style="width:140px" placeholder="Address" id="postal_address" value="<?php echo $postalc; ?>" /> </p> 
				<p class="phoneu">Phone:<input name="phone" type="text" style="width:170px" placeholder="Phone" id="phone" value="<?php echo $phonec ; ?>" /> </p> 
				<p class="emailu">Email:<input name="email" type="text" style="width:170px" placeholder="Email" id="email"value="<?php echo $emailc ; ?>" /></p>   
				<p class="useru">Username:<input name="username" type="text" style="width:120px" placeholder="Username" id="username"value="<?php echo $usernamec ;?>" /></p>
				<p class="passu">Password:<input name="password" placeholder="Password" id="password"value="<?php echo $passwordc ;?>"type="text" style="width:150px"/></p>
				<p class="submu"><input name="submitu" type="submit" value="Update"/></p>
            
		</form>
				</fieldset>
		</div>  
        <?php
if(isset($_POST['submitu'])){
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$sid=$_POST['staff_id'];
$postal=$_POST['postal_address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$username=$_POST['username'];
$pas=$_POST['password'];
 
// get value of id that sent from address bar


// Retrieve data from database 
$sql=mysqli_query($conn, "UPDATE cashier SET first_name='$fname', last_name='$lname', staff_id='$sid',postal_address='$postal',phone='$phone',email='$email',username='$username', password='$pas' WHERE cashier_id='".$userid."'");
if($sql) {echo '<script type="text/javascript">'; 
echo 'alert("Record updated successifully.");'; 
echo 'window.location.href = "admin.php";';
echo '</script>';
}else{
$message1="<font color=red>Update Failed, Try again</font>";
}}
?>
        
        
        
        
        
        
    </div>  
</div>
</div>
</div>
</body>
</html>
