<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
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
<link rel="stylesheet" type="text/css" href="style/home.css">
<script src="js/prescr.js" type="text/javascript"></script>
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

        <div class="content">
            <table class="tb">
                <tr>
                    <td>
                        <img src="images/admin_icon.jpg" height="200" alt="edit" />
                    </td>
                    <td>
                        <img src="images/pharmacist_icon.jpg" height="200" alt="edit" />
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="admin.php" class="link"><span>Dashboard</span></a>
                    </td>
                    <td align="center">
                        <a href="admin_pharmacist.php" class="link"><span>Pharmacist</span></a>
                    </td>
                </tr>

                <tr>
                    <td>
                        <img src="images/manager_icon.png" height="200" alt="edit" opacity/>
                    </td>
                    <td>
                        <img src="images/cashier_icon.jpg" height="200" alt="edit" />
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="admin_manager.php" class="link"> <span>Manager</span></a>
                    </td>
                    <td align="center">
                        <a href="admin_cashier.php" class="link"><span>Cashier</span></a>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <div style="background-color: #231F20; font-size: 17px;padding: 6px; margin-top: 60px">
            <p style="float: left; padding-left: 30px;color: #ffffff; margin: 5px">&copy; 2022 Pharmacy. All Rights Reserved</p>
            <p style="float: right; padding-right: 30px;color: #ffffff; margin: 5px;"> Designed By : Yash & Yuvraj</p>
    </div>
</div>
</body>
</html>
