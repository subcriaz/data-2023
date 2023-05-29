<?php
/*
* Change the value of $password if you have set a password on the root userid
* Change NULL to port number to use DBMS other than the default using port 3306
*

$user = 'systemsc';
$password = 'od*m*w6256F'; //To be completed if you have set a password to root
$database = 'systemsc_dp'; // The database must exist.
$port = NULL; //Default must be NULL to use default port
$mysqli = new mysqli('systems92.com', $user, $password, $database, $port);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
*/

// Enter your Host, username, password, database below.
$con = mysqli_connect("systems92.com","systemsc","od*m*w6256F","systemsc_dp");
    if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
	}

?>

