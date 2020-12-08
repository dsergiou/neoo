<?php 
$servername="localhost";
$username="root";
$password="D1179S1995";
$database="DoctorAnyTime";
$connect=new mysqli($servername,$username,$password,$database);

if($connect->connect_error)   
   echo "connection error:" .$connect->connect_error;
else
   echo "connection is created successfully";
?>
