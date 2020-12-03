<?php
 define('DBSERVER', 'localhost');//database server
 define('DBNAME', 'demo');//database name
 define('DBLASTNAME', 'demo1');//database lastname
 define('DBEMAIL', 'demo2');// database email
 define('DBTELEPHONE', 'demo3');//database telephone
 define('DBUSERNAME', 'root');//database username
 define('DBPASSWORD', '');//DATABASE Password

/*connect to Mysql database*/
$db = mysqli_connect(DBSERVER,DBNAME,DBLASTNAME,DBEMAIL,DBTELEPHONE,DBUSERNAME,DBPASSWORD)

//check db fann_get_total_connections
if($db==false){
    die("Error: connection error". mysql_connect_error());
}

 ?>
