<?php

session_start();

if(isset($_GET['id'])){
$userid=$_GET['id'];}
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['pharmacist_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
$quryfetch=mysqli_query($conn, "SELECT* FROM prescription WHERE customer_id='".$userid."'")or die(mysqli_error());
$rw=mysqli_num_rows($quryfetch);
if($rw>0){
    while($dta=mysqli_fetch_array($quryfetch)){
        $name=$dta['customer_name'];
        $invno=$dta['invoice_id'];
        $phone=$dta['phone'];
         $prescr=$dta['prescription_id'];
        
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> -Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table1.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<script src="js/function3.js" type="text/javascript"></script>
<script type="text/javascript" SRC="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" SRC="js/superfish/hoverIntent.js"></script>
	<script type="text/javascript" SRC="js/superfish/superfish.js"></script>
	<script type="text/javascript" SRC="js/superfish/supersubs.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ 
			$("ul.sf-menu").supersubs({ 
				minWidth:    12, 
				maxWidth:    27, 
				extraWidth:  1    
								  
			}).superfish();
							
		}); 
	</script>
	<script>
function validateForm() {
    var value = document.myform.customer_name.value;
	if(value.match(/^[a-zA-Z]+(\s{1}[a-zA-Z]+)*$/)) {
        return true;
    } else {
        alert('Name Cannot contain numbers');
        return false;
    }
}
</script>
	<script SRC="js/cufon-yui.js" type="text/javascript"></script>
	<script SRC="js/Liberation_Sans_font.js" type="text/javascript"></script>
	<script SRC="js/jquery.pngFix.pack.js"></script>
	<script type="text/javascript">
		Cufon.replace('h1,h2,h3,h4,h5,h6');
		Cufon.replace('.logo', { color: '-linear-gradient(0.5=#FFF, 0.7=#DDD)' }); 
	</script>
   <style>#left-column {height: 477px;}
 #main {height: 477px;}
</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg" class="img"></a> Pharmacy Management System</h1>
        <?php 
	include('connect_db.php');
	$qury=mysqli_query($conn, "SELECT * from stock where status='low'") or die(mysqli_error());
	$ros=mysqli_num_rows($qury);
	if($ros>0){
		?>
	 <p class="dd"><img src="images/red.png" class="imgc">: Low stock</p>
	<?php
	}else{
		?>
	<p class="ddc"><img src="images/green.png" class="imgc">: Enough stock</p>
	<?php
		
	}
	?>
	   <p class="user">User:<?php echo $fname." ".$lname; ?></p> </div>
<div id="left_column">
<div id="button">
		<ul>
			<li><a href="pharmacist.php">Home</a></li>
			<li><a href="prescription.php">Prescription</a></li>
			<li><a href="stock_pharmacist.php">Stock</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>Prescription</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Prescribe more drugs</a></li>  
           
        </ul>  
          
        <div id="content_1" class="content">  
		<fieldset><legend>More prescription</legend>
		<form name="myform" onsubmit="return validateForm(this);" action="" method="post" class="forme" >
       
				<p><input name="customer_id" placeholder="Customer ID" id="customer_id"type="text" style="width:170px" required="required" value="<?php echo $userid; ?>" /></p>
				<p><input name="customer_name" placeholder="Customer Name" id="customer_name"type="text" style="width:170px" required="required" value="<?php echo $name; ?>" /></p>
				<p><input name="phone" type="text"placeholder="Phone" id="phone" style="width:170px" required="required" value="<?php echo $phone; ?>" /> </p> 
				<p class="sel"><?php
				echo"<select  class=\"input-small\" name=\"drug_name\" style=\"width:170px\" id=\"drug_name\"  placeholder=\"Select drug\" >";
						 $getpayType=mysqli_query($conn, "SELECT drug_name FROM stock");
						// echo"<option>Select Drug</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['drug_name']."</option>";
			}
		
		echo"</select>";?></p>  
 <p class="str"><input name="stred" type="text" style="width:170px"  id="strength"placeholder="Strength eg 100 mg"  /></p>
				<p class="dos"><input name="dose" type="text" style="width:170px" id="dose" placeholder="Dose eg 1x3" required /></p>
				<p class="quan"><input name="quantity" type="text" style="width:170px" id="quantity"placeholder="Quantity" required/></p>
            <input type="hidden" value="<?php echo $invno ?>" name="inv">
            
				
				<p class="input"><input name="submity" type="submit" value="Submit"/></p>
           
		</form>
				</fieldset>
        </div>  
        
    </div>  
