
	<table border=1>
		<tr><th>Drug name</th>
			<th>Drug id</th>
			<th>total amount sold</th></tr>
<?php
include('connect_db.php');
$queru=mysqli_query($conn, "select DISTINCT drug,drug_name from sales LEFT JOIN stock ON sales.drug=stock.stock_id where day=18 AND month='June' AND year=2018")or die(mysqli_error());


	while($data=mysqli_fetch_array($queru)){
		
		
		$count=mysqli_query($conn,"select SUM(quantity) as tot from sales where drug='".$data['drug']."'");
		$sam=mysqli_fetch_assoc($count);
		
		?>
	
		<tr><td> <?php echo $data['drug_name'];?></td>
		
			<td> <?php echo $data['drug'];?></td>  <td> <?php echo $sam['tot'];?></td></tr><br>
		
		</table>

		
		<?php
		
		
	}
	
	
	
	
	
	











?>