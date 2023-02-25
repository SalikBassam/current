<?php
$host = "hostname "; 
$dbname = "agence";
$username = "root";
$password = "";

$dsn = "mysql: host=$host; dbname=$dbname";

try{
    $dbConnection = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo "Error connecting to database: " . $e->getMessage();
}
?>