<?php
session_start();
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

$queryf=mysqli_query($conn, "select * from stock") or die(mysqli_error());
	$rows=mysqli_num_rows($queryf);
	if($rows>0){
		while($data=mysqli_fetch_array($queryf)){
			$amnt=$data['quantity'];
			$ida=$data['stock_id'];
			if($amnt<50){
				$query_update=mysqli_query($conn, "update stock set status='low' where stock_id=$ida") or die(mysqli_error());
			}else{
				$query_updates=mysqli_query($conn, "update stock set status='enough' where stock_id=$ida") or die(mysqli_error());
			}
			
	}
	}
?>
	<?php
		$SN= mysqli_query ($conn, "SELECT 1+MAX(customer_id) FROM temppresci");
		$ind=mysqli_fetch_array($SN);
		if($ind[0]=='')
		{$ind=10000; }
		else{$ind=$ind[0];}
		$idno=$ind;
		
		?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> -Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" type="text/css" href="style/home.css">
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table1.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<script src="js/functionz.js" type="text/javascript"></script>
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

</head>
<body>

	<div style="width: 100%;display: flex;flex-direction: column;">
    <div class="div1">

        <div class="bnr" style="margin-top: 0px">
            <img src="images/logo.png" width="67px" height="" />
        </div>

        <div class="bnr" style="margin-left: 100px">
            HOSPITAL PHARMACY MANAGEMENT SYSTEM
        </div>
	    <?php 
		include('connect_db.php');
		$qury=mysqli_query($conn, "SELECT * from stock where status='low'") or die(mysqli_error());
		$ros=mysqli_num_rows($qury);
		if($ros>0){
			?>
		 <div class="bnr" style="margin-top: 17px;margin-left: 0px">
		 	<img src="images/red.png" class="imgc">: Low stock</div>
		<?php
		}else{
			?>
		<div class="bnr" style="margin-top: 17px">
			<img src="images/green.png" class="imgc">: Enough stock
		</div>
		<?php	
		}
		?>
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
            <a href="pharmacist.php" style="text-decoration:none;"><button class="button">Home</button></a>
            <a href="prescription.php" style="text-decoration:none;"><button class="button">Prescription</button></a>
            <a href="stock_pharmacist.php" style="text-decoration:none;"><button class="button">Stock</button></a>
        </div>
<div class="content" style="margin-left:235px;width: 700px;">
			<div div style="width: 100%;display: flex;flex-direction: column;">  
		    <h2 style="padding-bottom: 0px;margin-bottom: 0px;margin-top: 0px">Prescription</h2> 
			<hr style="background-color: black;width: 100%;height: 3px;" align="left">	
			</div>
		    <div style="margin-top: 15px;">   
		        <a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active" style="text-decoration: none"><button class="btn">VIEW</button></a>
		        <a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2" style="text-decoration: none"><button class="btn">CREATE NEW</button></a>
		    </div>
		    <div id="content_1" style="margin-top: 15px;">  
				<form action="" method="get">
		<?php echo $message1;
		/* 
		View
        Displays all data from 'Pharmacist' table
		*/
        // connect to the database
        include_once('connect_db.php');
       // get results from database
       $result = mysqli_query($conn, "SELECT DISTINCT * FROM prescription")or die(mysqli_error());
		// display data in table
        echo "<table border='0' cellpadding='3'align='center'>";
			
        echo "<tr> <thead><th>Customer</th> <th>Invoice N<sup>o</sup></th><th>Date </th><th>+Prescription</th><th>Delete</th></thead></tr>";
        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['customer_name'] . '</td>';
               
				echo '<td>' . $row['invoice_id'] . '</td>';
				
				echo '<td>' . $row['date'] . '</td>';
				?>
				<td><a href="morepre.php?id=<?php echo $row['customer_id']?>">
				<img src="images/icon.png" width="35" height="35" border="0" /></a></td>
				<td><a href="delete_prescription.php?id=<?php echo $row['invoice_id']?>">
				<img src="images/delete-icon.jpg" width="35" height="35" border="0" /></a></td>
			
				<?php
		 } 
        // close table>
        echo "</table>";
