<?php
session_start();
include_once('connect_db.php');
if(isset($_GET['id'])){
$id=$_GET['id'];

}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
$sql=mysqli_query($conn, "delete from prescription where invoice_id='$id'");
if($id){
    header("location:prescription.php");
}else{
    echo'<script>window.alert("Failed!!! Please try again")</script>';
}
?>


