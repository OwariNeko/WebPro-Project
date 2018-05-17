<?php

$conn=mysql_connect("localhost","root","bestza2020") or die(mysql_error());
$sdb=mysql_select_db("souvenir",$conn) or die(mysql_error());
mysql_query("SET NAMES UTF8");

?>