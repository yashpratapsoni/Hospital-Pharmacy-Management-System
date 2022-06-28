<?php
$conn=mysqli_connect("localhost","root","","pharmacy");
if (isset($_POST['package'])) {
    $qry=mysqli_query($conn,"select * from stock where drug_name='".$_POST['package']."'"); 
    if (mysqli_num_rows($qry)>0) {
        while ($res = mysqli_fetch_array($qry)) {
            echo $res['quantity'];
        }
    }
}
die();
?>