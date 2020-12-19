
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
                <th>Address</th>
                <th>Telephone</th>
                <th>Email</th>
            </tr>

                <?php
                session_start();
                $results = $_SESSION["search_results"];
                $counter = 0;
                foreach($results as $person){
                    echo "<tr class='".$counter."_row'>".
                        "<td>'".$person["firstname"]."'</td>".
		    		"<td>'".$person["lastname"]."'</td>".
		    		"<td>'".$person["provider"]."'</td>".
		    		"<td>'".$person["city"]."'</td>".
				"<td>'".$person["specialty"]."'</td>".
				"<td>'".$person["address"]."'</td>".
				"<td>'".$person["telephone"]."'</td>".
				"<td>'".$person["email"]."'</td>".
                        "</tr>";
		    		#"<th>Address</th><td>'".$person["address"]."'</td>".
		    		#"<th>Telephone</th><td>'".$person["telephone"]."'</td>".
		    		#"<th>Email</th><td>'".$person["email"]."'</td>";
                    $counter++;
                }

                ?>


		    </table>
		   
		    <p><a href="./search2.php" target="_self"><button>Back</button></table></p>
		    <br><br><br><br><br><br><br><br><br><br><br><hr>
		    <nav class="footer-nav" role="navigation">
				<p>Copyright &copy;
				  2020 Doctor Any Time. All rights reserved.</p>
		    </nav>	
	</body>
</html>