</div>
</div>

	
</div>
    <script>
    $('#drug_name').change(function(){
var package = $(this).val();
$.ajax({
   type:'POST',
   data:{package:package},
   url:'get_strength.php',
   success:function(data){
       $('#strength').val(data);
   } 

});

}); </script>
    <?php
    include_once('connect_db.php');
    if(isset($_POST['submity'])){
     $dname=$_POST['drug_name'];
     $star=$_POST['stred'];
    $qua=$_POST['quantity'];
        $doz=$_POST['dose'];
        $incv=$_POST['inv'];
     $month=date('F');
	  $yr=date('Y');
     $day=date('j');
        
        
        
        
        
        
        
        
$querysql=mysqli_query($conn, "INSERT INTO tempprescri(customer_id,customer_name,phone,drug_name,strength,dose,quantity)
						VALUES('{$userid}','{$name}','{$phone}','{$dname}','{$star}','{$doz}','{$qua}')") or die(mysqli_error());
				
	$get_cost=mysqli_query($conn, "SELECT cost FROM stock WHERE drug_name='{$dname}'");
	$cost=mysqli_fetch_array($get_cost);
	$tota=$qua*$cost[0];
	
	$file=fopen("receipts/docs/".$userid.".txt", "a+");
	fwrite($file, $dname.";".$star.";".$doz.";".$qua.";".$cost[0].";".$tota."\n");
	fclose($file);
        
   // $sqlP=mysqli_query($conn, "INSERT INTO prescription(prescription_id,customer_id,customer_name,invoice_id,phone)
				//VALUES('{$prescr}','{$userid}','{$name}','{$incv}','{$phone}')  ") or die(mysqli_error($conn));
		$sqlI=mysqli_query($conn, "INSERT INTO invoice(invoice_id, customer_name,served_by,status)
				VALUES('{$incv}','{$name}','{$user}','Pending') ");
        $slI=mysqli_query($conn, "INSERT INTO ids(ids,invoice_id)
				VALUES('{$userid}','{$incv}') ") or die(mysqli_error());
        $getDetails=mysqli_query($conn, "SELECT * FROM tempprescri WHERE customer_id='{$userid}'");
while($item1=mysqli_fetch_array($getDetails))
			{	
				$getDetails1=mysqli_query($conn, "SELECT stock_id, cost FROM stock WHERE drug_name='{$item1['drug_name']}'");	
			
				$details=mysqli_fetch_array($getDetails1);
				$sqlId=mysqli_query($conn, "INSERT INTO invoice_details(invoice,drug,cost,quantity,day,month,year)
				VALUES('{$incv}','{$details['stock_id']}','{$details['cost']}','{$item1['quantity']}','$day','$month','$yr')");
				$count[]=$details['cost']*$item1['quantity'];
    
    $getDetailZ=mysqli_query($conn,"SELECT * FROM tempprescri WHERE customer_id='{$userid}'");
while($item12=mysqli_fetch_array($getDetailZ))
			{	
			$getDetails12=mysqli_query($conn, "SELECT * FROM stock WHERE drug_name='{$item12['drug_name']}'");	
			
				$details2=mysqli_fetch_array($getDetails12);
			$sqlIp=mysqli_query($conn, "INSERT INTO prescription_details(pres_id,drug_name,strength,dose,quantity)
				VALUES('{$prescr}','{$details2['stock_id']}','{$item12['strength']}','{$item12['dose']}','{$item12['quantity']}') ");	
  
	}
					
			}
          
	$newquant=$details2['quantity']-$qua;
	if($newquant!=0){
		$update=mysqli_query($conn,"Update stock set quantity='{$newquant}' where stock_id='".$details2['stock_id']."'") or die(mysqli_error());
						    
        
    }
       	$sqy=mysqli_query($conn, "INSERT INTO sales(invoice,drug,cost,quantity,day,month,year)
				VALUES('{$incv}','{$details['stock_id']}','{$details['cost']}','$qua','$day','$month','$yr')"); 
    }
    
    if($sqlIp){
        echo '<script type="text/javascript">'; 
                                echo 'alert(" Drug successifully added");'; 
                             echo 'window.location.href = "prescription.php";';
                                 echo '</script>';
           
    }
               unset($_POST);
    ?>
</body>
</html>
