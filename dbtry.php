<html> <head> <title>PHP catch TEST</title> </head>
<body>

<?php
ini_set( 'display_errors', "1" );
error_reporting(-1);

require_once '/home/researchstudent/www/sql/dbClass.php';

try{
	$dbTake = new DbClass; 
	$dbTake->dbGet();
}
catch(Exception $e){
	echo '<hr>';
	print $e->getMessage();
	echo '<hr>';
}
?>
</body>
