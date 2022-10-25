<?php

$db = mysqli_connect("localhost","stud","stud","it_projektas");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>