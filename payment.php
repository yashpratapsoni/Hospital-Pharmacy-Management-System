<?php
session_start();
include_once('connect_db.php');

if(isset($_SESSION['username'])){
$id=$_SESSION['cashier_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}

?>
	<?php
		$SN= mysqli_query ($conn, "SELECT 1+MAX(serialno) FROM receipts");
		$invoice=mysqli_fetch_array($SN);
		if($invoice[0]=='')
		{$invoiceNo=1000; }
		else{$invoiceNo=$invoice[0];}
		$serno=$invoiceNo;
		
		?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> -  Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" type="text/css" href="style/home.css">
 <link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<script src="js/function.js" type="text/javascript"></script>
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
	<script SRC="js/cufon-yui.js" type="text/javascript"></script>
	<script SRC="js/Liberation_Sans_font.js" type="text/javascript"></script>
    	<script SRC="js/.js" type="text/javascript"></script>
	<script SRC="js/jquery.pngFix.pack.js"></script>
	<script type="text/javascript">
        
		Cufon.replace('h1,h2,h3,h4,h5,h6');
		Cufon.replace('.logo', { color: '-linear-gradient(0.5=#FFF, 0.7=#DDD)' }); 
	</script>
</style>
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
            <a href="cashier.php" style="text-decoration:none;"><button class="button">Home</button></a>
            <a href="payment.php" style="text-decoration:none;" target="_top"><button class="button">Process Payment</button></a>
        </div>
    <div class="content" style="margin-left:235px;width: 700px;">
			<div div style="width: 100%;display: flex;flex-direction: column;">  
		    <h2 style="padding-bottom: 0px;margin-bottom: 0px;margin-top: 0px">View Prescription</h2> 
			<hr style="background-color: black;width: 100%;height: 3px;" align="left">	
			</div>  
        <div style="margin-top: 15px"> 
		<div id="viewer1"><span id="viewer2"></span></div>
		  <form name="myform" onsubmit="return validateForm(this);" action="receipt.php" method="post" >
			<table width="220" height="106" border="0" >	
				<tr><td ><input name="invoice_no" type="text" style="width:170px" placeholder="Invoice No" required="required" id="invoice_no" /></td></tr>
				<tr><td></td></tr>
		        <tr><td></td></tr>
				<tr><td ><?php
				echo"<select  class='input-small', name='payType', style='width:170px;', id='payment_type'>";
						 $getpayType=mysqli_query($conn, "SELECT * FROM paymentTypes");
						 echo"<option>Select Payment</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['Name']."</option>";
			}
		
		echo"</select>";?>  </td></tr>
				<tr><td></td></tr>
				
				<tr><td ><input name="serial_no" type="text" style="width:170px" placeholder="Serial No"  id="serial_no" value="<?php echo $serno ?>" /></td></tr>  
				<tr><td></td></tr>
				<tr><td><input name="tuma" id="tuma" type="submit" value="Submit"/></td></tr>
            </table>
              
              		<?php
		$_SESSION['invoice_no']=$invoice_no;
		$_SESSION['amount']=$amount;
		$_SESSION['payType']=$payType;
		$_SESSION['serial_no']=$serial_no;
		
		?>       
 <script>
			$(document).ready(function()
	{
	$("#invoice_no").change(function() 
		{	
			var invoice_no=$("#invoice_no").val();
			
			
			
			if(invoice_no.length >0)		
			
				{
					$.ajax(
				{
type: "POST", url: "check.php", data: 'invoice_no='+invoice_no , success: function(msg)
									
					{  
						$("#viewer2").ajaxComplete(function(event, request, settings)
							{ 
								
										
									if(msg)
									{ 
                                          

										$(this).html(msg);
                                       
									
										 				
										
									} 
									else
									{
										$(this).html('<font color="red"><strong>Invoice does not exist</strong></font>');
									}
								
									 
								   
							});
					}    
				}); 
				}else{
                    window.alert("Please provide an invoice number");
                }
	});		
	});		
		
		</script>
              
		</form>         
        </div>  
    </div>  
</div>
<div style="background-color: #231F20; font-size: 17px;padding: 6px; margin-top: 406px">
            <p style="float: left; padding-left: 30px;color: #ffffff; margin: 5px">&copy; 2022 Pharmacy. All Rights Reserved</p>
            <p style="float: right; padding-right: 30px;color: #ffffff; margin: 5px;"> Designed By : Yash & Yuvraj</p>
</div>
</div>
</body>
    
</html>
