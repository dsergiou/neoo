<!DOCTYPE html>
<html>
	<head>
		<title>Doctors</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="results.css">
	</head>
	<body>
		<header>
	      <a href="./welcome.php"><img class="ikona" src="logo.png"></a>
	        <div class="titlos">
	            <h1>Doctor Any Time</h1>
	        </div>
	    </header>

	   
		    <table align="center">
		    	<tr class="first_row">
		    		<th>First Name</th>
		    		<th>Last Name</th>
		    		<th>Provider</th>
		    		<th>City</th>
		    		<th>Specialty</th>
		    	</tr>
<?php
     $conn = new mysqli("localhost", "root", "D1179S1995", "DoctorAnyTime");
		    if($conn-> connect_error){
		    	die("Connection failed" . $conn-> connect_error);
		    }
    $sql = "SELECT firstname, lastname, provider, city, specialty FROM Providers;";
    $result = $conn-> query($sql);
		   if($result-> num_rows > 0){
		    	while($row = $result-> fetch_assoc()){
		    	echo "<tr><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["provider"] . "</td><td>" . $row["city"] . "</td><td>" . $row["specialty"] . "</td></tr>";
		    	}
		    echo "</table>";
		    }
		    		else{
		    			echo "0 result";
		    		}

		    		$conn-> close();
		    	?>
		 </table>
		   
		 <p><a href="./welcome.php" target="_self"><button>Back</button></a></p>	
		    <br><br><br><br><br><br><br><br><br><br><br><hr>
		    <nav class="footer-nav" role="navigation">
				<p>Copyright &copy;
				  2020 Doctor Any Time. All rights reserved.</p>
		    </nav>	
	</body>
</html>
