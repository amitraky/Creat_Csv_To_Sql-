<?php
$conn = mysql_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect to MySQL server: ' . mysql_error());
}
$dbname = 'ssl';
$db_selected = mysql_select_db('ssl', $conn);
if (!$db_selected) {
    die("Could not set $dbname: " . mysql_error());
}

?>