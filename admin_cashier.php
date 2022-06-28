<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$username=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_POST['submit'])){
$fname=$_POST['first_name'];
if (!preg_match("/^[a-zA-Z ]*$/",$fname))
  {
  $nameErr = "Only letters and white space allowed";
  }
$lname=$_POST['last_name'];
$sid=$_POST['staff_id'];
$postal=$_POST['postal_address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$user=$_POST['username'];
$pas=$_POST['password'];
$sql1=mysqli_query($conn, "SELECT * FROM cashier WHERE username='$user'")or die(mysql_error());
 $result=mysqli_fetch_array($sql1);
 if($result>0){
$message="<font color=blue>sorry the username entered already exists</font>";
 }else{
$sql=mysqli_query($conn, "INSERT INTO cashier(first_name,last_name,staff_id,postal_address,phone,email,username,password,date)
VALUES('$fname','$lname','$sid','$postal','$phone','$email','$user','$pas',NOW())");
if($sql>0) {echo '<script type="text/javascript">'; 
echo 'alert("Cahier successifully added.");'; 
echo 'window.location.href = "admin.php";';
echo '</script>';
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $username;?> - Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="style/home.css">
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
	<link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table1.css" type="text/css" media="screen" /> 
<script src="js/prescr.js" type="text/javascript"></script>
<script src="js/validation_script.js" type="text/javascript"></script>
<script>
function validateForm()
{

//for alphabet characters only
var str=document.form1.first_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("First Name Cannot Contain Numerical Values");
	document.form1.first_name.value="";
	document.form1.first_name.focus();
	return false;
	}}
	
if(document.form1.first_name.value=="")
{
alert("Name Field is Empty");
return false;
}

//for alphabet characters only
var str=document.form1.last_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("Last Name Cannot Contain Numerical Values");
	document.form1.last_name.value="";
	document.form1.last_name.focus();
	return false;
	}}
	

if(document.form1.last_name.value=="")
{
alert("Name Field is Empty");
return false;
}

}

</script>
 
</head>
<body>
<div style="width: 100%;display: flex;flex-direction: column;">
<div class="div1">
        <!-- logo -->
        <div class="bnr" style="margin-top: 0px">
            <img src="images/logo.png" width="67px" height="" />
        </div>
        <!-- heading -->
        <div class="bnr">
            HOSPITAL PHARMACY MANAGEMENT SYSTEM
        </div>
        <!-- logout buuton -->
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
            <a href="admin.php" style="text-decoration:none;"><button class="button">Home</button></a>
            <a href="admin_pharmacist.php" style="text-decoration:none;"><button class="button">Pharmacist</button></a>
            <a href="admin_manager.php" style="text-decoration:none;"><button class="button">Manager</button></a>
            <a href="admin_cashier.php" style="text-decoration:none;"><button class="button">Cashier</button></a>
        </div>
        <!-- content starts -->
		<div class="content" style="margin-left:235px;width: 700px;">
			<div div style="width: 100%;display: flex;flex-direction: column;">  
		    <h2 style="padding-bottom: 0px;margin-bottom: 0px;margin-top: 0px">Manage Cashier</h2> 
			<hr style="background-color: black;width: 100%;height: 3px;" align="left">	
			</div>
		    <div style="margin-top: 15px;">   
		        <a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active" style="text-decoration: none"><button class="btn">VIEW CASHIER</button></a>
		        <a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2" style="text-decoration: none"><button class="btn">ADD CASHIER</button></a>
		    </div>
		    <div id="content_1" style="margin-top: 15px;">  
			<?php echo $message;
				  echo $message1;
			  
		/* 
		View
        Displays all data from 'Cashier' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysqli_query($conn, "SELECT * FROM cashier") 
                or die(mysqli_error());
				
					    
        // display data in table
        
        ?>
		        <table style="border-spacing: 55px"><tr> 
		        <th>ID</th>
		        <th>Firstname </th> 
		        <th>Lastname </th> 
		        <th>Username </th>
		        <th>Update </th>
		        <th>Delete</th>
		        </tr>
		        <?php
        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array($result )) {
                
                // echo out the contents of each row into a table
                ?>
		            <tr>
		            <td> <?php echo $row['cashier_id']?></td>
		            <td> <?php echo  $row['first_name']?></td>
					<td> <?php echo  $row['last_name']?></td>
					<td> <?php echo  $row['username']?></td>
					<td><a href="update_cashier.php?id=<?php echo $row['cashier_id']?>"><img src="images/update-icon.png" width="35" height="35" border="0" /></a></td>
					<td><a href="delete_cashier.php?cashier_id=<?php echo $row['cashier_id']?>"><img src="images/delete-icon.jpg" width="35" height="35" border="0" /></a></td>
					</tr>
				<?php
		 } 
		 ?>
        </table>
        </div>  
        <div id="content_2" style="margin-top: 15px;">  
		           <!--Cashier-->
		<?php echo $message;
			  echo $message1;
			  ?>
			<fieldset><legend>Add cashier</legend>
		<form name="form1"  onsubmit="return validateForm(this);" action="admin_cashier.php" method="post" class="insert">
				
				<table style="border-spacing: 20px">
						<tr>
						<td>First Name :
						</td>
						<td><input name="first_name" type="text" style="width:170px" placeholder="Enter First Name" required="required" id="first_name" /></td>
					    </tr>
					    <tr>
						<td>Last Name :</td><td><input name="last_name" type="text" style="width:170px" placeholder="Enter Last Name" required="required" id="last_name" /></td>
					    </tr>
					    <tr>
						<td>Staff Id :</td><td><input name="staff_id" type="text" style="width:170px" placeholder="Enter Staff ID" required="required" id="staff_id"/> </td></tr>
						<tr> 
						<td>Address :</td><td><input name="postal_address" type="text" style="width:170px" placeholder="Enter Address" required="required" id="postal_address"/></td></tr>
						<tr>
						<td>Phone Number :</td><td><input name="phone" type="text" style="width:170px"placeholder="Enter Phone Number"  required="required" id="phone"/></td></tr>
						<tr> 
						<td>Email Id :</td><td><input name="email" type="text" style="width:170px" placeholder="Enter Email Id" required="required" id="email"/></td></tr>
						<tr>
						<td>Username :</td><td><input name="username" type="text" style="width:170px" placeholder="Enter Username" required="required" id="username"/></td></tr>
						<tr>
						<td>Password :</td><td><input name="password" type="text" style="width:170px" placeholder="Enter Password" required="required" id="password"/></td></tr>
						<tr>
						<td><input name="submit" type="submit" value="Submit"/></td></tr>
					</table>
				
           
		</form>
				</fieldset>
        </div>   
        
      
    </div>  
  
</div>
 
</div>
</div>
<div style="background-color: #231F20; font-size: 16px;padding: 6px; position: absolute; bottom: 0px;left: 0px;right:0px;">
            <p style="float: left; padding-left: 30px;color: #ffffff; margin: 5px">&copy; 2022 Pharmacy. All Rights Reserved</p>
            <p style="float: right; padding-right: 30px;color: #ffffff; margin: 5px;"> Designed By : Yash & Yuvraj</p>
 </div>
</div>
</body>
</html>
