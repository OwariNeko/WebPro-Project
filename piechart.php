<?php
include 'connect.php';
$strSQL =  "SELECT productName,qty
				FROM orderP, transfer, product, users,listP
				WHERE orderP.transferID = transfer.transferID
				AND product.productID = listP.productID
				AND orderP.orderID = listP.orderID
				AND   users.userID = orderP.userID
				AND   transfer.status = 'จ่ายแล้ว'
				"; 
//echo $sql."<br>";
$result = mysqli_query($conn, $strSQL);
$track =array();
$numT = array();
$k=1;
while ($row = mysqli_fetch_assoc($result)) {
	$j=1;
	while($j<=$k){
	if ($track[$j]==$row['productName']) {
	$numT[$j]+=$row['qty'];
	$k--;
	break;
	}
	elseif ($j==$k && ($track[$j]<>$row['productName'])) {
	 $track [$k]= $row['productName']; 
	 $numT[$k]=$row['qty'];
	}
	$j++;
	}
	$k++;
}
//for($r=1;$r<=7;$r++)
//{ 
 //echo $track [$r]."<br>";
	//echo $numT[$r]."<br>";
//}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Pie Chart</title>
  </head>
  <body>
    <div class="container">
        <h1 align = center>จำนวนรายการที่ถูกสั่ง</h1>
        <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
    <!-- Optional JavaScript -->
    <!-- Highcharts library use our CDN -->
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'กราฟวงกลมแสดงจำนวนสินค้า'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Track',
            colorByPoint: true,
            data: [
                <?php 
                    $count = count($track);
                    for ($i = 1; $i < $count; $i++) {
                        echo '{';
                        echo 'name: "'.$track[$i].'",';
                        echo 'y: '.$numT[$i];
                        if ($i == $count-1) {
                            echo '}';
                        } else {
                            echo '},';
                        }
                    }
                ?>
            ]
        }]
    });
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>