<?php
session_start();
include_once('connect_db.php');
if(isset($_GET['id'])){
$userid=$_GET['id'];

}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
$id=$_GET[manager_id];
$sql=mysqli_query($conn, "delete from manager where manager_id='$userid'");
if($sql){
header("location:admin_manager.php");
}else{
    echo'<script>wimdow.alert("Failed!!! Please try again")</script>';
}
?>


