<html>
    <!DOCTYPE html>
<form action="" method="post">  
<?php
session_start();
include_once('connect_db.php');
	if(isset($_GET['id'])){
$userid=$_GET['id'];
	}
	?>
<head>
<title><?php $userid;?> Pharmacy Management System</title>

<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" type="text/css" href="style/form.css">
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
			<li><a href="admin.php">Dashboard</a></li>
			<li><a href="admin_pharmacist.php">Pharmacist</a></li>
			<li><a href="admin_manager.php">Manager</a></li>
			<li><a href="admin_cashier.php">Cashier</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
		</div>
	<?php
	include_once('connect_db.php');
	$querydata=mysqli_query($conn, "SELECT * FROM pharmacist where pharmacist_id='".$userid."'") or die(mysqli_error());
	$rows=mysqli_num_rows($querydata);
	if($rows>0){
		while($data=mysqli_fetch_array($querydata)){
			$first_name1=$data['first_name'];
			$last_name1=$data['last_name'];
			$staff_id1=$data['staff_id'];
			$postal1=$data['postal_address'];
			$phone1=$data['phone'];
			$email1=$data['email'];
			$username1=$data['username'];
			$password1=$data['password'];
		}
	}else{
		echo'<script>alert("Error!!! No user selected ")</script>';
	}
	
	
	?>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>Manage Pharmacist</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Update Pharmacist</a></li>  
              
        </ul>  
          
        <div id="content_1" class="content">  
		<?php echo $message1;?>
			<fieldset><legend>Update pharmacist</legend>
          <form name="myform" onsubmit="return validateForm(this);" action="" method="post" class="insert" >
				
				<p>First_Name:<input name="first_name" type="text" style="width:170px" placeholder="First Name" value="<?php echo$first_name1;?>" id="first_name" /></p>
				<p>Last_Name:<input name="last_name" type="text" style="width:170px" placeholder="Last Name" id="last_name" value="<?php echo $last_name1; ?>" /></p>
				<p>Staff_Id:<input name="staff_id" type="text" style="width:120px" placeholder="Staff ID" id="staff_id" value="<?php echo $staff_id1; ?>" /> </p> 
				<p>Postal_Addrss:<input name="postal_address" type="text" style="width:140px" placeholder="Address" id="postal_address" value="<?php echo $postal1;?>" /> </p>
				<p class="phoneu">Phone:<input name="phone" type="text" style="width:170px" placeholder="Phone" id="phone" value="<?php  echo $phone1; ?>" /></p>  
				<p class="emailu">Email:<input name="email" type="text" style="width:170px" placeholder="Email" id="email"value="<?php  echo $email1;?>" /> </p>  
				<p class="useru">Username:<input name="username" type="text" style="width:120px" placeholder="Username" id="username"value="<?php echo $username1;?>" /></p>
				<p class="passu">Password:<input name="password" placeholder="Password" id="password"value="<?php echo $password1;?>"type="text" style="width:150px"/></p>
				<p class="submu"><input name="submitu" type="submit" value="Update"/></p>
          
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
    if($fname!='' && $lname!='' && $sid!='' && $postal!='' && $phone!=''&& $email!='' && $username!='' && $pas!='' ){
$sql=mysqli_query($conn, "UPDATE pharmacist SET first_name='".$fname."', last_name='".$lname."', staff_id='".$sid."',
postal_address='".$postal."',phone='".$phone."',email='".$email."',username='".$username."', password='".$pas."' WHERE pharmacist_id='".$userid."'") or die(mysqli_error());
if($sql) {      echo '<script type="text/javascript">'; 
echo 'alert("Record updated successifully.");'; 
echo 'window.location.href = "admin.php";';
echo '</script>';
}else{
$message1="<font color=red>Update Failed, Try again</font>";
}}else{
    echo'<script> window.alert(empty fields detected.)</script>';
    }



}

?>
		</form>
				</fieldset>
		</div>  
    </div>  
</div>

</div>
</div>
</body>
</html>
