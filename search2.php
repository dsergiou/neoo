<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="search2.css">
		<title>Search Form</title>
	</head>
	<body>
		<header>
	      <span>
	      <a href="./welcome.php"><img class="ikona" src="logo.png"></a>
	        <div class="titlos">
	            <h2 style="font-family: Helvetica">Doctor Any Time</h2>
	        </div>
	      </span>
	    </header>

	    <div class="div1">
	    	<h1>Search for a Doctor</h1>
	    	<hr>
	    	<form method="POST">
	    		<label for="fname"><b>First name:</b></label>
	  			<input type="text" id="fname" name="fname"><br><br>
	 		    <label for="lname"><b>Last name:</b></label>
	 		    <input type="text" id="lname" name="lname"><br><br>
	 		    <label for="provider"><b>Provider:</b></label>
			    <input  class="pbox" type="text" id="provider" name="provider">
	    	
	    	<div class="example">
	    		<h5 style="font-family: Helveica"><b>Hospital,Clinic,etc</b></h5>
	    	</div>
	    	<label for="city"><b>Select city:</b></label>
	    	<select name="city">
		      <option value="0">SELECT</option>
		      <option value="Nicosia">Nicosia</option>
		      <option value="Limassol">Limassol</option>
		      <option value="Larnaka">Larnaka</option>
		      <option value="Famagusta">Famagusta</option>
		      <option value="Paphos">Paphos</option>
		    </select>
		    <br><br>
		    <label for="specialty"><b>Specialty:</b></label>
		    <select name="specialty" class="specialty">		      
		      <option value="0">SELECT</option>
		      <option value="Pathology">Pathology</option>
		      <option value="Pediatrics">Pediatrics</option>
		      <option value="Gynaecology">Gynaecology</option>
		      <option value="Cardiology">Cardiology</option>
		      <option value="Neurology">Neurology</option>
                <option value="Coder">Coder</option>
		    </select>	    	
	    </div>
	    <div class="butt">
		    <button name="search" type="search" value="search">Search</button>
		    <a href="./search2.php"><button style= "text-decoration:none;color:black">Clear</button></a>
		  	
		</div> 
		<br><br><br><br><hr>
	    <nav class="footer-nav" role="navigation">
			<p>Copyright &copy;
			   2020 Doctor Any Time. All rights reserved.</p>
	    </nav>	
	</form>	
	</body>
</html>
<?php
session_start();
require_once "config.php";
function debug_to_console($data) {

    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
$results = array();
if( isset($_POST['search'])){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $provider = $_POST["provider"];
    $city = $_POST["city"];
    $specialty = $_POST["specialty"];
    $sql= "SELECT * FROM Providers WHERE firstname LIKE '%{$fname}%' AND lastname LIKE '%{$lname}%' AND provider LIKE '%{$provider}%'AND city LIKE '%{$city}%'AND specialty LIKE '%{$specialty}%'";
    $result = $db->query($sql);

 if ($result->num_rows> 0){
	//OUTPUT DATA OF EACH ROW
	while($row = $result->fetch_assoc()){
	    array_push($results,$row);
		
	}
	$_SESSION["search_results"] = $results;
	header("location:./result.php");
 }else{		
		echo "0 results";
 }
} 
$db->close();
?>


