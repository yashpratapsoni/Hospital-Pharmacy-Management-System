<?php
include_once('connect_db.php');
session_start();
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
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
<!DOCTYPE html>
<html>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    
<title><?php echo $user;?> -Pharmacy Management System</title>
    
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" type="text/css" href="style/home.css">
 <link rel="stylesheet" type="text/css" href="style/form.css">   
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<link rel="stylesheet" href="style/table1.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>

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
            <a href="manager.php" style="text-decoration:none;"><button class="button">Home</button></a>
            <a href="view.php" style="text-decoration:none;"><button class="button">View Users</button></a>
            <a href="view_prescription.php" style="text-decoration:none;"><button class="button">View Prescription</button></a>
            <a href="stock.php" style="text-decoration:none;"><button class="button">Manage Stock</button></a>
        </div>
        <div class="content" style="margin-left:235px;width: 700px;">
			<div div style="width: 100%;display: flex;flex-direction: column;">  
		    <h2 style="padding-bottom: 0px;margin-bottom: 0px;margin-top: 0px">View Users</h2> 
			<hr style="background-color: black;width: 100%;height: 3px;" align="left">	
			</div>
		    <div style="margin-top: 15px;">
		    <a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active" style="text-decoration: none"><button class="btn">VIEW STOCK</button></a>
		    <a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2" style="text-decoration: none"><button class="btn">ADD STOCK</button></a>
        	</div> 
          
        <div id="content_1" style="margin-top: 15px">  
		 <?php echo $message;
			  echo $message1;
			  ?>
      
		<?php
		/* 
		View
        Displays all data from 'Stock' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysqli_query($conn, "SELECT * FROM stock") 
                or die(mysqli_error());
		// display data in table
        echo "<table border='0' cellpadding='4'>";
         echo "<tr><thead><th>Name</th><th>available stock</th><th>Description</th><th>Status</th><th>Delete</th></thead></tr>";
            echo "<tbody>";

        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                      
                echo '<td>' . $row['drug_name'] . '</td>';
				echo '<td>' . $row['quantity'] .$row['category'] .'</td>';
				echo '<td>' . $row['description'] . '</td>';
				echo '<td>'. $row['status'] .'</td>';?>
				<td><a href="delete_stock.php?id=<?php echo $row['stock_id']?>"><img src="images/delete-icon.jpg" width="24" height="24" border="0" /></a></td>
				<?php
		 } 
             echo "</tbody>";
        // close table>
        echo "</table>";
?> 
        </div>  
        <div id="content_2" style="margin-top: 15px">  
         <!--Add Drug-->
		 <?php echo $message;
			  echo $message1;
			  ?>
			<fieldset><legend>Add Stock</legend>
			<form name="myform" onsubmit="return validateForm(this);" action="stock.php" method="post" class="formid" >
			
				<p class="dname"><input name="drug_name" type="text" style="width:170px" placeholder="Drug Name" required="required" id="samm" /></p>
                  <div class="result"></div>
				<p class="comp"><input name="company" type="text" style="width:170px" placeholder="Manufacturing Company"  required="required" id="company"/> </p>
				<p class="supp"><input name="supplier" type="text" style="width:170px" placeholder="Supplier" required="required" id="supplier"/> </p>
                <p class="stren"><input name="stren" type="text" style="width:170px" placeholder="Strength" required="required" id="strength"/> </p>
				<p class="quanti"><input name="quantizz" type="text" style="width:170px" placeholder="Quantity eg 100 tablet or 20 bottles" required="required" id="quantity" /></p>     
                <p class="cost"><input name="cost" type="text" style="width:170px" placeholder="Unit Cost" required="required" id="cost" /></p>
                <p class="u12"><?php
				echo"<select  class=\"input-small\" name=\"cate\" style=\"width:170px\" id=\"drugname\">";
						 $getpayType=mysqli_query($conn, "SELECT category FROM drugtype");
						 echo"<option>Select description</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['category']."</option>";
			}
		
		echo"</select>";?></p>
                <p class="o18"><?php
				echo"<select  class=\"input-small\" name=\"des\" style=\"width:170px\" id=\"druname\" placeholder=\"Category\">";
						 $getpayType=mysqli_query($conn, "SELECT description FROM drugtype");
						 echo"<option>Select category</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['description']."</option>";
			}
		
		echo"</select>";?></p>
               
                
				<p class="sabm"><input name="submiti" type="submit" value="Submit" id="submit"/></p>
            
		</form>
				</fieldset>
        </div>  
        
        
           <div id="content_3" class="content">  
			   <fieldset><legend><u>Update price</u></legend>
				   <form action="" method="post">
            <p class="fetch">
				
               <?php
				echo"<select  class=\"input-small\" name=\"dets\" style=\"width:170px\" id=\"sammy\" placeholder=\"Category\">";
						 $getpayType=mysqli_query($conn, "SELECT * FROM stock");
						 echo"<option>Select drug</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['drug_name']."</option>";
			}
		
		echo"</select>";?></p>
              <script src="js/js.js" type="text/javascript"></script>
<script>
$('#sammy').change(function(){
var package = $(this).val();
$.ajax({
   type:'POST',
   data:{package:package},
   url:'get_cost.php',
   success:function(data){
       $('#costz').val(data);
   } 

});

}); </script>
            <p class="update"><input type="text" name="oldprice" id="costz" placeholder="current price" required readonly></p>
            <p class="update"><input type="text" name="newprice" value="" placeholder="New price" required></p>
			   <p class="upd"><input type="submit" value="Update" name="updat" required></p>
				   </form>
			   </fieldset>
			   <?php
			   include_once('connect_db.php');
			   if(isset($_POST['updat'])){
				   $oldp=$_POST['oldprice'];
				   $newp=$_POST['newprice'];
				   $dn=$_POST['dets'];
				   if($dname=!''){
					   $queryd=mysqli_query($conn,"select * from stock where drug_name='".$dn."'") or die(mysqli_error());
					   $rowa=mysqli_num_rows($queryd);
					   if($rowa>0){
						   while($dat=mysqli_fetch_array($queryd)){
							   $idt=$dat['stock_id'];
						   }
			   $queryupda=mysqli_query($conn,"update stock set cost='".$newp."' where stock_id='".$idt."'") or die(mysqli_error());
						   if($queryupda){
							   echo '<script type="text/javascript">'; 
                                echo 'alert("Price succesifully updated.");'; 
                                   echo 'window.location.href = "stock.php";';
                                 echo '</script>';
						   }else{
							   echo '<script type="text/javascript">'; 
                     echo 'alert("Failed. Please try again");'; 
							   echo '</script>';
						   }
					   }else{
					   echo'<script> window.alert("No data found")</script>';
				   }
				   }else{
					   echo'<script> window.alert("Fill in the blank fields")</script>';
				   }
			   }
			   
			   
			   ?>
    </div>
        
    <div id="content_4" class="content">

	
	  <fieldset><legend><u>Add More Stock</u></legend>
				   <form action="" method="post">
            <p class="fetch">
				
               <?php
				echo"<select  class=\"input-small\" name=\"detsg\" style=\"width:170px\" id=\"samj\" placeholder=\"Category\">";
						 $getpayType=mysqli_query($conn, "SELECT * FROM stock");
						 echo"<option>Select drug</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['drug_name']."</option>";
			}
		
		echo"</select>";?></p>
              <script src="js/js.js" type="text/javascript"></script>
<script>
$('#samj').change(function(){
var package = $(this).val();
$.ajax({
   type:'POST',
   data:{package:package},
   url:'get_stock.php',
   success:function(data){
       $('#stockz').val(data);
   } 

});

}); </script>
            <p class="update"><input type="text" name="orginalstock" id="stockz" placeholder="current price" required readonly></p>
            <p class="update"><input type="text" name="newstock" value="" placeholder="Amount to add" required></p>
			   <p class="upd"><input type="submit" value="Add" name="add" required></p>
				   </form>
			   </fieldset>
			   <?php
			   include_once('connect_db.php');
			   if(isset($_POST['add'])){
				   $olds=$_POST['orginalstock'];
				   $news=$_POST['newstock'];
				   $dndg=$_POST['detsg'];
                   $final=$olds+$news;
				   if($dnameh=!''){
					   $queryd=mysqli_query($conn,"select * from stock where drug_name='".$dndg."'") or die(mysqli_error());
					   $rowa=mysqli_num_rows($queryd);
					   if($rowa>0){
						   while($dat=mysqli_fetch_array($queryd)){
							   $idtd=$dat['stock_id'];
						   }
			   $queryupdua=mysqli_query($conn,"update stock set quantity='".$final."' where stock_id='".$idtd."'") or die(mysqli_error());
						   if($queryupdua){
							   echo '<script type="text/javascript">'; 
                                echo 'alert("Stock succesifully updated.");'; 
                                   echo 'window.location.href = "stock.php";';
                                 echo '</script>';
						   }else{
							   echo '<script type="text/javascript">'; 
                     echo 'alert("Failed. Please try again");'; 
							   echo '</script>';
						   }
					   }else{
					   echo'<script> window.alert("No data found")</script>';
				   }
				   }else{
					   echo'<script> window.alert("Fill in the blank fields")</script>';
				   }
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
	
	</div>    
        
        
        
        
        
         
              
    </div>  
  
</div>
 <div style="background-color: #231F20; font-size: 17px;padding: 6px; margin-top: 174px">
            <p style="float: left; padding-left: 30px;color: #ffffff; margin: 5px">&copy; 2022 Pharmacy. All Rights Reserved</p>
            <p style="float: right; padding-right: 30px;color: #ffffff; margin: 5px;"> Designed By : Yash & Yuvraj</p>
    </div>
</div>
    
    
   
    <script src="js/js.js" type="text/javascript"></script>

    <script type="text/javascript">

    $(document).ready(function(){

        $('.content #samm').on("keyup input", function(){

            /* Get input value on change */

            var inputVal = $(this).val();

            var resultDropdown = $(this).siblings(".result");

            if(inputVal.length){

                $.get("search_med.php", {term: inputVal}).done(function(data){

                    // Display the returned data in browser

                    resultDropdown.html(data);

                });

            } else{

                resultDropdown.empty();

            }

        });

        

        // Set search input value on click of result item

        $(document).on("click", ".result p", function(){

            $(this).parents(".content").find('#samm').val($(this).text());

            $(this).parent(".result").empty();

        });

    });

    </script>
    
 <?php
if(isset($_POST['submiti'])){
	$strades="Select category";
	$stracat="Select description";
$sname=$_POST['drug_name'];
$cat=$_POST['cate'];
$des=$_POST['des'];    
$com=$_POST['company'];
$stren=$_POST['stren'];
$sup=$_POST['supplier'];
$qua=$_POST['quantizz'];
$cost=$_POST['cost'];
	if($des!=$strades && $cat!=$stracat){
	


$sql=mysqli_query($conn, "INSERT INTO stock(drug_name,category,description,company,supplier,strength,quantity,cost,status,date_supplied)
VALUES('$sname','$des','$cat','$com','$sup','$stren','$qua','$cost','$sta',NOW())");
if($sql>0) {echo '<script type="text/javascript">'; 
                                echo 'alert("Drug succesifully added.");'; 
                                   echo 'window.location.href = "stock.php";';
                                 echo '</script>';
}else{
$message1="<font color=red>Failed, Try again</font>";
}
	
	}else{
		echo'<script> window.alert("Ooops! Description and category fields cannot be submitted while empty.")</script>';
	}

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
    
    
    
</body>
</html>
