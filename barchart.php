<?php include('connect.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Bar Chart</title>
	<body>
		<?php
		$y_count=2016;
		$m_count=1;
		$cash =array();
		while($m_count<=12){
			$cash[$m_count] =0;
				if($m_count<=9){
					$strSQL =  "SELECT cash
					FROM transfer
					WHERE date LIKE '".$y_count."-0".$m_count."-%'  
				 	"; 
		
					$result = $conn->query($strSQL);
					while($row = $result->fetch_assoc()){
						$cash[$m_count] += $row['cash'];
		 			}
		 		
		 			//echo $m;
		}
			else
		{
			$strSQL =  "SELECT cash
					FROM transfer
					WHERE date LIKE '".$y_count."-".$m_count."-%'  
				 	"; 
		
					$result = $conn->query($strSQL);
					while($row = $result->fetch_assoc()){
						$cash[$m_count] += $row['cash'];
		 			}
		 			//echo $m;
		}
		$m_count++;
		}
 		 ?>
		 <div class="container">
        <h1>Bar Chart</h1>
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
    <!-- Optional JavaScript -->
    <!-- Highcharts library use our CDN -->
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script type="text/javascript">
       Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'สรุปยอดขายของแต่ละเดือน'
    },
    subtitle: {
        
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'ยอดขาย (บาท)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    "series": [
        {
            "name": "เดือน",
            "colorByPoint": true,
            "data": [
            <?php
            	$i=1;
             	while($i<=12)
             	{?>
                
                    
                    <?php echo $cash[$i];?>
                ,
                <?php
                $i++;

            	}
                ?>
            ]
            ,
        dataLabels: {
            enabled: true,
            color: '#FFFFFF',
            align: 'center',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
        }
    ]
      
            
             
      
});

    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
					
	</body>
</html>