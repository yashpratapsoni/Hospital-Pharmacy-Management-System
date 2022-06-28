<?php
if(isset($_POST['submiti'])){
	$strades="Select category";
	$stracat="Select description";
$sname=$_POST['drug_name'];
$cat=$_POST['cate'];
$des=$_POST['des'];    
$com=$_POST['company'];
$sup=$_POST['supplier'];
$qua=$_POST['quantizz'];
$cost=$_POST['cost'];
	if($des!=$strades && $cat!=$stracat){
	
	
$selectqury=mysqli_query($conn, "SELECT * FROM stock where drug_name='".$sname."'") or die(mysqli_error());
    $roe=mysqli_num_rows($selectqury);
    if($roe>0){
        while($datt=mysqli_fetch_array($selectqury)){
            $quanti=$datt['quantity'];
            $newquan=$quanti+$qua;
        }
        $quey=mysqli_query($conn, "UPDATE stock set quantity='".$newquan."' WHERE drug_name='".$sname."'" ) or die(mysqli_error());
		if($quey){
		$qua=0;
		}
    }else{

$sql=mysqli_query($conn, "INSERT INTO stock(drug_name,category,description,company,supplier,quantity,cost,status,date_supplied)
VALUES('$sname','$cat','$des','$com','$sup','$qua','$cost','$sta',NOW())");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/stock.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}
	}else{
		echo'<script> window.alert("Ooops! Description and category fields cannot be submitted while empty.")</script>';
	}
}

?>