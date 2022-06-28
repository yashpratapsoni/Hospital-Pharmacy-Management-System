<?php
include('connect_db.php');
session_start();
if(isset($_POST['customer_id']))
{
$c_id=$_POST['customer_id'];
	$cname=$_POST['customer_name'];
	
	$phone=$_POST['phone'];
	
	$_SESSION['custId']=$c_id;
	$_SESSION['custName']=$cname;

	$_SESSION['phone']=$phone;
						
}

if(isset($_POST['quantity']))
{
	$drug=$_POST['drug_name'];
	$strength=$_POST['strength'];
	$dose=$_POST['dose'];
	$quantity=$_POST['quantity'];
	$sql=mysqli_query($conn, "INSERT INTO tempprescri(customer_id,customer_name,phone,drug_name,strength,dose,quantity)
						VALUES('{$_SESSION['custId']}','{$_SESSION['custName']}','{$_SESSION['phone']}','{$drug}','{$strength}','{$dose}','{$quantity}')");
						
						$_SESSION['quantity']=$quantity;
	$get_cost=mysqli_query($conn, "SELECT cost FROM stock WHERE drug_name='{$drug}'");
	$cost=mysqli_fetch_array($get_cost);
	$tot=$quantity*$cost[0];
	
	$file=fopen("receipts/docs/".$_SESSION['custId'].".txt", "a+");
	fwrite($file, $drug.";".$strength.";".$dose.";".$quantity.";".$cost[0].";".$tot."\n");
	fclose($file);
	echo "<table width=\"100%\" border=1>";
        echo "<tr> 
		<th>Drug</th> 
		<th>Strength </th>
		<th>Dose</th>
		<th>Quantity </th></tr>";
        // loop through results of database query, displaying them in the table
		 $result = mysqli_query($conn, "SELECT * FROM tempPrescri")or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) 
		{
                // echo out the contents of each row into a table
                echo "<tr>";
                
				echo '<td>' . $row['drug_name'] . '</td>';
				echo '<td>' . $row['strength'] . '</td>';
				echo '<td>' . $row['dose'] . '</td>';
				echo '<td>' . $row['quantity'] . '</td>';
				}


	
}

if(isset($_POST['invoice_no']))
{
    
$invoice=$_POST['invoice_no'];

	$receipt=$_POST['receipt_no'];
	$amount=$_POST['amount'];
	$payment=$_POST['payment_type'];
	$serial=$_POST['serial_no'];
	
	$_SESSION['receiptNo']=$receipt;
	$_SESSION['amount']=$amount;
	$_SESSION['paymentType']=$payment;
	$_SESSION['serialNo']=$serial;
$getDetails=mysqli_query($conn, "SELECT DISTINCT invoice,drug,cost,quantity FROM invoice_details WHERE invoice='{$invoice}'");
$getQuantity=mysqli_query($conn, "SELECT DISTINCT quantity FROM invoice_details WHERE invoice_id='{$invoice}'");
$getid=mysqli_query($conn, "SELECT * FROM ids WHERE invoice_id='{$invoice}'") or die(mysqli_error($conn));
 $getname=mysqli_query($conn, "SELECT * FROM invoice WHERE invoice_id='{$invoice}'") or die(mysqli_error());
$file=fopen("receipts/docs/".$_SESSION['invoiceNo'].".txt", "w");
	
	
	echo "<table width=\"100%\" border=1>";
        echo "<tr> 
		
		<th>Drug </th>
		<th>Unit cost</th>
		<th>Quantity </th>
		<th>Total Cost(Ksh.)</th></tr>";
while($item5=mysqli_fetch_array($getDetails))
			{
			$getDrug=mysqli_query($conn, "SELECT drug_name FROM stock WHERE stock_id='{$item5['drug']}'");
						
			$drug=mysqli_fetch_array($getDrug);
			$qtty=mysqli_fetch_array($getQuantity);
            $name=mysqli_fetch_array($getname);
            $idz=mysqli_fetch_array($getid);
			$tot=$item5['cost']*$item5['quantity'];
			$total[]=$tot;
			fwrite($file, $drug[0].";".$item5['cost'].";".$item5['quantity'].";".$tot.";\n");	
				
				echo "<tr>";
                echo '<td>' . $drug[0] . '</td>';
				echo '<td align="right">' . number_format($item5['cost'],2) . '</td>';
				echo '<td align="right">' . $item5['quantity'] . '</td>';
				echo '<td align="right">' . number_format($tot,2). '</td>';
				echo "</tr>";
						
			}
	$zote=array_sum($total);
    echo "<tr>";
    echo "Customer name:".$name['customer_name'];
        echo "</tr>";
        
echo "<tr>";
                echo '<td><strong>TOTAL</strong></td>';
				echo '<td></td>';
				echo '<td></td>';
                 
				echo'<td align="right">'. number_format($zote,2) . '</td>';
					
fwrite($file, "TOTAL;;;".$zote.";\n");
fclose($file);
echo "</table>"; 				



//not yet operational

$files=fopen("receipts/docs/".$idz['ids'].".txt", "a+");
 
 fwrite($files, "GRAND TOTAL;;;;;".$zote."\n");

	fclose($files);

}

//$querycust=mysqli_query($conn, "INSERT into customer(invoice_no,cust_name,drug,quantity,tot) }values('{$invoice}','{$_SESSION['custName']}','{$drug}','{$quantity}','{$tot}')") or die(mysqli_error());
   //$chrono=mysqli_query($conn,"INSERT INTO chronology(invoice_id,date,day,month) values('{$invoice}','{$date}','{$day}','{$month}',)") or die(mysqli_error());

?>