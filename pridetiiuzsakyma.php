<?php

include "dbConn.php"; // Using database connection file here
session_start();
$part_id = $_GET['id']; // get id through query string
$manager = $_SESSION['user'];

$insert = mysqli_query($db,"INSERT INTO `cart`(`manager`, `part_id`) VALUES ('$manager','$part_id')");

if($insert)
{
    mysqli_close($db); // Close connection
    header("location:daliespaieska.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>