?> </form>
</div>
		    <div id="content_2" style="margin-top: 15px;">  
				<script>
			$(document).ready(function()
	{
		$("#drug_name,#strength,#dose,#quantity").change(function() 
		{	
			var drug_name=$("#drug_name").val();
			var strength=$("#strength").val();
			var dose=$("#dose").val();
			var quantity=$("#quantity").val();
			
			if(drug_name.length && strength.length && dose.length && quantity.length>0 )
				{
					$.ajax(
				{  
					type: "POST", url: "check.php", data: 'drug_name='+drug_name +'&strength='+strength+'&dose='+dose +'&quantity='+quantity, success: function(msg1)
					{  
						$("#viewer2").ajaxComplete(function(event, request, settings)
							{ 
									if(msg != '')
									{ 
										$(this).html(msg);
										$('#strength, #dose, #quantity').val('');
										document.getElementById('drug_name').selectedIndex = 0;
									}  
							});
					}    
				}); 
				}
		});
		
		$("#customer_id,#customer_name,#phone").change(function() 
		{	
			var customer_id=$("#customer_id").val();
			var customer_name=$("#customer_name").val();
		
			var phone=$("#phone").val();
			
			if(customer_id.length && customer_name.length && phone.length >0)
				{
					$.ajax(
				{  
					type: "POST", url: "check.php", data: 'customer_id='+customer_id +'&customer_name='+customer_name +'&phone='+phone, success: function(msg1)
					{  
						$("#viewer2").ajaxComplete(function(event, request, settings)
							{ 	
									if(msg != '')
									{ 
									}  
								   
							});
					}    
				}); 
				}
	});		
});		
		
		</script>
		<div id="viewer"><span id="viewer2"></span></div>
		<?php
		$invNum= mysqli_query ($conn, "SELECT 1+MAX(invoice_id) FROM invoice");
		$invoice=mysqli_fetch_array($invNum);
		if($invoice[0]=='')
		{$invoiceNo=10; }
		else{$invoiceNo=$invoice[0];}
		$_SESSION['invoice']=$invoiceNo;
		
		?>
			
		      
				   <?php echo $message;
			  echo $message1;
			  ?>
			<fieldset><legend>Customer prescription</legend>
		<form name="myform" onsubmit="return validateForm(this);" action="invoice.php" method="post" class="forme" >
			
				<p><input name="customer_id" placeholder="Customer ID" id="customer_id"type="text" style="width:170px" required="required" /></p>
				<p><input name="customer_name" placeholder="Customer Name" id="customer_name"type="text" style="width:170px" required="required" /></p>
				<p><input name="phone" type="text"placeholder="Phone" id="phone" style="width:170px" required="required" /> </p> 
				<p class="sel"><?php
				echo"<select  class=\"input-small\" name=\"drug_name\" style=\"width:170px\" id=\"drug_name\">";
						 $getpayType=mysqli_query($conn, "SELECT drug_name FROM stock");
						 echo"<option>Select Drug</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['drug_name']."</option>";
			}
		
		echo"</select>";?></p>  
 <p class="str"><input name="strength" type="text" style="width:170px"  id="strength"placeholder="Strength eg 100 mg" /></p>
				<p class="dos"><input name="dose" type="text" style="width:170px" id="dose" placeholder="Dose eg 1x3" /></p>
				<p class="quan"><input name="quantity" type="text" style="width:170px" id="quantity"placeholder="Quantity"/></p>
				
				<p class="input"><input name="submit" type="submit" value="Submit"/></p>
           
		</form>
				</fieldset>
		<script>
			document.getElementById('drug_name').selectedIndex = 0;
		</script>
		
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
    <div style="background-color: #231F20; font-size: 17px;padding: 6px; margin-top: 194px">
            <p style="float: left; padding-left: 30px;color: #ffffff; margin: 5px">&copy; 2022 Pharmacy. All Rights Reserved</p>
            <p style="float: right; padding-right: 30px;color: #ffffff; margin: 5px;"> Designed By : Yash & Yuvraj</p>
    </div>
</div>
</body>
</html>