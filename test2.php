<?php include('connect.php'); 
require_once __DIR__ . '/vendor/autoload.php';?>
<!DOCTYPE html>
<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" > <!--ใช้อักขระภาษาไทย-->
				<title>test</title>
				
			</head>
<?php
	$mpdf = new \Mpdf\Mpdf();
	$mpdf->autoScriptToLang = true;
$mpdf->baseScript = 1;
$mpdf->autoVietnamese = true;
$mpdf->autoArabic = true;
	$mpdf->autoLangToFont = true;
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
	 
		  $mpdf->WriteHTML("ค้นหาพบทั้งสิ้น ".$total." รายการ<br><br>") ;
		 $orderID='';
         while($row = $result->fetch_assoc()){
			 $count += 1;
			 
			 if($orderID=='' or $orderID <> $row['orderID']){
				$orderID = $row['orderID'];
				if($count == '1'){
					$mpdf->WriteHTML( "<ol>".$orderID) ;
				}
				else{
					$mpdf->WriteHTML("</ol><ol>".$orderID) ;
				}
			 }
			
			 
             $mpdf->WriteHTML('<li>'.$row['listID'].'</li>');
			
		 }
	
	$mpdf->Output();



?>			

	
</html>

