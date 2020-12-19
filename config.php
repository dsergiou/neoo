<?php 
$servername="localhost";
$username="root";
$password="D1179S1995";
$database="DoctorAnyTime";
$db=new mysqli($servername,$username,$password,$database);

if($db->connect_error)   
   echo "connection error:" .$db->connect_error;
else
   echo "connection is created successfully";
?>
