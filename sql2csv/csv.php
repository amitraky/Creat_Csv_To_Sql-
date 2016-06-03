<?php 
include('db.php');
if(isset($_POST['see'])){
$result = mysql_query('SELECT * FROM `wkends_product`',$conn);
if(!$result)
{ 
  die('Couldn\'t fetch records');
}else
 {
	$num_fields = mysql_num_fields($result);
	$headers = array();
	for ($i = 0; $i<$num_fields; $i++) {
	
		$headers[] =mysql_field_name($result,$i);
}
	$fp = fopen('php://output', 'w');
	if ($fp && $result) {
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="export.csv"');
		header('Pragma: no-cache');
		header('Expires: 0');
		fputcsv($fp, $headers);
		while ($row = mysql_fetch_array($result)) {	 //print_r($row);die;	
			fputcsv($fp, array_values($row)); 
		}
		die;
	}
 }
}
?>
</head>
<body>
<?php
/*$res = mysql_query('select * from wkends_product', $conn);
echo $num_fields = mysql_num_fields($res);
echo mysql_field_name($res, 5) . "\n";
*/?>
<form method="post">
<input type="submit"  name="see" value="Open in csv"/>
</form>



</body>
</html>
