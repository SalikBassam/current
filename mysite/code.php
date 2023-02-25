<?php 
require "connection.php";


$sql = "SELECT * FROM announce";
$annonces = $dbConnection ->query($sql);
?> 