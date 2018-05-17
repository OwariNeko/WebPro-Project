<?php include('connect.php'); ?>
<!DOCTYPE html>
<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" > <!--ใช้อักขระภาษาไทย-->
				<title>test</title>
				
			</head>
<?php>
	$strSQL =  "SELECT orderP.orderID, listP.listID, productName, qty,userName , orderP.location, totalPrice, bankName, bankBranch, transferProof, status, transfer.date
				FROM orderP, listP, transfer, product, users
				WHERE orderP.orderID = listP.orderID
				AND   orderP.transferID = transfer.transferID
				AND   product.productID = listP.productID
				AND   users.userID = orderP.userID
				AND   transfer.status = 'จ่ายแล้ว'
				"; 
	
	
	$result = $conn->query($strSQL);
	// $result = mysql_query($strSQL);
	$total = $result->num_rows;
	$txt = "ค้นหาพบทั้งสิ้น ".$total." รายการ<br><br>";
		 echo $txt ;
		 $orderID='';
         while($row = $result->fetch_assoc()){
			 $count += 1;
			 
			 if($orderID=='' or $orderID <> $row['orderID']){
				$orderID = $row['orderID'];
				if($count == '1'){
					echo "<ol>".$orderID ;
				}
				else{
					echo "</ol><ol>".$orderID ;
				}
			 }
			
			 
             echo '<li>'.$row['listID'].'</li>';
			
		 }
	




?>			

	
</html>

