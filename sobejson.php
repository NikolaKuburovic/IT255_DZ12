<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token,
	token, TOKEN');
header("Content-type: application/json");


$servername = "localhost";
$username = "root";
$password = "root";
$database = "met_hotels";

$db = mysql_connect($servername, $username, $password) or die('Ne moze da se poveze'); 
mysql_select_db($database, $db) or die('');


$upit = mysql_query("SELECT * FROM soba") or die('greska');
$redovi = array();

while ($r = mysql_fetch_assoc($upit, MYSQL_ASSOC)) {
	$redovi[] = $r;
}
echo json_encode($redovi);

?>