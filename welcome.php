<?php
 	// start the session 
session_start();
	//Check if the user is not logged in then redirect the user to login page
if (!isset($_SESSION["userid"])|| $_SESSION["userid"] != true){
   header("location: login.php"}
 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="search2.css">
		<title>Search Form 2</title>
	</head>
	<body>
		<header>
	      <span>
	      <a href="./home.html"><img class="ikona" src="logo.png"></a>
	        <div class="titlos">
	            <h2 style="font-family: Helvetica">Doctor Any Time</h2>
	        </div>
	      </span>
	    </header>

	    <div class="div1">
	    	<h1>Search for a Doctor</h1>
	    	<hr>
	    	<form>
	    		<label for="fname"><b>First name:</b></label>
	  			<input type="text" id="fname" name="fname"><br><br>
	 		    <label for="lname"><b>Last name:</b></label>
	 		    <input type="text" id="lname" name="lname"><br><br>
	 		    <label for="lname"><b>Provider:</b></label>
			    <input  class="pbox" type="text" id="lname" name="lname">
	    	</form>
	    	<div class="example">
	    		<h5 style="font-family: Helveica"><b>Hospital,Clinic,etc</b></h5>
	    	</div>
	    	<label for="lname"><b>Select city:</b></label>
	    	<select>
		      <option value="0">SELECT</option>
		      <option value="1">Nicosia</option>
		      <option value="2">Limassol</option>
		      <option value="3">Larnaca</option>
		      <option value="4">Famagusta</option>
		      <option value="5">Paphos</option>
		    </select>
		    <br><br>
		    <label for="lname"><b>Specialty:</b></label>
		    <select class="specialty">		      
		      <option value="0">SELECT</option>
		      <option value="1">Pathology</option>
		      <option value="2">Pediatrics</option>
		      <option value="3">General Medicine</option>
		      <option value="4">Cardiology</option>
		      <option value="5">Neurology</option>
		    </select>	    	
	    </div>
<div class="butt">
		    <a href="./results.html" target="_self"><button>Search</button></a>
		  	<a href="./search2.html" target="_self"><button>Clear</button></a>
		</div>
	</body>
</html>
