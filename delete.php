<?php
include('connect_db.php');
$query1=mysqli_query($conn, "delete from ids") or die(mysqli_error());
$query2=mysqli_query($conn, "delete from invoice") or die(mysqli_error());
$query3=mysqli_query($conn, "delete from invoice_details") or die(mysqli_error());
$query4=mysqli_query($conn, "delete from prescription") or die(mysqli_error());
$query5=mysqli_query($conn, "delete from prescription_details") or die(mysqli_error());
$query6=mysqli_query($conn, "delete from tempo") or die(mysqli_error());
$query7=mysqli_query($conn, "delete from tempprescri") or die(mysqli_error());
$query8=mysqli_query($conn, "delete from sales") or die(mysqli_error());
$query9=mysqli_query($conn, "delete from receipts") or die(mysqli_error());
if($query1 && $query2 && $query3 && $query4 && $query5 && $query6 && query7 && $query8 && $query9){
     echo '<script type="text/javascript">'; 
echo 'alert("Record deleted successifully.");'; 
echo 'window.location.href = "admin.php";';
echo '</script>';
}else{
     echo '<script type="text/javascript">'; 
echo 'alert("Record updated successifully.");'; 

echo '</script>';
}





?>