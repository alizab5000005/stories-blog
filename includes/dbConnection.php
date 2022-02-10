<?php
session_start();
$conn = mysqli_connect("localhost","root","","stories");
if(!$conn){
	echo "Connection Failed";
}

?>