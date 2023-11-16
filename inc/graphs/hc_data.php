<?php
$con=mysql_connect('localhost','root','root');
mysql_select_db("highcharts", $con);
$result=mysql_query('select * from sales order by id');
while($row = mysql_fetch_array($result)) {
  echo $row['month'] . "\t" . $row['amount']. "\n";
}
?>