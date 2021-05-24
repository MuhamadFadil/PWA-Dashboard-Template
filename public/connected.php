<?php
/* Attempt to connect to database */
$link = mysqli_connect("localhost", "root", "", "database");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . "Error");
}else{
    echo ""; 
}
?>