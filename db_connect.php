<?php

define('DB_USER', "root"); // db user
define('DB_PASSWORD', ""); // db password (mention your db password here)
define('DB_DATABASE', "objecttracker"); // database name
define('DB_SERVER', "localhost"); // db server

// connect cpanel 000webhost mdp:33bkomZJyLqUsLyfDob4

$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
 
// Check connection
if(mysqli_connect_errno())
{
	echo "Impossile de ce connecter au serveur MySQL: " . mysqli_connect_error();
}
 
?>