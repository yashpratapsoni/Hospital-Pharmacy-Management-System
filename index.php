<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
  setTimeout(function(){
    document.getElementById('alert-messo').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
    */
  }, 2000);
</script>
<?php
include_once 'connect_db.php';
if(isset($_POST['submit'])){
$username=$_POST['username'];
$password=$_POST['password'];
$position=$_POST['position'];
  if($position!=''){
  
switch($position){
case 'Admin':
$result=mysqli_query($conn,"SELECT admin_id, username FROM admin WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['admin_id']=$row[0];
$_SESSION['username']=$row[1];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
}
break;
case 'Pharmacist':
$resultp=mysqli_query($conn, "SELECT * FROM pharmacist WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($resultp);
if($row>0){
session_start();
$_SESSION['pharmacist_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/pharmacist.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
  
}
break;
case 'Cashier':
$result=mysqli_query($conn, "SELECT cashier_id, first_name,last_name,staff_id,username FROM cashier WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['cashier_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cashier.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
}
break;
case 'Manager':
$result=mysqli_query($conn, "SELECT manager_id, first_name,last_name,staff_id,username FROM manager WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['manager_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/manager.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
}
break;
}
}else{
echo'<script>window.alert("Please select your login category")</script>';
}
}
echo <<<LOGIN
<!DOCTYPE html>
<html>
<head>
<title>Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="style/login.css">
<link rel="stylesheet" type="text/css" href="style/home.css">
</head>
<body>
<div style="width: 100%;display: flex;flex-direction: column;">
    <div class="div1">

        <div class="bnr" style="margin-top: 0px">
            <img src="images/logo.png" width="67px" height="" />
        </div>

        <div class="bnr">
            HOSPITAL PHARMACY MANAGEMENT SYSTEM
        </div>
        <div style="width: 130px"></div>
    </div>


  <div style="margin-left: 360px;margin-top: 120px;margin-bottom: 0px">
    
     <div class="login">
   
     <div class="form">
      <br>
      <h1 class="head">Login here</h1>
    $message
      <form method="post" action="index.php">
        <table style="border-spacing: 15px;">
          <tr>
            <td>
            <select style="margin-top: 10px" name="position">
                  <option>Pharmacist</option>
              <option>Admin</option>
              <option>Cashier</option>
              <option>Manager</option>
              </select>
            </td>
          </tr>
          <tr>
          <td><input type="text" name="username" value="" placeholder="Username" required></td>
          </tr>
          <tr>
          <td><input type="password" name="password" value="" placeholder="Password" required></td>
          </tr>
          
          <tr align="center">
            <td>&emsp;&emsp;&nbsp;
          <button class="loginbtn" type="submit" name="submit" value="Login">Login</button>
          </td></tr>
        </table>
      </form>
      </div>
      </div>
      <div style="position:relative;
       top:-500px;margin-left: 10px">
      <img src="images/avatar.png" style="border-radius: 100px;width: 150px;height: 150px;margin-left: 320px">
    </div>
   
    </section>
</div>
<div style="background-color: #231F20; font-size: 17px;padding: 6px; margin-top:-10px">
            <p style="float: left; padding-left: 30px;color: #ffffff; margin: 5px">&copy; 2022 Pharmacy. All Rights Reserved</p>
            <p style="float: right; padding-right: 30px;color: #ffffff; margin: 5px;"> Designed By : Yash & Yuvraj</p>
    </div>
</div>
</body>
</html>
LOGIN;
?>
</html>