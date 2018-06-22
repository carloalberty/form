<?php
// Define database
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'testdb');
// Connecting database
try {
	$pdo = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}
?>