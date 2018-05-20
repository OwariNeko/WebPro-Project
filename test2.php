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
	$strSQL =  "SELECT orderP.orderID, productName,userName , orderP.location, totalPrice, bankName, bankBranch, transferProof, status, transfer.date
				FROM orderP, transfer, product, users,listP
				WHERE orderP.transferID = transfer.transferID
				AND product.productID = listP.productID
				AND orderP.orderID = listP.orderID
				AND   users.userID = orderP.userID
				AND   transfer.status = 'จ่ายแล้ว'
				"; 
	
	
	$result = $conn->query($strSQL);
	// $result = mysql_query($strSQL);
	$total = $result->num_rows;
	 
		  $mpdf->WriteHTML("ค้นหาพบทั้งสิ้น ".$total." รายการ<br>") ;
		 $orderID='';
		 $listTotalPrice='';
         while($row = $result->fetch_assoc()){
			 $count += 1;
			 $userName=$row['userName'];
			 $totalPrice=$row['totalPrice'];
			 $location=$row['location'];
			 if($orderID=='' or $orderID <> $row['orderID']){
				 
				$orderID=$row['orderID'];
				$strSQL2 ="SELECT listID,productName,productprice
							FROM listP,product
							WHERE product.productID = listP.productID
							AND orderID=('".$orderID."')";
				$result2 = $conn->query($strSQL2);
				if($count == '1'){
					$mpdf->WriteHTML( "<ol>".$orderID."	".$userName);
					$mpdf->WriteHTML("ที่อยู่	".$location);
								 while($row2 = $result2->fetch_assoc())
			 {
			 		$productName =$row2['productName'];
			 		$productprice=$row2['productprice'];
					$mpdf->WriteHTML('<li>'.$row2['listID']."	ชื่อสินค้า".$productName."							ราคา	".$productprice.'	บาท</li>');  
			}
			$mpdf->WriteHTML("	ราคารวม	".$totalPrice."	บาท") ;
			$mpdf->WriteHTML("--------------------------------------------------------------------------------------------------------------------------------------------------------");
				
					
				}
				else{
					$mpdf->WriteHTML("</ol><ol>".$orderID."	".$userName) ;
					$mpdf->WriteHTML("ที่อยู่	".$location);
								 while($row2 = $result2->fetch_assoc())
			 {
			 		$productName =$row2['productName'];
			 		$productprice=$row2['productprice'];
					$mpdf->WriteHTML('<li>'.$row2['listID']."	ชื่อสินค้า".$productName."							ราคา	".$productprice.'	บาท</li>');  
			}
			$mpdf->WriteHTML("	ราคารวม	".$totalPrice."	บาท") ;
			$mpdf->WriteHTML("--------------------------------------------------------------------------------------------------------------------------------------------------------");
				}
			 }

		}
		 
	
	$mpdf->Output();
?>			

	
</html>

