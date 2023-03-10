<?php

//data base connection 
$host = "localhost";
$user = "root";
$code = "";
$db = "ertech";

$con = mysqli_connect($host,$user,$code,$db);
// if does not connect the db then raise the error
if (!$con) {
    echo"Server error";
}
