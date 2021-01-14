
<!DOCTYPE html>
<html>
	<head>
		<title>Doctors</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="results.css">
	        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.-/css/font-awesome.min.css"/>

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
		<th>Code</th>
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
			"<td>'".$person["code"]."'</td>".
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
		    

		    <p><a href="./search2.php" target="_self"><button>Back</button></table></a></p>
		<div class="kumpi">
		<i class="fa fa-info-circle"></i>
		<i class="fa fa-info-circle" style="font-size:24px"></i>
		<i class="fa fa-info-circle" style="font-size:36px"></i>
		<i class="fa fa-info-circle" style="font-size:48px;color:red"></i>
		<br>

		<h2>Book an appointment:</h2>
		<a href="./calendar.php"<button style="font-size:24px;text-decoration:none;color:inherit">Click Here <i class="fa fa-info-circle"></i></button></a>
</div>
		    <br><br><br><br><br><br><br><br><br><br><br><hr>
		    <nav class="footer-nav" role="navigation">
				<p>Copyright &copy;
				  2020 Doctor Any Time. All rights reserved.</p>
		    </nav>	
	</body>
<html>
 <head>
 <style>
  .kumpi{
	position:relative;
	bottom:50px;
	left:30px;
	
}
 </style>
 </head>
</html>
</html>
